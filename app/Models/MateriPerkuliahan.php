// app/Models/MateriPerkuliahan.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPerkuliahan extends Model
{
    use HasFactory;

    protected $table = 'materi_perkuliahan';
    protected $primaryKey = 'id_materi';

    protected $fillable = ['id_kelas', 'judul_materi', 'deskripsi', 'upload_file'];

    public function kelas()
    {
        return $this->belongsTo(KelasPerkuliahan::class, 'id_kelas', 'id_kelas');
    }

    public function tugas()
    {
        return $this->hasMany(TugasPerkuliahan::class, 'id_materi', 'id_materi');
    }
}
