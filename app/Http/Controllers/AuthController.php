<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.login', [
            'title' =>  'Halaman Masuk'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     =>  'required|email',
            'password'  =>  'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return match ($user->role) {
                'admin' => redirect()->route('admin.index')->with('success', 'Selamat Datang Admin!'),
                'atasan' => redirect()->route('atasan.index')->with('success', 'Selamat Datang atasan!'),
                default => redirect()->route('pegawai.index')->with('success', 'Selamat Datang pegawai!'),
            };
        }
        return back()->withInput()->with('error', 'ada yang salah');
    }

    public function redirectToDashboard()
    {
        $user = Auth::user();
        return match ($user->role) {
            'admin' => redirect()->route('admin.index')->with('success', 'Welcome back, Admin!'),
            'atasan' => redirect()->route('atasan.index')->with('success', 'Welcome back, atasan!'),
            default => redirect()->route('pegawai.index')->with('error', 'Invalid role!'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Keluar Berhasil');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register', [
            'title' => 'Halaman Pendaftaran'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai'
        ]);

        return redirect()->route('login')->with('success', 'Daftar berhasil, silakan masuk!');
    }
}
