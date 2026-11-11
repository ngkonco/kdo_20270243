<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatPemeliharaanModel extends Model
{
    protected $table            = 'riwayat_pemeliharaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kendaraan_id',
        'tanggal_servis',
        'deskripsi_perbaikan',
        'biaya',
        'bengkel',
        'status_kondisi_akhir',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'kendaraan_id'         => 'required|is_not_unique[kendaraan.id]',
        'tanggal_servis'       => 'required|valid_date[Y-m-d]',
        'deskripsi_perbaikan'  => 'required|min_length[5]',
        'biaya'                => 'required|numeric|greater_than_equal_to[0]',
        'bengkel'              => 'required|min_length[3]|max_length[100]',
        'status_kondisi_akhir' => 'required|in_list[Baik,Rusak Ringan,Rusak Berat]',
    ];

    protected $validationMessages = [
        'kendaraan_id' => [
            'required'      => 'Kendaraan KDO wajib dipilih.',
            'is_not_unique' => 'Kendaraan yang dipilih tidak valid di sistem.',
        ],
        'tanggal_servis' => [
            'required'   => 'Tanggal pelaksanaan servis wajib diisi.',
            'valid_date' => 'Format tanggal servis harus YYYY-MM-DD.',
        ],
        'deskripsi_perbaikan' => [
            'required'   => 'Deskripsi perbaikan dan suku cadang wajib diisi.',
            'min_length' => 'Deskripsi perbaikan minimal 5 karakter.',
        ],
        'biaya' => [
            'required'               => 'Biaya pemeliharaan wajib diisi (minimal 0 jika garansi).',
            'numeric'                => 'Biaya harus berupa nominal angka valid.',
            'greater_than_equal_to'  => 'Biaya tidak boleh bernilai negatif.',
        ],
        'bengkel' => [
            'required'   => 'Nama bengkel / vendor pelaksana wajib diisi.',
            'min_length' => 'Nama bengkel minimal 3 karakter.',
            'max_length' => 'Nama bengkel maksimal 100 karakter.',
        ],
        'status_kondisi_akhir' => [
            'required' => 'Status kondisi kendaraan setelah perbaikan wajib dipilih.',
            'in_list'  => 'Status kondisi akhir harus: Baik, Rusak Ringan, atau Rusak Berat.',
        ],
    ];

    /**
     * Mengambil riwayat servis berdasarkan ID Kendaraan
     */
    public function getByKendaraanId($kendaraanId)
    {
        return $this->where('kendaraan_id', $kendaraanId)
            ->orderBy('tanggal_servis', 'DESC')
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /**
     * Mengambil semua riwayat pemeliharaan lengkap dengan relasi kendaraan, instansi, dan pegawai pemegang
     */
    public function getWithKendaraan($id = null)
    {
        $builder = $this->select('riwayat_pemeliharaan.*, 
            kendaraan.nomor_polisi, kendaraan.merk, kendaraan.tipe_model,
            perangkat_daerah.nama_instansi, perangkat_daerah.kode_instansi,
            pegawai.nama_pegawai')
            ->join('kendaraan', 'kendaraan.id = riwayat_pemeliharaan.kendaraan_id', 'inner')
            ->join('perangkat_daerah', 'perangkat_daerah.id = kendaraan.perangkat_daerah_id', 'left')
            ->join('pegawai', 'pegawai.id = kendaraan.pegawai_id', 'left');

        if ($id !== null) {
            return $builder->where('riwayat_pemeliharaan.id', $id)->first();
        }

        return $builder->orderBy('riwayat_pemeliharaan.tanggal_servis', 'DESC')->findAll();
    }

    /**
     * Menghitung akumulasi total biaya servis untuk satu unit kendaraan
     */
    public function getTotalBiayaByKendaraan($kendaraanId)
    {
        $row = $this->selectSum('biaya', 'total_biaya')
            ->where('kendaraan_id', $kendaraanId)
            ->first();

        return (float) ($row['total_biaya'] ?? 0);
    }
}

