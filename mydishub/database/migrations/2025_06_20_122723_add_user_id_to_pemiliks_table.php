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
        Schema::table('pemiliks', function (Blueprint $table) {
            // Tambahkan kolom user_id dan buat foreign key ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemiliks', function (Blueprint $table) {
            // Hapus foreign key dan kolom
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
