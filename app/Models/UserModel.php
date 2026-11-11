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
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'email'        => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'     => 'required|min_length[6]',
        'role'         => 'required|in_list[admin,operator,pimpinan]',
    ];

    /**
     * Mencari pengguna berdasarkan username atau email
     */
    public function findByUsernameOrEmail(string $loginInput)
    {
        return $this->where('username', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();
    }
}

