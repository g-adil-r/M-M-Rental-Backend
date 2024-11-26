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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('reservasi_id');
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->unsignedBigInteger('metode_pembayaran_id');
            $table->double('jumlah');
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('reservasi_id')->references('id')->on('reservasi');
            $table->foreign('metode_pembayaran_id')->references('id')->on('metode_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
