<?php

use Illuminate\Database\Seeder;

class StudyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_statuses')->insert([
            [
                'status_name' 	=> 'Completed'
            ],
            [
                'status_name' 	=> 'Studying'
            ],
            [
                'status_name' 	=> 'Study completed / Didn\'t attend examinations'
            ],
            [
                'status_name' 	=> 'Failed'
            ]
        ]);
    }
}
