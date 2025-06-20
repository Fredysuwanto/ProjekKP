<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kapal_id',
        'pemilik_id',
        'user_id',
        'jenis_perizinan', // <- ini perlu ditambahkan agar bisa disimpan saat create/update
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
