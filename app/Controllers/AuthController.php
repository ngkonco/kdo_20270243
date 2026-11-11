<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilan Halaman Login
     */
    public function login()
    {
        // Jika sudah login, langsung alihkan ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title'      => 'Masuk ke Sistem Informasi KDO - BMD',
            'validation' => \Config\Services::validation(),
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses Verifikasi Kredensial Login
     */
    public function attemptLogin()
    {
        $usernameOrEmail = trim((string) $this->request->getPost('username'));
        $password        = (string) $this->request->getPost('password');

        if (empty($usernameOrEmail) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Username / Email dan Password wajib diisi.');
        }

        $user = $this->userModel->findByUsernameOrEmail($usernameOrEmail);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Akun pengguna tidak ditemukan di sistem.');
        }

        // Verifikasi password hash bcrypt
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Kata sandi (password) yang Anda masukkan salah.');
        }

        // Regenerasi session ID untuk mencegah serangan Session Fixation (OWASP Top 10)
        session()->regenerate(true);

        // Simpan data autentikasi ke sesi pengguna
        session()->set([
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'email'        => $user['email'],
            'role'         => $user['role'],
            'logged_in'    => true,
        ]);

        return redirect()->to(base_url('dashboard'))->with('success', "Selamat datang kembali, {$user['nama_lengkap']}!");
    }

    /**
     * Logout Sesi Pengguna
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar (logout) dari sistem.');
    }
}

