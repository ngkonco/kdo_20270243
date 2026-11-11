<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    /**
     * Menampilkan daftar seluruh Akun Pengguna sistem
     */
    public function index()
    {
        $users = $this->userModel->getUsersWithRole();

        $data = [
            'title'       => 'Master Pengguna Sistem',
            'active_menu' => 'users',
            'users'       => $users,
        ];

        return view('users/index', $data);
    }

    /**
     * Form penambahan Pengguna baru
     */
    public function create()
    {
        $roles = $this->roleModel->orderBy('nama_role', 'ASC')->findAll();

        $data = [
            'title'       => 'Tambah Pengguna Baru',
            'active_menu' => 'users',
            'roles'       => $roles,
            'validation'  => \Config\Services::validation(),
        ];

        return view('users/create', $data);
    }

    /**
     * Menyimpan akun pengguna baru ke database
     */
    public function store()
    {
        $rules = [
            'username'     => 'required|min_length[3]|max_length[50]|alpha_dash|is_unique[users.username]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'role_id'      => 'required|is_not_unique[roles.id]',
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'username' => [
                'required'   => 'Username wajib diisi.',
                'alpha_dash' => 'Username hanya boleh berisi huruf, angka, setrip, dan garis bawah.',
                'is_unique'  => 'Username ini sudah terdaftar. Silakan pilih username lain.',
            ],
            'email' => [
                'required'    => 'Alamat email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Alamat email ini sudah terdaftar.',
            ],
            'pass_confirm' => [
                'matches' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi yang dimasukkan.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roleId   = (int) $this->request->getPost('role_id');
        $roleData = $this->roleModel->find($roleId);

        $saveData = [
            'role_id'      => $roleId,
            'role'         => $roleData ? $roleData['kode_role'] : 'operator',
            'username'     => strtolower(trim((string) $this->request->getPost('username'))),
            'nama_lengkap' => trim((string) $this->request->getPost('nama_lengkap')),
            'email'        => strtolower(trim((string) $this->request->getPost('email'))),
            'password'     => password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $this->userModel->save($saveData);

        return redirect()->to(base_url('users'))->with('success', 'Akun Pengguna baru berhasil didaftarkan.');
    }

    /**
     * Form edit akun Pengguna
     */
    public function edit($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound('Data Akun Pengguna tidak ditemukan.');
        }

        $roles = $this->roleModel->orderBy('nama_role', 'ASC')->findAll();

        $data = [
            'title'       => 'Edit Pengguna: ' . $user['nama_lengkap'],
            'active_menu' => 'users',
            'user'        => $user,
            'roles'       => $roles,
            'validation'  => \Config\Services::validation(),
        ];

        return view('users/edit', $data);
    }

    /**
     * Memperbarui data Akun Pengguna
     */
    public function update($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))->with('error', 'Data Akun Pengguna tidak ditemukan.');
        }

        $rules = [
            'username'     => "required|min_length[3]|max_length[50]|alpha_dash|is_unique[users.username,id,{$id}]",
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email'        => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role_id'      => 'required|is_not_unique[roles.id]',
            'password'     => 'permit_empty|min_length[6]',
            'pass_confirm' => 'matches[password]',
        ];

        $messages = [
            'username' => [
                'required'   => 'Username wajib diisi.',
                'is_unique'  => 'Username ini sudah terdaftar. Silakan pilih username lain.',
            ],
            'email' => [
                'required'    => 'Alamat email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Alamat email ini sudah terdaftar.',
            ],
            'pass_confirm' => [
                'matches' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roleId   = (int) $this->request->getPost('role_id');
        $roleData = $this->roleModel->find($roleId);

        $updateData = [
            'id'           => (int) $id,
            'role_id'      => $roleId,
            'role'         => $roleData ? $roleData['kode_role'] : 'operator',
            'username'     => strtolower(trim((string) $this->request->getPost('username'))),
            'nama_lengkap' => trim((string) $this->request->getPost('nama_lengkap')),
            'email'        => strtolower(trim((string) $this->request->getPost('email'))),
        ];

        $newPassword = (string) $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->save($updateData);

        // Jika user yang diupdate adalah user yang sedang login, sinkronkan nama sesi
        if ((int) $id === (int) session('user_id')) {
            session()->set([
                'nama_lengkap' => $updateData['nama_lengkap'],
                'username'     => $updateData['username'],
                'email'        => $updateData['email'],
                'role'         => $updateData['role'],
                'role_name'    => $roleData ? $roleData['nama_role'] : ucfirst($updateData['role']),
            ]);
        }

        return redirect()->to(base_url('users'))->with('success', 'Data Akun Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus Akun Pengguna dengan proteksi diri dan akun utama
     */
    public function delete($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))->with('error', 'Data Akun Pengguna tidak ditemukan.');
        }

        // Tidak boleh menghapus akun yang sedang dipakai login
        if ((int) $id === (int) session('user_id')) {
            return redirect()->to(base_url('users'))->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.');
        }

        // Tidak boleh menghapus admin utama
        if ((int) $id === 1) {
            return redirect()->to(base_url('users'))->with('error', 'Akun Administrator Utama dilindungi dan tidak dapat dihapus.');
        }

        $this->userModel->delete($id);

        return redirect()->to(base_url('users'))->with('success', "Akun Pengguna \"{$user['nama_lengkap']}\" berhasil dihapus.");
    }
}
