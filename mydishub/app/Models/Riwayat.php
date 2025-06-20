<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $fillable = ['nosurat','kapal_id','file_surat','user_id',];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }
}

