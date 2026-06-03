<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class MateriPageController extends Controller
{
    public function index()
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas_list = KelasPerkuliahan::with(['mataKuliah', 'materi'])
            ->where('id_dosen', $id_dosen)
            ->get();

        return view('dosen.materi_page', compact('kelas_list'));
    }
}