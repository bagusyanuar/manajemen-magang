<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    use HasFactory;

    protected $table = 'peserta_magang';

    protected $fillable = [
        'user_id',
        'pembimbing_id',
        'nama',
        'no_hp',
        'instansi',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'nilai',
        'is_active',
        'di_terima'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }
}
