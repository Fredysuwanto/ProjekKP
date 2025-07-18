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
        Schema::dropIfExists('riwayats');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
        $table->id();
        $table->string('nosurat');
        $table->foreignId('kapal_id');
        $table->string('file_surat')->nullable();
        $table->timestamps();
    });
    
    }
};
