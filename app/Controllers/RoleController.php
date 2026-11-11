<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RoleController extends BaseController
{
    protected RoleModel $roleModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->userModel = new UserModel();
    }

    /**
     * Menampilkan daftar seluruh Role dan hak akses sistem
     */
    public function index()
    {
        $roles = $this->roleModel->getRolesWithUserCount();

        $data = [
            'title'                => 'Master Role & Hak Akses',
            'active_menu'          => 'roles',
            'roles'                => $roles,
            'availablePermissions' => RoleModel::availablePermissions(),
        ];

        return view('roles/index', $data);
    }

    /**
     * Form pembuatan Role baru
     */
    public function create()
    {
        $data = [
            'title'                => 'Tambah Role Pengguna Baru',
            'active_menu'          => 'roles',
            'validation'           => \Config\Services::validation(),
            'availablePermissions' => RoleModel::availablePermissions(),
        ];

        return view('roles/create', $data);
    }

    /**
     * Menyimpan Role baru ke database
     */
    public function store()
    {
        $rules = [
            'kode_role' => 'required|min_length[3]|max_length[30]|alpha_dash|is_unique[roles.kode_role]',
            'nama_role' => 'required|min_length[3]|max_length[100]',
            'deskripsi' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permissions = $this->request->getPost('permissions') ?? [];
        if (!is_array($permissions)) {
            $permissions = [];
        }

        $saveData = [
            'kode_role' => strtolower(trim((string) $this->request->getPost('kode_role'))),
            'nama_role' => trim((string) $this->request->getPost('nama_role')),
            'deskripsi' => trim((string) $this->request->getPost('deskripsi')),
            'hak_akses' => json_encode(array_values($permissions)),
        ];

        $this->roleModel->skipValidation(true)->save($saveData);

        return redirect()->to(base_url('roles'))->with('success', 'Role baru berhasil ditambahkan ke sistem.');
    }

    /**
     * Form edit Role
     */
    public function edit($id = null)
    {
        $role = $this->roleModel->find($id);
        if (!$role) {
            throw PageNotFoundException::forPageNotFound('Data Role tidak ditemukan.');
        }

        $rolePermissions = !empty($role['hak_akses']) ? json_decode($role['hak_akses'], true) : [];

        $data = [
            'title'                => 'Edit Role: ' . $role['nama_role'],
            'active_menu'          => 'roles',
            'role'                 => $role,
            'rolePermissions'      => is_array($rolePermissions) ? $rolePermissions : [],
            'availablePermissions' => RoleModel::availablePermissions(),
            'validation'           => \Config\Services::validation(),
        ];

        return view('roles/edit', $data);
    }

    /**
     * Memperbarui data Role
     */
    public function update($id = null)
    {
        $role = $this->roleModel->find($id);
        if (!$role) {
            return redirect()->to(base_url('roles'))->with('error', 'Data Role tidak ditemukan.');
        }

        $rules = [
            'kode_role' => "required|min_length[3]|max_length[30]|alpha_dash|is_unique[roles.kode_role,id,{$id}]",
            'nama_role' => 'required|min_length[3]|max_length[100]',
            'deskripsi' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permissions = $this->request->getPost('permissions') ?? [];
        if (!is_array($permissions)) {
            $permissions = [];
        }

        $saveData = [
            'id'        => (int) $id,
            'kode_role' => strtolower(trim((string) $this->request->getPost('kode_role'))),
            'nama_role' => trim((string) $this->request->getPost('nama_role')),
            'deskripsi' => trim((string) $this->request->getPost('deskripsi')),
            'hak_akses' => json_encode(array_values($permissions)),
        ];

        $this->roleModel->skipValidation(true)->save($saveData);

        return redirect()->to(base_url('roles'))->with('success', 'Data Role berhasil diperbarui.');
    }

    /**
     * Menghapus Role dengan proteksi integritas data
     */
    public function delete($id = null)
    {
        $role = $this->roleModel->find($id);
        if (!$role) {
            return redirect()->to(base_url('roles'))->with('error', 'Data Role tidak ditemukan.');
        }

        // Proteksi role bawaan 'admin'
        if ($role['kode_role'] === 'admin' || (int) $id === 1) {
            return redirect()->to(base_url('roles'))->with('error', 'Role Administrator bawaan sistem dilindungi dan tidak dapat dihapus.');
        }

        // Cek apakah masih ada user yang terhubung dengan role ini
        $userCount = $this->userModel->where('role_id', $id)->countAllResults();
        if ($userCount > 0) {
            return redirect()->to(base_url('roles'))->with('error', "Role \"{$role['nama_role']}\" tidak dapat dihapus karena masih digunakan oleh {$userCount} akun pengguna aktif. Silakan alihkan role pengguna terkait terlebih dahulu.");
        }

        $this->roleModel->delete($id);

        return redirect()->to(base_url('roles'))->with('success', "Role \"{$role['nama_role']}\" berhasil dihapus.");
    }
}
