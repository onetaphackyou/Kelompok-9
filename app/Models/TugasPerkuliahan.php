<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasPerkuliahan extends Model
{
    use HasFactory;

    protected $table = 'tugas_perkuliahan';
    protected $primaryKey = 'id_tugas';

    protected $fillable = ['id_materi', 'judul_tugas', 'deskripsi_tugas', 'file_tugas', 'deadline'];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    public function materi()
    {
        return $this->belongsTo(MateriPerkuliahan::class, 'id_materi', 'id_materi');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_tugas', 'id_tugas');
    }
}
