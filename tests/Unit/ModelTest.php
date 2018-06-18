<?php

namespace Tests\Unit;

use App\Rota;
use App\Shop;
use App\Staff;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shop_model_returns_name_correctly()
    {
        $funHouse = Shop::find(1);

        $this->assertEquals('FunHouse', $funHouse->name);
    }

    /** @test */
    public function shop_model_relation_to_staff_returns_all_staff_members()
    {
        $funHouse = Shop::find(1);

        $this->assertEquals(5, $funHouse->staff->count());
    }

    /** @test */
    public function staff_model_relation_to_shop_retruns_shop()
    {
        $blackWidow = Staff::where('first_name', 'Black Widow')->first();

        $this->assertEquals('FunHouse', $blackWidow->shop->name);
    }

    /** @test */
    public function shop_model_relation_to_rota_returns_all_rotas()
    {
        $funHouse = Shop::find(1);

        $this->assertEquals(1, $funHouse->rotas->count());
    }

    /** @test */
    public function staff_model_relation_to_shifts_returns_all_shifts()
    {
        $blackWidow = Staff::where('first_name', 'Black Widow')->first();
        $rota = Rota::find(1);

        $this->assertEquals(4, $blackWidow->shifts->where('rota_id', $rota->id)->count());
    }
}