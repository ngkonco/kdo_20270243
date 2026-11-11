<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'role_id',
        'username',
        'nama_lengkap',
        'email',
        'password',
        'role',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'id'           => 'permit_empty|is_natural_no_zero',
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'email'        => 'required|valid_email|is_unique[users.email,id,{id}]',
        'role_id'      => 'required|is_not_unique[roles.id]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'  => 'Username wajib diisi.',
            'is_unique' => 'Username ini sudah terdaftar. Silakan pilih username lain.',
        ],
        'nama_lengkap' => [
            'required' => 'Nama lengkap pengguna wajib diisi.',
        ],
        'email' => [
            'required'    => 'Alamat email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique'   => 'Alamat email ini sudah terdaftar.',
        ],
        'role_id' => [
            'required'      => 'Role pengguna wajib dipilih.',
            'is_not_unique' => 'Role yang dipilih tidak valid di database.',
        ],
    ];

    /**
     * Mengambil seluruh data pengguna dengan informasi role relasional
     */
    public function getUsersWithRole(): array
    {
        return $this->select('users.*, roles.nama_role, roles.kode_role, roles.deskripsi AS role_deskripsi')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->orderBy('users.id', 'ASC')
            ->findAll();
    }

    /**
     * Mencari pengguna berdasarkan username atau email beserta detail role
     */
    public function findByUsernameOrEmail(string $loginInput)
    {
        return $this->select('users.*, roles.nama_role, roles.kode_role, roles.hak_akses')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->groupStart()
                ->where('users.username', $loginInput)
                ->orWhere('users.email', $loginInput)
            ->groupEnd()
            ->first();
    }
}
