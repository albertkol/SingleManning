<?php

namespace Tests\Unit;

use App\Rota;
use App\Helpers\SingleManning;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenariosTest extends TestCase
{
    use RefreshDatabase;

    private $rota;

    protected function setUp()
    {
        parent::setUp();

//        I will assume that a work day is from 06:00 - 23:00
//        Rota will be fixed from Monday the 2018-06-11 to 2018-06-17

        $this->rota = Rota::find(1);
    }

    /** @test */
    public function scenario_one()
    {
//        Black Widow: |----------------------|
//        __Given__ Black Widow working at FunHouse on Monday in one long shift
//        __When__ no-one else works during the day
//        __Then__ Black Widow receives single manning supplement for the whole duration of her shift.

//        __Conclusion__
//        Black Widow works from 07:00 to 23:00 for a total of 960 minutes (16 hours), 960 single manning minutes
//        Total single manning minutes 960

//        Calculate manning hours for Monday (2018-06-11)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(960, $staffSingleManningMinutesArray["2018-06-11"]['single_manning_hours']);
    }

    /** @test */
    public function secenario_two()
    {
//        Black Widow: |----------|
//        Thor:                   |-------------|
//
//        __Given__ Black Widow and Thor working at FunHouse on Tuesday
//        __When__ they only meet at the door to say hi and bye
//        __Then__ Black Widow receives single manning supplement for the whole duration of her shift
//        __And__ Thor also receives single manning supplement for the whole duration of his shift.

//        __Conclusion__
//        Black Widow works half a day from 07:00 to 15:00 for a total of 480 minutes (8 hours), 480 single manning minutes
//        Thor works half a day from 15:00 to 23:00 for a total of 480 minutes (8 hours), 480 single manning minutes
//        Total single manning minutes 960

//        Calculate manning hours for Tuesday (2018-06-12)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(960, $staffSingleManningMinutesArray['2018-06-12']['single_manning_hours']);
    }

    /** @test */
    public function scenario_three()
    {
//        Wolverine: |------------|
//        Gamora:          |--------------|
//
//        __Given__ Wolverine and Gamora working at FunHouse on Wednesday
//        __When__ Wolverine works in the morning shift
//        __And__ Gamora works the whole day, starting slightly later than Wolverine
//        __Then__ Wolverine receives single manning supplement until Gamora starts her shift
//        __And__ Gamora receives single manning supplement starting when Wolverine has finished his shift, until the end of the day.

//        __Conclusion__
//        Wolverine works three thirds a day from 07:00 to 19:00 for a total of 720 minutes (12 hours), 240 single manning minutes
//        Gamora works three thirds a day from 11:00 to 23:00 for a total of 720 minutes (12 hours), 240 single manning minutes
//        Total single manning minutes 480

//        Calculate manning hours for Wednesday (2018-06-13)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(480, $staffSingleManningMinutesArray['2018-06-13']['single_manning_hours']);
    }

    /** @test */
    public function scenario_four()
    {
//        Wolverine: |----|****|-----------------|
//        Gamora:    |----------------|****|-----|
//        (*) represents a break

//        __Given__ Wolverine and Gamora working at FunHouse on Thursday
//        __When__ Both of them work throughout the whole day
//        __And__ The both have a lunch break each
//        __Then__ Wolverine receives single manning supplement while Gamora is on break
//        __And__ Gamora receives single manning supplement during Wolverines break.

//        __Conclusion__
//        Wolverine works full day from 07:00 to 23:00 with a 4 hours break for a total of 720 minutes (12 hours), 240 single manning minutes
//        Gamora works full day from 07:00 to 23:00 with a 4 hours break for a total of 720 minutes (12 hours), 240 single manning minutes
//        Total single manning minutes 480

//        Calculate manning hours for Thursday (2018-06-14)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(480, $staffSingleManningMinutesArray['2018-06-14']['single_manning_hours']);
    }


    /** @test */
    public function scenario_five()
    {
//        Black Widow:  |----|****|-----------------|
//        Thor:         |-------|****|--------------|
//        Wolverine:    |---------|****|------------|
//        (*) represents a break

//        __Given__ Black Widow, Thor and Wolverine working at FunHouse on Friday
//        __When__ All of them work throughout the whole day
//        __And__ Each one has a lunch break for two hours starting at an 1 hour interval
//        __Then__ They receive single manning supplement when if they others are on lunch break

//        __Conclusion__
//        Black Widow works full day from 07:00 to 23:00 with a 2 hours break for a total of 840 minutes (14 hours), 60 single manning minutes
//        Thor works full day from 07:00 to 23:00 with a 2 hours break for a total of 840 minutes (14 hours), 0 single manning minutes
//        Wolverine works full day from 07:00 to 23:00 with a 2 hours break for a total of 840 minutes (14 hours), 60 single manning minutes
//        Total single manning minutes 120

//        Calculate manning hours for Thursday (2018-06-15)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(120, $staffSingleManningMinutesArray['2018-06-15']['single_manning_hours']);
    }

    /** @test */
    public function scenario_six()
    {
//        Thor:         |-------|    |-------|**|---|
//        Gamora:       |----|    |---------------|
//        Black Widow:          |-|
//        (*) represents a break


//        __Given__ Black Widow, Thor and Gamora working at FunHouse on Saturday
//        __When__ Thor has two shifts, with one break during the second shift
//        __And__  Gamora has two shifts too
//        __And__  Black Widow comes in just for one hour when neither Thor or Gamora are in
//
//        __Conclusion__
//        Thor has one shift of 5 hours, is away for 4 hours then has a second shift of 7 hours with 1 hour break. Thats a total of 660 hours (11), 240 single manning minutes (4 hours)
//        Gamora has one shift of 2 hours, is away for 4 hours then has a second shift of 9 hours, and finishes one hour early, works for a total of 660 minutes (11 hours), 240 single manning minutes (4 hours)
//        Black Widow works a short shift of one hour, 60 single manning minutes
//        Total single manning minutes 540


//        Calculate manning hours for Thursday (2018-06-16)
        $staffSingleManningMinutesArray = SingleManning::calculate($this->rota);

        $this->assertEquals(540, $staffSingleManningMinutesArray['2018-06-16']['single_manning_hours']);

    }
}