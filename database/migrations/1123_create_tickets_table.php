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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->text('resolution')->nullable()->default(null);
            $table->unsignedBigInteger('reporter_id')->nullable();
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('solver_id')->nullable()->default(null);
            $table->foreign('solver_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('ticket_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
