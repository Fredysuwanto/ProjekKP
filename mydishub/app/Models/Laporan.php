<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'surats'; // Gunakan tabel kapals

    // Tidak perlu fillable karena hanya untuk read/report
    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
    
}
