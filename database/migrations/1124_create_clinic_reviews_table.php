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
        Schema::create('clinic_reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('rate', [1, 2, 3, 4, 5]);
            $table->string('comment', 250);
            $table->unsignedBigInteger('reviewer_id');
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_reviews');
    }
};
