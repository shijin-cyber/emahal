<?php

use Illuminate\Database\Seeder;

class TreatmentFailureReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('treatment_failure_reason')->insert([
            [
                'reason_name' 	=> 'There is no good treatment in the surrounding areas'
            ],
            [
                'reason_name' 	=> 'Feeling ineffective with treatment'
            ],
            [
                'reason_name' 	=> 'Due to financial difficulties'
            ],
            [
                'reason_name' 	=> 'There is no opportunity for higher treatment'
            ],
        ]);
    }
}
