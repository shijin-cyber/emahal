<?php

use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diseases')->insert([
            [
                'disease_name' 	=> 'Mentally disordered'
            ],
            [
                'disease_name' 	=> 'Not interested'
            ],
            [
                'disease_name' 	=> 'Liver'
            ],
            [
                'disease_name' 	=> 'Heart'
            ],
            [
                'disease_name' 	=> 'Rheumatism' // vatham
            ],
            [
                'disease_name' 	=> 'Bone'
            ],
            [
                'disease_name' 	=> 'Cancer'
            ],
            [
                'disease_name' 	=> 'Uterus'
            ],
            [
                'disease_name' 	=> 'Neuro'
            ],
            [
                'disease_name' 	=> 'Polio'
            ],
            [
                'disease_name' 	=> 'Psychology'
            ],
            [
                'disease_name' 	=> 'Disability'
            ],
            [
                'disease_name' 	=> 'Others'
            ],
        ]);
    }
}
