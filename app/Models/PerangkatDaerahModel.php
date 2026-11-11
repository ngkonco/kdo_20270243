<?php

namespace App\Models;

use CodeIgniter\Model;

class PerangkatDaerahModel extends Model
{
    protected $table            = 'perangkat_daerah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_instansi',
        'nama_instansi',
        'alamat',
        'no_telepon',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'kode_instansi' => 'required|min_length[3]|max_length[20]|is_unique[perangkat_daerah.kode_instansi,id,{id}]',
        'nama_instansi' => 'required|min_length[3]|max_length[150]',
        'alamat'        => 'permit_empty',
        'no_telepon'    => 'permit_empty|max_length[20]',
    ];

    protected $validationMessages = [
        'kode_instansi' => [
            'required'   => 'Kode instansi wajib diisi.',
            'min_length' => 'Kode instansi minimal 3 karakter.',
            'max_length' => 'Kode instansi maksimal 20 karakter.',
            'is_unique'  => 'Kode instansi sudah terdaftar di sistem.',
        ],
        'nama_instansi' => [
            'required'   => 'Nama instansi wajib diisi.',
            'min_length' => 'Nama instansi minimal 3 karakter.',
            'max_length' => 'Nama instansi maksimal 150 karakter.',
        ],
    ];

    /**
     * Mengambil daftar perangkat daerah beserta jumlah pegawai dan jumlah unit kendaraan
     */
    public function getWithCounts()
    {
        return $this->select('perangkat_daerah.*, 
            (SELECT COUNT(*) FROM pegawai WHERE pegawai.perangkat_daerah_id = perangkat_daerah.id) as total_pegawai,
            (SELECT COUNT(*) FROM kendaraan WHERE kendaraan.perangkat_daerah_id = perangkat_daerah.id) as total_kendaraan')
            ->orderBy('perangkat_daerah.nama_instansi', 'ASC')
            ->findAll();
    }
}

