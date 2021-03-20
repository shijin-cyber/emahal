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
            $table->string('phone_number', 25)->nullable();
            $table->boolean('is_head')->default(false)->nullable();
            $table->text('member_mahal')->nullable();
            $table->text('current_mahal')->nullable();
            $table->enum('gender', ['M', 'F', 'O'])->nullable();

            $table->unsignedBigInteger('study_level')->nullable();
            $table->unsignedBigInteger('study_status')->nullable();
            $table->boolean('is_study_scholarship')->default(false);
            $table->unsignedBigInteger('study_failure')->nullable();
            $table->unsignedBigInteger('religious_study')->nullable();

            $table->unsignedBigInteger('work_nature')->nullable();
            $table->text('job')->nullable();
            $table->unsignedBigInteger('no_job_reason')->nullable();
            $table->boolean('is_ready_to_self_work')->default(false);
            $table->boolean('maritial_status')->default(false)->nullable();
            $table->unsignedBigInteger('unmarried_reason')->nullable();

            $table->enum('health_status', ['patient', 'satisfied'])->default('satisfied')->nullable();
            $table->unsignedBigInteger('disease')->nullable();
            $table->boolean('is_treatment')->default(false)->nullable();
            $table->unsignedBigInteger('treatment_type')->nullable();
            $table->enum('blood_group', ['A +ve', 'A -ve', 'B +ve', 'B -ve', 'O +ve', 'O -ve', 'AB +ve', 'AB -ve'])->nullable();
            $table->unsignedBigInteger('treatment_time')->nullable();
            $table->enum('treatment_from', ['GOV' ,'PVT'])->nullable();
            $table->double('monthly_treatment_cost')->nullable();
            $table->unsignedBigInteger('treatment_cost_by')->nullable();
            $table->boolean('is_treatment_success')->default(true)->nullable();
            $table->unsignedBigInteger('treatment_failure_reason')->nullable();

            $table->boolean('is_known_arabic_language')->default(false);
            $table->boolean('is_haji')->default(false)->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('relation_name')->nullable();
            $table->text('description')->nullable();
            // $table->string('proof')->nullable(); created as new table
            $table->unsignedBigInteger('parent_user_id')->nullable();
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
