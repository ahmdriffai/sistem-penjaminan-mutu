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
        Schema::create('paper_ilmiah', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('tahun');
            $table->string('bulan');
            $table->string('media');
            $table->string('issn');
            $table->string('sebagai');
            $table->string('indexs');
            $table->string('kriteria');
            $table->string('link');
            $table->boolean('publis')->default(0);
            $table->string('owner');
            $table->foreign('owner')
                ->references('nidn')->on('dosen');
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
        Schema::dropIfExists('paper_ilmiah');
    }
};
