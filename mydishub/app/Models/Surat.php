<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kapal_id', 'pemilik_id',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
}
