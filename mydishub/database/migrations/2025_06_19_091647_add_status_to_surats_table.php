<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('surats', function (Blueprint $table) {
        $table->string('status')->nullable(); // null = belum diproses
    });
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('surats', function (Blueprint $table) {
        if (Schema::hasColumn('surats', 'status')) {
            $table->dropColumn('status');
        }
        });
        
    }
};
