<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nik', 'alamat', 'telepon', 'email','user_id',];
    
public function user()
{
    return $this->belongsTo(User::class);
}
public function surats()
{
    return $this->hasMany(Surat::class);
}

}
    
