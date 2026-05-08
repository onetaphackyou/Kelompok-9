// app/Http/Controllers/AdminProdi/MateriController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\MateriPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $id_kelas = $request->get('id_kelas', 0);

        $materi_list = MateriPerkuliahan::withCount('tugas')
            ->where('id_kelas', $id_kelas)
            ->orderBy('id_materi', 'desc')
            ->get();

        return view('admin_prodi.materi', compact('materi_list', 'id_kelas', 'admin_prodi'));
    }
}
