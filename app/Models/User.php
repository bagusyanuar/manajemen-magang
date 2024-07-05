<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function peserta()
    {
        return $this->hasOne(PesertaMagang::class,'user_id');
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class,'user_id');
    }

    public function pengajuan_diterima()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')
            ->orderBy('created_at', 'DESC')
            ->where('status', '=', 'diterima');
    }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')
            ->orderBy('created_at', 'DESC');
    }


}
