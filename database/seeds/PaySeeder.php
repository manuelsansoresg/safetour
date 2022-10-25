<?php

use App\TypePay;
use Illuminate\Database\Seeder;

class PaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_pay = array(
            'name' => 'payed on line',
            'type' => 1,
            'price' => 10,
            'legend' => 'pago online'
        );

        $pago = new TypePay($data_pay);
        $pago->save();
    }
}
