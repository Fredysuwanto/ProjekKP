<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kapals', function (Blueprint $table) {
            $table->string('tujuan')->nullable()->change();   // ← ubah jadi NULLABLE
        });
    }

    public function down(): void
    {
        Schema::table('kapals', function (Blueprint $table) {
            $table->string('tujuan')->nullable(false)->change(); // rollback ke NOT NULL
        });
    }
};
