<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table            = 'kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'perangkat_daerah_id',
        'pegawai_id',
        'nomor_polisi',
        'merk',
        'tipe_model',
        'tahun_produksi',
        'warna',
        'kondisi',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'perangkat_daerah_id' => 'required|is_not_unique[perangkat_daerah.id]',
        'pegawai_id'          => 'permit_empty|is_not_unique[pegawai.id]',
        'nomor_polisi'        => 'required|min_length[3]|max_length[15]|is_unique[kendaraan.nomor_polisi,id,{id}]',
        'merk'                => 'required|min_length[2]|max_length[50]',
        'tipe_model'          => 'required|min_length[2]|max_length[50]',
        'tahun_produksi'      => 'required|numeric|exact_length[4]|greater_than_equal_to[1980]|less_than_equal_to[2030]',
        'warna'               => 'required|min_length[2]|max_length[30]',
        'kondisi'             => 'required|in_list[Baik,Rusak Ringan,Rusak Berat]',
    ];

    protected $validationMessages = [
        'perangkat_daerah_id' => [
            'required'      => 'Perangkat Daerah penanggung jawab wajib dipilih.',
            'is_not_unique' => 'Perangkat Daerah tidak valid.',
        ],
        'pegawai_id' => [
            'is_not_unique' => 'Pegawai PNS yang dipilih tidak valid.',
        ],
        'nomor_polisi' => [
            'required'   => 'Nomor polisi (Plat Nomor) wajib diisi.',
            'min_length' => 'Nomor polisi minimal 3 karakter.',
            'max_length' => 'Nomor polisi maksimal 15 karakter.',
            'is_unique'  => 'Nomor polisi tersebut sudah terdaftar di sistem.',
        ],
        'merk' => [
            'required' => 'Merk kendaraan wajib diisi (contoh: Toyota, Honda).',
        ],
        'tipe_model' => [
            'required' => 'Tipe / model kendaraan wajib diisi (contoh: Avanza, Hilux).',
        ],
        'tahun_produksi' => [
            'required'               => 'Tahun produksi wajib diisi.',
            'numeric'                => 'Tahun produksi harus berupa angka 4 digit.',
            'exact_length'           => 'Tahun produksi harus 4 digit tahun (contoh: 2021).',
            'greater_than_equal_to'  => 'Tahun produksi minimal tahun 1980.',
            'less_than_equal_to'     => 'Tahun produksi tidak boleh melebihi tahun saat ini.',
        ],
        'warna' => [
            'required' => 'Warna kendaraan wajib diisi.',
        ],
        'kondisi' => [
            'required' => 'Status kondisi kendaraan wajib dipilih.',
            'in_list'  => 'Kondisi hanya boleh: Baik, Rusak Ringan, atau Rusak Berat.',
        ],
    ];

    /**
     * Mengambil detail kendaraan lengkap dengan join perangkat daerah dan pegawai
     */
    public function getKendaraanDetail($id = null)
    {
        $builder = $this->select('kendaraan.*, 
            perangkat_daerah.nama_instansi, perangkat_daerah.kode_instansi, perangkat_daerah.alamat as alamat_instansi, perangkat_daerah.no_telepon as telp_instansi,
            pegawai.nama_pegawai, pegawai.nip, pegawai.jabatan, pegawai.golongan')
            ->join('perangkat_daerah', 'perangkat_daerah.id = kendaraan.perangkat_daerah_id', 'left')
            ->join('pegawai', 'pegawai.id = kendaraan.pegawai_id', 'left');

        if ($id !== null) {
            return $builder->where('kendaraan.id', $id)->first();
        }

        return $builder->orderBy('kendaraan.id', 'DESC')->findAll();
    }

    /**
     * Filter data kendaraan dinas berdasarkan status kondisi dan perangkat daerah
     */
    public function filterKendaraan($kondisi = null, $perangkatDaerahId = null)
    {
        $builder = $this->select('kendaraan.*, 
            perangkat_daerah.nama_instansi, perangkat_daerah.kode_instansi,
            pegawai.nama_pegawai, pegawai.nip, pegawai.jabatan')
            ->join('perangkat_daerah', 'perangkat_daerah.id = kendaraan.perangkat_daerah_id', 'left')
            ->join('pegawai', 'pegawai.id = kendaraan.pegawai_id', 'left');

        if (!empty($kondisi) && in_array($kondisi, ['Baik', 'Rusak Ringan', 'Rusak Berat'])) {
            $builder->where('kendaraan.kondisi', $kondisi);
        }

        if (!empty($perangkatDaerahId)) {
            $builder->where('kendaraan.perangkat_daerah_id', (int) $perangkatDaerahId);
        }

        return $builder->orderBy('kendaraan.id', 'DESC')->findAll();
    }

    /**
     * Menghitung total ringkasan armada KDO untuk 4 Metric Cards Dashboard
     */
    public function getSummaryStats()
    {
        $totalKdo = $this->countAllResults(false);
        
        $baik = (clone $this)->where('kondisi', 'Baik')->countAllResults();
        $rusakRingan = (clone $this)->where('kondisi', 'Rusak Ringan')->countAllResults();
        $rusakBerat = (clone $this)->where('kondisi', 'Rusak Berat')->countAllResults();

        return [
            'total'        => $totalKdo,
            'baik'         => $baik,
            'rusak_ringan' => $rusakRingan,
            'rusak_berat'  => $rusakBerat,
        ];
    }

    /**
     * Data untuk Donut Chart: Komposisi Kondisi Armada KDO
     */
    public function getChartKondisi()
    {
        $stats = $this->getSummaryStats();
        return [
            'labels' => ['Kondisi Baik', 'Rusak Ringan', 'Rusak Berat'],
            'data'   => [$stats['baik'], $stats['rusak_ringan'], $stats['rusak_berat']],
            'colors' => ['#10b981', '#f59e0b', '#ef4444'], // Green, Yellow, Red
        ];
    }

    /**
     * Data untuk Bar Chart: Distribusi Kendaraan per Perangkat Daerah
     */
    public function getChartPerangkatDaerah()
    {
        $results = $this->db->table('perangkat_daerah')
            ->select('perangkat_daerah.nama_instansi, perangkat_daerah.kode_instansi, COUNT(kendaraan.id) as total')
            ->join('kendaraan', 'kendaraan.perangkat_daerah_id = perangkat_daerah.id', 'left')
            ->groupBy('perangkat_daerah.id')
            ->orderBy('total', 'DESC')
            ->get()
            ->getResultArray();

        $labels = [];
        $data   = [];

        foreach ($results as $row) {
            $labels[] = $row['kode_instansi'];
            $data[]   = (int) $row['total'];
        }

        return [
            'labels'   => $labels,
            'datasets' => $data,
            'full_names' => array_column($results, 'nama_instansi'),
        ];
    }

    /**
     * Mengambil daftar kendaraan yang membutuhkan perbaikan (Rusak Ringan & Rusak Berat)
     */
    public function getKendaraanButuhPerbaikan($limit = 5)
    {
        return $this->select('kendaraan.*, perangkat_daerah.nama_instansi, pegawai.nama_pegawai')
            ->join('perangkat_daerah', 'perangkat_daerah.id = kendaraan.perangkat_daerah_id', 'left')
            ->join('pegawai', 'pegawai.id = kendaraan.pegawai_id', 'left')
            ->whereIn('kendaraan.kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->orderBy("CASE WHEN kendaraan.kondisi = 'Rusak Berat' THEN 1 ELSE 2 END", 'ASC', false)
            ->orderBy('kendaraan.updated_at', 'DESC')
            ->findAll($limit);
    }
}

