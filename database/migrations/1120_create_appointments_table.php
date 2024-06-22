<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('appointment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('service_id')->nullable(true);
            $table->foreign('service_id')->references('id')->on('clinic_services')->onDelete('set null');
            $table->unsignedBigInteger('appointment_status_id')->nullable();
            $table->foreign('appointment_status_id')->references('id')->on('appointment_statuses')->onDelete('set null');
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('notes', 1500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
