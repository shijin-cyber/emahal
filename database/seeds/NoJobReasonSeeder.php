<?php

use Illuminate\Database\Seeder;

class NoJobReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('no_job_reasons')->insert([
            [
                'reason_name' 	=> 'No get to job'
            ],
            [
                'reason_name' 	=> 'Lack of employment'
            ],
            [
                'reason_name' 	=> 'Illness'
            ],
            [
                'reason_name' 	=> 'Not interested in working'
            ],
            [
                'reason_name' 	=> 'Wants to do it when get a job'
            ]
        ]);
    }
}
