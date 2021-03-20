<?php

use Illuminate\Database\Seeder;

class StudyFailureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_failures')->insert([
            [
                'failure_name' 	=> 'Unhealthy'
            ],
            [
                'failure_name' 	=> 'Finance'
            ],
            [
                'failure_name' 	=> 'Can\'t get opportunity for higher studies'
            ],
            [
                'failure_name' 	=> 'Subject to disciplinary action'
            ],
            [
                'failure_name' 	=> 'Lack of guidance'
            ],
            [
                'failure_name' 	=> 'Lack of guidance'
            ],
        ]);
    }
}
