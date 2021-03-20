<?php

use Illuminate\Database\Seeder;

class TreatmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('treatment_types')->insert([
            [
                'type_name' 	=> 'Allopathy'
            ],
            [
                'type_name' 	=> 'Ayurveda'
            ],
            [
                'type_name' 	=> 'Homeopathy'
            ],
            [
                'type_name' 	=> 'Unani'
            ],
            [
                'type_name' 	=> 'Naturopathy'
            ],
            [
                'type_name' 	=> 'Others'
            ]
        ]);
    }
}
