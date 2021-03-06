<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('type', ['permanent', 'contact'])->default('permanent');
            $table->text('street')->nullable();
            $table->text('house_name')->nullable();
            $table->text('house_number')->nullable();
            $table->text('ward')->nullable();
            $table->text('ward_number')->nullable();
            $table->text('panchayath')->nullable();
            $table->text('block')->nullable();
            $table->text('thalook')->nullable();
            $table->text('post_name')->nullable();
            $table->text('pin_code')->nullable();
            $table->text('district')->nullable();
            $table->text('state')->nullable();
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
        Schema::dropIfExists('customer_addresses');
    }
}
