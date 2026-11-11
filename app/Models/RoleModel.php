<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_role',
        'nama_role',
        'deskripsi',
        'hak_akses',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'id'        => 'permit_empty|is_natural_no_zero',
        'kode_role' => 'required|min_length[3]|max_length[30]|alpha_dash|is_unique[roles.kode_role,id,{id}]',
        'nama_role' => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'kode_role' => [
            'required'   => 'Kode role wajib diisi.',
            'is_unique'  => 'Kode role ini sudah digunakan oleh role lain.',
            'alpha_dash' => 'Kode role hanya boleh berisi huruf, angka, setrip (-), dan garis bawah (_).',
        ],
        'nama_role' => [
            'required' => 'Nama role wajib diisi.',
        ],
    ];

    /**
     * Mengambil seluruh data role beserta jumlah pengguna aktif yang menggunakan role tersebut
     */
    public function getRolesWithUserCount(): array
    {
        return $this->select('roles.*, COUNT(users.id) AS total_users')
            ->join('users', 'users.role_id = roles.id', 'left')
            ->groupBy('roles.id')
            ->orderBy('roles.id', 'ASC')
            ->findAll();
    }

    /**
     * Daftar modul hak akses sistem yang tersedia
     */
    public static function availablePermissions(): array
    {
        return [
            'dashboard'        => [
                'name'        => 'Dashboard Analitik',
                'description' => 'Melihat ringkasan metrik, grafik, dan unit butuh servis',
                'icon'        => 'fa-chart-pie',
            ],
            'kendaraan'        => [
                'name'        => 'Armada KDO (Aset)',
                'description' => 'Mengelola inventaris kendaraan dinas operasional daerah',
                'icon'        => 'fa-taxi',
            ],
            'pemeliharaan'     => [
                'name'        => 'Riwayat Servis',
                'description' => 'Mencatat log perbaikan, biaya servis, dan sinkronisasi kondisi',
                'icon'        => 'fa-wrench',
            ],
            'pegawai'          => [
                'name'        => 'Master Pegawai',
                'description' => 'Mengelola ASN penanggung jawab operasional kendaraan',
                'icon'        => 'fa-id-badge',
            ],
            'perangkat_daerah' => [
                'name'        => 'Master Perangkat Daerah',
                'description' => 'Mengelola SKPD dan dinas pemilik aset daerah',
                'icon'        => 'fa-building-columns',
            ],
            'roles'            => [
                'name'        => 'Master Role',
                'description' => 'Mengelola hak akses, izin modul, dan struktur peran sistem',
                'icon'        => 'fa-shield-halved',
            ],
            'users'            => [
                'name'        => 'Master Pengguna',
                'description' => 'Mengelola akun pengguna, status login, dan penugasan role',
                'icon'        => 'fa-users-gear',
            ],
        ];
    }
}
