<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
     use HasFactory;
    protected $fillable = ['kapal_id','nama', 'pemilik_id' ,'noplat', 'jenis', 'ukuran','tandaselar', 'daya','muatan','jenisperizinan','tujuan','file_stnk','status_izin','user_id',];

    public function user()
{
    return $this->belongsTo(User::class);
}


}


