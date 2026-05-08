<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;

class KelasPerkuliahanController extends Controller
{
    public function index()
    {
        $kelas = KelasPerkuliahan::with(['mataKuliah', 'dosen'])
            ->orderBy('id_kelas', 'desc')
            ->get();

        return view('administrator.kelas_perkuliahan', compact('kelas'));
    }
}
