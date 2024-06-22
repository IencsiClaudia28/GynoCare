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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('user_type_id')->default(3);
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
            $table->text('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
