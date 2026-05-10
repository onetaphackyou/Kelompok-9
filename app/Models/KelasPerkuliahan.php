<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPerkuliahan extends Model
{
    use HasFactory;

    protected $table = 'kelas_perkuliahan';
    protected $primaryKey = 'id_kelas';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kelas', 'id_matkul', 'id_dosen', 'ruangan',
        'hari', 'jam_awal', 'jam_akhir', 'periode'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul', 'id_matkul');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaKelasPerkuliahan::class, 'id_kelas', 'id_kelas');
    }

    public function materi()
    {
        return $this->hasMany(MateriPerkuliahan::class, 'id_kelas', 'id_kelas');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'peserta_kelas_perkuliahan', 'id_kelas', 'id_mhs')
                    ->withPivot('nilai_akhir')
                    ->withTimestamps();
    }
}
