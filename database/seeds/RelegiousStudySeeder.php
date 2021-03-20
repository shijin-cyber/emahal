<?php

use Illuminate\Database\Seeder;

class RelegiousStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relegious_studies')->insert([
            [
                'study_name' 	=> 'No'
            ],
            [
                'study_name' 	=> '4th Class'
            ],
            [
                'study_name' 	=> '5-7 Class'
            ],
            [
                'study_name' 	=> '10th Class'
            ],
            [
                'study_name' 	=> 'Graduate'
            ],
            [
                'study_name' 	=> 'Post Graduation'
            ],
        ]);
    }
}
