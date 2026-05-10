<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mhs';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user', 'nim', 'nama', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'prodi', 'periode'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pesertaKelas()
    {
        return $this->hasMany(PesertaKelasPerkuliahan::class, 'id_mhs', 'id_mhs');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_mhs', 'id_mhs');
    }
}
