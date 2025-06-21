<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'surats'; // Gunakan tabel surats

    // Tidak perlu fillable karena hanya untuk read/report
    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
    
}
