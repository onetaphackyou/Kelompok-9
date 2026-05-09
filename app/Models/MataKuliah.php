<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_matkul';

    protected $fillable = [
        'nama_matkul', 'sks', 'semester', 'jenis_matkul', 'prodi'
    ];

    public function kelasPerkuliahan()
    {
        return $this->hasMany(KelasPerkuliahan::class, 'id_matkul', 'id_matkul');
    }
}
