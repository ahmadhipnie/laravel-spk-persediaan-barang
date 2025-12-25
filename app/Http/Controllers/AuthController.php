<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            Alert::success('Berhasil!', 'Selamat datang kembali, ' . Auth::user()->name . '!');
            return redirect()->route('dashboard.index')
                ->with('success', 'Login berhasil!');
        }

        Alert::error('Gagal!', 'Email atau password salah!');
        return redirect()->back()
            ->with('error', 'Email atau password salah!')
            ->withInput();
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Mohon periksa kembali data yang Anda masukkan.');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Try catch untuk eksekusi tambah data
        try {
            // Attempt to create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Cek apakah user berhasil dibuat
            if ($user) {
                Alert::success('Berhasil!', 'Registrasi berhasil! Silakan login.');
                return redirect()->route('login');
            } else {
                Alert::error('Gagal!', 'Terjadi kesalahan saat membuat akun.');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error saat registrasi: ' . $e->getMessage());

            Alert::error('Gagal!', 'Terjadi kesalahan sistem. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        Alert::success('Berhasil!', 'Anda telah logout.');
        return redirect()->route('login')
            ->with('success', 'Logout berhasil!');
    }
}
