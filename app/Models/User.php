<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';
    use Notifiable;

    // Specify the primary key
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama', 'email', 'password', 'role', 'status', 'last_login', 'prodi'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'password' => 'hashed',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_user');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'id_user');
    }


}
