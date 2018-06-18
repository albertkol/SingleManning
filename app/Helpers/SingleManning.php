<?php

namespace App\Helpers;

use App\Rota;
use Carbon\Carbon;

class SingleManning
{
    private $rota;
    private $dayShifts = [];
    private $shiftPoints = [];
    private $dayPoints = [];
    private $daysPlan = [];

    private static $instance;


    public function __construct(Rota $rota)
    {
        $this->rota = $rota;
    }

    public static function calculate(Rota $rota)
    {
        return self::$instance = (new self($rota))->calculateSingleManningMinutes();
    }

    /*
     * Calculate Single Manning Minutes of each day of the ROTA
     *
     * The idea is the following:
     *
     * No matter how many employees work in one day, or how many shifts or breaks they have. I will build an array called $daysPlan which will pretty much overlap all their shift hours. Then I will go segment by segment(a time range) and check how many people work then. Segments that have only one person working will be the single manning hours.
     *
     * First I will have to take each start_time and end_time of every shift or break. Then put them in one array called $dayPoints. After taking each unique $dayPoint, each two $dayPoints will make a segment. Using the doesShiftAndSegmentOverlap method, I will find out if any of the shifts will overlap with the segment. If it does, then it means that the employee covers that time range. I save each employee that works on that segment. If the number of employees on a segment is 1, then time is single manning time.
     *
     * If a shift has breaks. I will make the code interpret that shift as two separate shifts. Basically it does not matter if there is one long shift with a break, or two smaller shifts.
     *
     * @return array
     */
    public function calculateSingleManningMinutes()
    {
        $this->parseShifts();
        $this->buildDayPlan();
        $this->parseDayPlanToCheckEmployeeWorkShifts();
        $this->parseDayPlanToCalculateManningMinutes();

        return $this->daysPlan;
    }

    private function parseShifts()
    {
        foreach ($this->rota->shifts as $shift) {
            $day = $this->getDateFromDateTime($shift->start_time);

            $this->initDayShiftArray($day);

            if($shift->shiftBreaks->count() > 0) {
                $this->buildShiftBreakPoints($shift);

                for ($i = 1; $i < count($this->shiftPoints); $i++) {
                    $this->createShift($day, $shift->staff_id, $this->shiftPoints[$i - 1], $this->shiftPoints[$i]);
                    $this->addDayPoint($this->shiftPoints[$i - 1], $this->shiftPoints[$i]);
                    $i++;
                }

            } else {
                $this->createShift($day, $shift->staff_id, $shift->start_time, $shift->end_time);
                $this->addDayPoint($shift->start_time, $shift->end_time);
            }
        }
        $this->cleanDayPoints();
    }

    private function buildDayPlan()
    {
        for ($i = 1; $i < count($this->dayPoints); $i++) {

            if ($this->areDayPointsNotInTheSameDay($i))
                continue;

            $day = $this->getDateFromDateTime($this->dayPoints[$i - 1]);

            $this->initDayPlanArray($day);

            $segment['time_range_start'] = $this->dayPoints[$i - 1];
            $segment['time_range_end'] = $this->dayPoints[$i];
            $segment['staff_working_on_that_range'] = [];
            $this->daysPlan["{$day}"]['segments'][] = $segment;
            $this->daysPlan["{$day}"]['single_manning_hours'] = 0;

        }
    }

    private function parseDayPlanToCheckEmployeeWorkShifts()
    {

        foreach ($this->dayShifts as $day => $shifts) {

            foreach($shifts as $shift){

                foreach ($this->daysPlan["{$day}"]['segments'] as &$segment) {

                    if ($this->doesShiftAndSegmentOverlap($shift['start_time'], $shift['end_time'], $segment['time_range_start'], $segment['time_range_end'])) {
                        $segment['staff_working_on_that_range'][] = $shift['staff_id'];
                    }
                }

            }

        }

    }

    private function parseDayPlanToCalculateManningMinutes()
    {

        foreach ($this->daysPlan as &$dayPlan) {

            foreach($dayPlan['segments'] as &$segment) {

                if (count($segment['staff_working_on_that_range']) == 1 ){
                    $diff = Carbon::parse($segment['time_range_start'])->diffInMinutes($segment['time_range_end']);
                    $dayPlan["single_manning_hours"] += $diff;
                }

            }

        }

    }

    private function doesShiftAndSegmentOverlap($shiftStart, $shiftEnd, $segmentStart, $segmentEnd)
    {
        return ($shiftStart < $segmentEnd) and ($shiftEnd > $segmentStart);
    }

    private function arrageArrayByDate($a, $b)
    {
        return strtotime($a) - strtotime($b);
    }

    private function getDateFromDateTime($datetime)
    {
        return date('Y-m-d', strtotime($datetime));
    }

    private function initDayShiftArray($day)
    {
        if(!isset($this->dayShifts["{$day}"]))
            $this->dayShifts["{$day}"] = [];
    }

    private function buildShiftBreakPoints($shift)
    {
        $this->shiftPoints = [];
        $this->shiftPoints[] = $shift->start_time;
        foreach($shift->shiftBreaks as $break) {
            $this->shiftPoints[] = $break->start_time;
            $this->shiftPoints[] = $break->end_time;
        }
        $this->shiftPoints[] = $shift->end_time;
    }

    private function createShift($day, $staffId, $startTime, $endTime)
    {
        $dayShiftsItem['staff_id'] = $staffId;
        $dayShiftsItem['start_time'] = $startTime;
        $dayShiftsItem['end_time'] = $endTime;
        $this->dayShifts["{$day}"][] = $dayShiftsItem;
    }

    private function addDayPoint($startTime, $endTime)
    {
        $this->dayPoints[] = $startTime;
        $this->dayPoints[] = $endTime;
    }

    private function cleanDayPoints()
    {
        $this->dayPoints = array_unique($this->dayPoints);
        usort($this->dayPoints, [$this, 'arrageArrayByDate']);
        $this->dayPoints = array_values($this->dayPoints);
    }

    private function areDayPointsNotInTheSameDay($i)
    {
        return $this->getDateFromDateTime($this->dayPoints[$i - 1]) != $this->getDateFromDateTime($this->dayPoints[$i]);
    }

    private function initDayPlanArray($day)
    {

        if(!isset($this->daysPlan["{$day}"]))
            $this->daysPlan["{$day}"] = [];
    }
}