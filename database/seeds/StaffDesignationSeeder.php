<?php

use Illuminate\Database\Seeder;

class StaffDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_id = -1)
    {
        if($user_id != -1)
            DB::table('staff_designations')->insert([
                [
                    'user_id' 	=> $user_id,
                    'type_name' => 'Qateeb'
                ],
                [
                    'user_id' 	=> $user_id,
                    'type_name' => 'Mukri'
                ],
                [
                    'user_id' 	=> $user_id,
                    'type_name' => 'Sadar Muallim'
                ],
                [
                    'user_id' 	=> $user_id,
                    'type_name' => 'Muallim'
                ],
            ]);
    }
}
