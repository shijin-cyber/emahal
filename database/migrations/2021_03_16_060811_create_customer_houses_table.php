<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->enum('house_type', ['own', 'rent'])->nullable();
            $table->enum('house_roof', ['concrete', 'oat', 'ola', 'grass_grazing', 'sheet'])->nullable();
            $table->boolean('electricity')->default(true);
            $table->enum('water', ['own_well', 'pipe', 'public_well', 'public_tap', 'not_availabel'])->nullable();
            $table->boolean('toilet')->default(true);
            $table->boolean('gyas')->default(true);
            $table->enum('ration_card', ['yellow', 'pink', 'blue', 'white'])->nullable();
            $table->boolean('own_vehicle')->default(true);
            $table->enum('type_vehicle', ['cycle', 'scooter', 'car', 'lori', 'wheelbarrow'])->nullable();
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
        Schema::dropIfExists('customer_houses');
    }
}
