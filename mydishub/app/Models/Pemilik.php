<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nik', 'alamat', 'telepon', 'email','file_ktp','user_id',];
    
public function user()
{
    return $this->belongsTo(User::class);
}


}
    
