<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;
    protected $fillable=[
        'kategori_id','nomor_menu','url_menu', 'nama_menu','harga_menu'
    ];
    public function kategori()
        {
            return $this->belongsTo(Kapal::class, 'kategori_id');
            //return $this->belongsTo(Nama_Model::class,'fakultas_id');
            //1 prodi 1 fakultas belongsTo()
            //1 fakultas > 1 prodi hasMany()
        }
}
