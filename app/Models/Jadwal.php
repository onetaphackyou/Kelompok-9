<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = ['id_kelas', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'keterangan'];

    public function kelas()
    {
        return $this->belongsTo(KelasPerkuliahan::class, 'id_kelas', 'id_kelas');
    }
}