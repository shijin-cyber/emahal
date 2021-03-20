<?php

use Illuminate\Database\Seeder;

class TreatmentTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('treatment_time')->insert([
            [
                'treatment_duration' 	=> '20 Year'
            ],
            [
                'treatment_duration' 	=> '10-20 Year'
            ],
            [
                'treatment_duration' 	=> '5-10 Year'
            ],
            [
                'treatment_duration' 	=> '1-5 Year'
            ],
            [
                'treatment_duration' 	=> 'Less than a year'
            ],
            [
                'treatment_duration' 	=> 'Less than six months'
            ],
        ]);
    }
}
