<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funHouseId = DB::table('shops')->insertGetId([
            'name' => 'FunHouse',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $blackWidowId = DB::table('staff')->insertGetId([
            'first_name' => 'Black Widow',
            'surname' => 'van NotAvengers',
            'shop_id' => $funHouseId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $thorId = DB::table('staff')->insertGetId([
            'first_name' => 'Thor',
            'surname' => 'van Avengers',
            'shop_id' => $funHouseId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $wolverineId = DB::table('staff')->insertGetId([
            'first_name' => 'Wolverine',
            'surname' => 'van Xmen',
            'shop_id' => $funHouseId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $gamoraId = DB::table('staff')->insertGetId([
            'first_name' => 'Gamora',
            'surname' => 'van WhosThis',
            'shop_id' => $funHouseId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $stanLeeId = DB::table('staff')->insertGetId([
            'first_name' => 'Stan',
            'surname' => 'Lee',
            'shop_id' => $funHouseId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $rotaId = DB::table('rotas')->insertGetId([
            'shop_id' => $funHouseId,
            'week_commence_date' => '2018-06-11',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $mondayShiftOneId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $blackWidowId,
            'start_time' => date('2018-06-11 07:00:00'),
            'end_time' => date('2018-06-11 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $tuesdayShiftOneId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $blackWidowId,
            'start_time' => date('2018-06-12 07:00:00'),
            'end_time' => date('2018-06-12 15:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $tuesdayShiftTwoId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $thorId,
            'start_time' => date('2018-06-12 15:00:00'),
            'end_time' => date('2018-06-12 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $wednesdayShiftOneId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $wolverineId,
            'start_time' => date('2018-06-13 07:00:00'),
            'end_time' => date('2018-06-13 19:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $wednesdayShiftTwoId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $gamoraId,
            'start_time' => date('2018-06-13 11:00:00'),
            'end_time' => date('2018-06-13 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $thursdayShiftOneId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $wolverineId,
            'start_time' => date('2018-06-14 07:00:00'),
            'end_time' => date('2018-06-14 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $thursdayShiftOneBreakOneId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $thursdayShiftOneId,
            'start_time' => date('2018-06-14 11:00:00'),
            'end_time' => date('2018-06-14 15:00:00')
        ]);

        $thursdayShiftTwoId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $gamoraId,
            'start_time' => date('2018-06-14 07:00:00'),
            'end_time' => date('2018-06-14 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $thursdayShiftTwoBreakOneId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $thursdayShiftTwoId,
            'start_time' => date('2018-06-14 15:00:00'),
            'end_time' => date('2018-06-14 19:00:00')
        ]);

        $fridayShiftOneId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $blackWidowId,
            'start_time' => date('2018-06-15 07:00:00'),
            'end_time' => date('2018-06-15 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $fridayShiftOneBreakOneId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $fridayShiftOneId,
            'start_time' => date('2018-06-15 10:00:00'),
            'end_time' => date('2018-06-15 12:00:00')
        ]);

        $fridayShiftTwoId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $thorId,
            'start_time' => date('2018-06-15 07:00:00'),
            'end_time' => date('2018-06-15 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $fridayShiftTwoBreakTwoId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $fridayShiftTwoId,
            'start_time' => date('2018-06-15 11:00:00'),
            'end_time' => date('2018-06-15 13:00:00')
        ]);

        $fridayShiftThreeId = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $wolverineId,
            'start_time' => date('2018-06-15 07:00:00'),
            'end_time' => date('2018-06-15 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $fridayShiftThreeBreakThreeId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $fridayShiftThreeId,
            'start_time' => date('2018-06-15 12:00:00'),
            'end_time' => date('2018-06-15 14:00:00')
        ]);

        $saturdayShiftOneID = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $thorId,
            'start_time' => date('2018-06-16 07:00:00'),
            'end_time' => date('2018-06-16 12:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $saturdayShiftTwoID = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $thorId,
            'start_time' => date('2018-06-16 16:00:00'),
            'end_time' => date('2018-06-16 23:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $saturdayShiftTwoBreakOneId = DB::table('shift_breaks')->insertGetId([
            'shift_id' => $saturdayShiftTwoID,
            'start_time' => date('2018-06-16 18:00:00'),
            'end_time' => date('2018-06-16 19:00:00')
        ]);

        $saturdayShiftThreeID = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $gamoraId,
            'start_time' => date('2018-06-16 07:00:00'),
            'end_time' => date('2018-06-16 09:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $saturdayShiftFourID = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $gamoraId,
            'start_time' => date('2018-06-16 13:00:00'),
            'end_time' => date('2018-06-16 22:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $saturdayShiftFiveID = DB::table('shifts')->insertGetId([
            'rota_id' => $rotaId,
            'staff_id' => $blackWidowId,
            'start_time' => date('2018-06-16 12:00:00'),
            'end_time' => date('2018-06-16 13:00:00'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
