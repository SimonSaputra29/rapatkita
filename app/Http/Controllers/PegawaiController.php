<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function create()
    {
        $userList = User::pluck('name')->toArray(); // Atau bisa pakai jabatan, email, dsb.
        return view('pegawai.createpermissions', compact('userList'));
    }
}
