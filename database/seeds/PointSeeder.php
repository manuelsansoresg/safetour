<?php

use App\Pickuppoint;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'name' => 'Playa manzana #109'
        );
        $point = new Pickuppoint($data);
        $point->save();
    }
}
