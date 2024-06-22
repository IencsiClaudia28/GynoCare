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

        Schema::create('clinic_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 35);
            $table->unsignedBigInteger('price')->nullable(false);
            $table->unsignedBigInteger('clinic_id')->nullable(true);
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

            $table->unique(['clinic_id', 'name']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_services');
    }
};