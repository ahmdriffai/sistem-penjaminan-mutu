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
        Schema::create('file_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->string('file_url')->nullable();
            $table->string('file_path')->nullable();
            $table->string('format')->nullable();
            $table->unsignedBigInteger('dokumen_mutu_id');
            $table->foreign('dokumen_mutu_id')
                ->references('id')->on('dokumen_mutu');
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
        Schema::dropIfExists('file_dokumen');
    }
};
