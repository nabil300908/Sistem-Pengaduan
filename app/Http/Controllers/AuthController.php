<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ======================
    // LOGIN SISWA
    // ======================
    public function showLoginSiswa()
    {
        if (session('user_id') && session('user_role') === 'siswa') {
            return redirect()->route('publik.index');
        }

        return view('auth.login', ['isAdmin' => false]);
    }

    public function loginSiswa(Request $request)
    {
        $user = $this->attemptLogin($request);

        if (!$user) {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }

        if ($user->role !== 'siswa') {
            return back()->with('error', 'Akses ditolak. Hanya siswa yang bisa login di sini.')->withInput();
        }

        $this->setSession($user);

        return redirect()->route('publik.index');
    }

    // ======================
    // LOGIN ADMIN
    // ======================
    public function showLoginAdmin()
    {
        if (session('user_id') && session('user_role') === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login', ['isAdmin' => true]);
    }

    public function loginAdmin(Request $request)
    {
        $user = $this->attemptLogin($request);

        if (!$user) {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }

        if ($user->role !== 'admin') {
            return back()->with('error', 'Akses ditolak. Hanya admin yang bisa login di sini.')->withInput();
        }

        $this->setSession($user);

        return redirect()->route('admin.dashboard');
    }

    // ======================
    // HELPER LOGIN
    // ======================
    private function attemptLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        return $user;
    }

    private function setSession($user)
    {
        session([
            'user_id'    => $user->id,
            'user_role'  => $user->role,
            'user_name'  => $user->name,
            'user_email' => $user->email,
        ]);
    }

    // ======================
    // LOGOUT
    // ======================
    public function logout()
    {
        session()->flush();

        return redirect()->route('welcome');
    }

    // ======================
    // REGISTER
    // ======================
    public function showRegister()
    {
        if (session('user_id')) {
            return redirect()->route('publik.index');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        $this->setSession($user);

        return redirect()->route('publik.index')
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->name . '.');
    }
}