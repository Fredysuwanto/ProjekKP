<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
     use HasFactory;
    protected $fillable = ['nama', 'noplat', 'jenis', 'ukuran','tandaselar', 'daya','muatan','jenisperizinan','tujuan','file_stnk','user_id',];

    public function user()
{
    return $this->belongsTo(User::class);
}
// relasi ke tabel 'surats'
public function surats()
{
    return $this->hasMany(\App\Models\Surat::class, 'kapal_id');
}

}


