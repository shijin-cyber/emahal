<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('full_name')->nullable();
            // $table->string('customer_address','255')->nullable(); create as new table
            $table->date('dob')->nullable();
            $table->string('email', 125)->nullable()->index();
            $table->string('phone', 25)->nullable();
            $table->boolean('is_head')->default(false);
            
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('relation_name')->nullable();
            $table->text('description')->nullable();
            // $table->string('proof')->nullable(); created as new table
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
        Schema::dropIfExists('customers');
    }
}
