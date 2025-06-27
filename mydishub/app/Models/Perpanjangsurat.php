<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpanjangsurat extends Model
{
use HasFactory;

    protected $fillable = [
        'surat_id',
        'user_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
public function surat()
{
    return $this->belongsTo(Surat::class);
}
}