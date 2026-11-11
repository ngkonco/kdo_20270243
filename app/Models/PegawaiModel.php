<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'perangkat_daerah_id',
        'nip',
        'nama_pegawai',
        'jabatan',
        'golongan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'id'                  => 'permit_empty|is_natural_no_zero',
        'perangkat_daerah_id' => 'required|is_not_unique[perangkat_daerah.id]',
        'nip'                 => 'required|numeric|exact_length[18]|is_unique[pegawai.nip,id,{id}]',
        'nama_pegawai'        => 'required|min_length[3]|max_length[100]',
        'jabatan'             => 'required|min_length[3]|max_length[100]',
        'golongan'            => 'required|max_length[10]',
    ];

    protected $validationMessages = [
        'perangkat_daerah_id' => [
            'required'      => 'Perangkat Daerah wajib dipilih.',
            'is_not_unique' => 'Perangkat Daerah yang dipilih tidak valid.',
        ],
        'nip' => [
            'required'     => 'NIP PNS wajib diisi.',
            'numeric'      => 'NIP harus berupa angka.',
            'exact_length' => 'NIP harus tepat berjumlah 18 digit angka.',
            'is_unique'    => 'NIP sudah terdaftar pada sistem.',
        ],
        'nama_pegawai' => [
            'required'   => 'Nama pegawai wajib diisi.',
            'min_length' => 'Nama pegawai minimal 3 karakter.',
            'max_length' => 'Nama pegawai maksimal 100 karakter.',
        ],
        'jabatan' => [
            'required'   => 'Jabatan wajib diisi.',
            'min_length' => 'Jabatan minimal 3 karakter.',
            'max_length' => 'Jabatan maksimal 100 karakter.',
        ],
        'golongan' => [
            'required'   => 'Pangkat / Golongan wajib diisi.',
            'max_length' => 'Golongan maksimal 10 karakter.',
        ],
    ];

    /**
     * Mengambil data pegawai dengan relasi nama dan kode instansi
     */
    public function getWithInstansi($id = null)
    {
        $builder = $this->select('pegawai.*, perangkat_daerah.nama_instansi, perangkat_daerah.kode_instansi')
            ->join('perangkat_daerah', 'perangkat_daerah.id = pegawai.perangkat_daerah_id', 'left');

        if ($id !== null) {
            return $builder->where('pegawai.id', $id)->first();
        }

        return $builder->orderBy('pegawai.nama_pegawai', 'ASC')->findAll();
    }

    /**
     * Mengambil daftar pegawai berdasarkan perangkat daerah tertentu
     */
    public function getByPerangkatDaerah($perangkatDaerahId)
    {
        return $this->where('perangkat_daerah_id', $perangkatDaerahId)
            ->orderBy('nama_pegawai', 'ASC')
            ->findAll();
    }
}

