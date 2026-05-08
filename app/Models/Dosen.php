// app/Models/Dosen.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'id_user', 'nip', 'nama', 'prodi', 'jenis_kelamin',
        'tanggal_lahir', 'agama', 'jenis_jabatan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kelasPerkuliahan()
    {
        return $this->hasMany(KelasPerkuliahan::class, 'id_dosen', 'id_dosen');
    }
}
