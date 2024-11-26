<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('user_id');
            $table->uuid('car_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_harga');
            $table->enum('status', ['pending', 'cancelled', 'on_rent', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('car_id')->references('id')->on('car');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
};
