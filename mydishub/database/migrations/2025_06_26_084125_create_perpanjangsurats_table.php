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
        Schema::create('perpanjangsurats', function (Blueprint $table) {
            $table->id();
$table->foreignId('surat_id')->constrained('surats'); // → ini benar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status'); // atau atur posisi sesuai kebutuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangsurats');
    }
};