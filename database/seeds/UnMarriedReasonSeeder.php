<?php

use Illuminate\Database\Seeder;

class UnMarriedReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('un_married_reasons')->insert([
            [
                'reason_name' 	=> 'Patient'
            ],
            [
                'reason_name' 	=> 'Not interested'
            ],
            [
                'reason_name' 	=> 'Financial vulnerability'
            ],
            [
                'reason_name' 	=> 'The sister could not marry'
            ],
            [
                'reason_name' 	=> 'No suitable connection was found'
            ]
        ]);
    }
}
