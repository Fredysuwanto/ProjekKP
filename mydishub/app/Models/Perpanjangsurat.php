<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpanjangsurat extends Model
{
use HasFactory;

    protected $fillable = [
        'riwayat_id',
        'user_id',
        'jenis_perizinan', // <- ini perlu ditambahkan agar bisa disimpan saat create/update
    ];

    public function riwayat()
    {
        return $this->belongsTo(Riwayat::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
