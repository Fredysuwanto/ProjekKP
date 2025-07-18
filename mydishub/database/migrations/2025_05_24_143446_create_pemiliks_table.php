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
        Schema::create('pemiliks', function (Blueprint $table) {

            $table->id();
             $table->string('nama');
             $table->string('nik');
             $table->string('alamat');
             $table->string('telepon');
             $table->string('email');
             $table->string('file_ktp')-> nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemiliks');
    }
};
