<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Middleware\Authorize;

class AtasanController extends Controller
{
    public function index()
    {
        return view('atasan.index');
    }

    public function create()
    {
        $userList = User::pluck('name')->toArray(); // Atau bisa pakai jabatan, email, dsb.
        return view('atasan.createpermissions', compact('userList'));
    }

    public function sendwa()
    {
        $response = Http::withheaders(
        [
            'Authorization' => 'fqFx6FiMuW7fCSGJHL6X',
        ]
        )->post('https://api.fonnte.com/send',
        [
            'target' => '08388017459',
            'message' => 'lu keren bet',
        ]);

        // dd(json_decode($response, true));
    }
}
