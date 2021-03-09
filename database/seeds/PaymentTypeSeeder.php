<?php

use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_id = -1)
    {
        DB::table('payment_types')->insert(
            [
                'user_id' 	=> $user_id,
                'type_name' => 'Monthly'
            ],
            [
                'user_id' 	=> $user_id,
                'type_name' => 'Other'
            ]
        );
    }
}
