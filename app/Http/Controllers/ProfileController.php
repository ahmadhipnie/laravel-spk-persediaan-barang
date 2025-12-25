<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Mohon periksa kembali data yang Anda masukkan.');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Try catch untuk eksekusi update data
        try {
            // Attempt to update user profile
            $updated = $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            // Cek apakah update berhasil
            if ($updated) {
                Alert::success('Berhasil!', 'Profile berhasil diupdate!');
                return redirect()->route('profile.index');
            } else {
                Alert::error('Gagal!', 'Terjadi kesalahan saat update profile.');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat update profile: ' . $e->getMessage());

            Alert::error('Gagal!', 'Terjadi kesalahan sistem. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Mohon periksa kembali data yang Anda masukkan.');
            return redirect()->back()
                ->withErrors($validator);
        }

        // Cek apakah password lama sesuai
        if (!Hash::check($request->password_lama, $user->password)) {
            Alert::error('Gagal!', 'Password lama tidak sesuai!');
            return redirect()->back();
        }

        // Try catch untuk eksekusi update password
        try {
            // Attempt to update password
            $updated = $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Cek apakah update berhasil
            if ($updated) {
                Alert::success('Berhasil!', 'Password berhasil diubah!');
                return redirect()->route('profile.index');
            } else {
                Alert::error('Gagal!', 'Terjadi kesalahan saat mengubah password.');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat update password: ' . $e->getMessage());

            Alert::error('Gagal!', 'Terjadi kesalahan sistem. Silakan coba lagi.');
            return redirect()->back();
        }
    }
}
