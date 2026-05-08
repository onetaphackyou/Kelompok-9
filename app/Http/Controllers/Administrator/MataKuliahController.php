<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mata_kuliahs = MataKuliah::orderBy('id_matkul', 'desc')->get();
        return view('administrator.mata_kuliah', compact('mata_kuliahs'));
    }
}
