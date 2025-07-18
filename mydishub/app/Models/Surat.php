<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
     use HasFactory;
    protected $fillable = ['surat_id','nama', 'pemilik_id' ,'noplat', 'jenis', 'ukuran','tandaselar', 'daya','muatan','jenisperizinan','tujuan','file_stnk','status_izin',    'tanggal_kadaluarsa',
    'status_perpanjangan',
    'tanggal_perpanjangan',
    'user_id',];

    public function user()
{
    return $this->belongsTo(User::class);
}
// app/Models/Surat.php
public function perpanjangsurat()
{
    return $this->hasMany(Perpanjangsurat::class);
}

}


