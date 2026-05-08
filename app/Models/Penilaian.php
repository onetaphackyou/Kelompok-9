// app/Models/Penilaian.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $primaryKey = 'id_nilai';

    protected $fillable = ['id_tugas', 'id_mhs', 'id_peserta', 'nilai', 'upload_file', 'status'];

    public function tugas()
    {
        return $this->belongsTo(TugasPerkuliahan::class, 'id_tugas', 'id_tugas');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function peserta()
    {
        return $this->belongsTo(PesertaKelasPerkuliahan::class, 'id_peserta', 'id_peserta');
    }
}
