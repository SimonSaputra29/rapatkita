<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtasanController extends Controller
{
    public function index()
    {
        return view('atasan.index');
    }

    public function create()
    {
        return view('atasan.createpermissions');
    }
}
