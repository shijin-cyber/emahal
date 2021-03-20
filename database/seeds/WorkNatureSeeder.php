<?php

use Illuminate\Database\Seeder;

class WorkNatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_natures')->insert([
            [
                'nature_name' 	=> 'Government'
            ],
            [
                'nature_name' 	=> 'Private'
            ],
            [
                'nature_name' 	=> 'Self Employed'
            ],
            [
                'nature_name' 	=> 'Wages Work'
            ],
            [
                'nature_name' 	=> 'Abroad'
            ],
            [
                'nature_name' 	=> 'Others (Explain)'
            ],
            [
                'nature_name' 	=> 'Unemployed'
            ],
        ]);
    }
}
