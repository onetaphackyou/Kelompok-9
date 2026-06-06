<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_kelas', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'keterangan',
        'hari_request', 'jam_mulai_request', 'jam_selesai_request',
        'ruangan_request', 'keterangan_request', 'status_request', 'id_dosen_request'
    ];

    public function kelas()
    {
        return $this->belongsTo(KelasPerkuliahan::class, 'id_kelas', 'id_kelas');
    }
}