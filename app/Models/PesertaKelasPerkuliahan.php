<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKelasPerkuliahan extends Model
{
    use HasFactory;

    protected $table = 'peserta_kelas_perkuliahan';
    protected $primaryKey = 'id_peserta';

    protected $fillable = ['id_kelas', 'id_mhs', 'nilai_akhir'];

    public function kelas()
    {
        return $this->belongsTo(KelasPerkuliahan::class, 'id_kelas', 'id_kelas');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_peserta', 'id_peserta');
    }
}
