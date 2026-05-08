<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('id_mhs', 'desc')->get();
        return view('administrator.mahasiswa', compact('mahasiswas'));
    }
}
