<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('id_dosen', 'desc')->get();
        return view('administrator.dosen', compact('dosens'));
    }
}
