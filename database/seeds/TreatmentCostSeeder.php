<?php

use Illuminate\Database\Seeder;

class TreatmentCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('treatment_cost_by')->insert([
            [
                'cost_name' 	=> 'On its own'
            ],
            [
                'cost_name' 	=> 'Help from others'
            ],
            [
                'cost_name' 	=> 'Insurance'
            ],
            [
                'cost_name' 	=> 'Government/ Institutional Reimbursement'
            ],
            [
                'cost_name' 	=> 'Borrowed'
            ],
            [
               'cost_name' 		=> 'Zakat Wealth'
            ],
        ]);
    }
}
