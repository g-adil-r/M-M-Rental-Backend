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
        // DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('car', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('nama_mobil');
            $table->integer('tahun');
            $table->string('plat_nomor')->unique();
            $table->unsignedBigInteger('id_jenis');
            $table->integer('kapasitas_penumpang');
            $table->double('harga_sewa');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->enum('transmisi', ['manual', 'automatic']);
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('jenis_mobil');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car');
    }
};
