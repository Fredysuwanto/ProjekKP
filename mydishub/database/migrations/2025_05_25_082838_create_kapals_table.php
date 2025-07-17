<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kapals', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("noplat");
            $table->string("jenis");
            $table->string("ukuran");
            $table->string("tandaselar");
            $table->string("daya");
            $table->string("muatan");
            $table->string("jenisperizinan");
            $table->string("tujuan")->nullable();
            $table->string('file_stnk')-> nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapals');
    }
};
