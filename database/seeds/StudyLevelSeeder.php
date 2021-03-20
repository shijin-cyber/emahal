<?php

use Illuminate\Database\Seeder;

class StudyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_levels')->insert([
            [
                'level_name' 	=> 'Illiteracy'
            ],
            [
                'level_name' 	=> 'Pre-primary'
            ],
            [
                'level_name' 	=> 'Middle (7th Class)'
            ],
            [
                'level_name' 	=> 'S.S.L.C Failure'
            ],
            [
                'level_name' 	=> 'S.S.L.C Passed'
            ],
            [
                'level_name' 	=> 'Pre-degree / +2'
            ],
            [
                'level_name' 	=> 'Degree'
            ],
            [
                'level_name' 	=> 'I.T.I'
            ],
            [
                'level_name' 	=> 'Diploma'
            ],
            [
                'level_name' 	=> 'Post Graduation'
            ],
            [
                'level_name' 	=> 'Engineering'
            ],
        ]);
    }
}
