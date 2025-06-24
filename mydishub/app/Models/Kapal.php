<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
     use HasFactory;
    protected $fillable = ['nama', 'noplat', 'jenis', 'ukuran','tandaselar', 'daya','muatan','jenisperizinan','user_id',];

    public function user()
{
    return $this->belongsTo(User::class);
}
public function riwayat()
{
    return $this->hasMany(Riwayat::class);
}
public function surats()
{
    return $this->hasMany(Surat::class);
}


}


