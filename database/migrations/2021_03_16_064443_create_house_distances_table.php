<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_distances', function (Blueprint $table) {
            $table->id();
            $table->enum('points', ['school', 'college', 'hospital', 'bus_stop', 'masjid'])->default('masjid');
            $table->text('point_name')->nullable();
            $table->string('distance', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_distances');
    }
}
