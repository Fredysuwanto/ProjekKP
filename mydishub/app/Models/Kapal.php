<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
     use HasFactory;
    protected $fillable = ['nama', 'noplat', 'jenis', 'ukuran', 'daya','muatan','jenisperizinan','user_id',];

    public function user()
{
    return $this->belongsTo(User::class);
}

}


