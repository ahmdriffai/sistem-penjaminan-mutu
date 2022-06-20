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
        Schema::create('dokumen_mutu', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokumen');
            $table->string('nama');
            $table->integer('tahun');
            $table->text('deskripsi');
            $table->string('file_url')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('penjaminan_mutu_id');
            $table->foreign('penjaminan_mutu_id')
                ->references('id')->on('penjaminan_mutu');
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
        Schema::dropIfExists('dokumen_mutu');
    }
};
