<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\PerangkatDaerahModel;
use App\Models\PegawaiModel;
use App\Models\RiwayatPemeliharaanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DashboardController extends BaseController
{
    protected KendaraanModel $kendaraanModel;
    protected PerangkatDaerahModel $perangkatDaerahModel;
    protected PegawaiModel $pegawaiModel;
    protected RiwayatPemeliharaanModel $pemeliharaanModel;

    public function __construct()
    {
        $this->kendaraanModel          = new KendaraanModel();
        $this->perangkatDaerahModel    = new PerangkatDaerahModel();
        $this->pegawaiModel            = new PegawaiModel();
        $this->pemeliharaanModel       = new RiwayatPemeliharaanModel();
    }

    /**
     * Halaman Utama Dashboard Admin KDO - BMD
     */
    public function index()
    {
        $stats = $this->kendaraanModel->getSummaryStats();
        $chartKondisi = $this->kendaraanModel->getChartKondisi();
        $chartPerangkatDaerah = $this->kendaraanModel->getChartPerangkatDaerah();
        $kendaraanPerbaikan = $this->kendaraanModel->getKendaraanButuhPerbaikan(5);

        // Ambil data total instansi dan pegawai
        $totalInstansi = $this->perangkatDaerahModel->countAllResults();
        $totalPegawai  = $this->pegawaiModel->countAllResults();

        $data = [
            'title'                => 'Dashboard Pengelolaan KDO - BMD',
            'active_menu'          => 'dashboard',
            'stats'                => $stats,
            'totalInstansi'        => $totalInstansi,
            'totalPegawai'         => $totalPegawai,
            'chartKondisi'         => json_encode($chartKondisi),
            'chartPerangkatDaerah' => json_encode($chartPerangkatDaerah),
            'kendaraanPerbaikan'   => $kendaraanPerbaikan,
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Endpoint API untuk memuat data statistik terbaru via AJAX
     */
    public function apiStats()
    {
        $stats = $this->kendaraanModel->getSummaryStats();
        $chartKondisi = $this->kendaraanModel->getChartKondisi();
        $chartPerangkatDaerah = $this->kendaraanModel->getChartPerangkatDaerah();

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Statistik berhasil dimuat',
            'data'    => [
                'summary'              => $stats,
                'chart_kondisi'        => $chartKondisi,
                'chart_perangkat_daerah'=> $chartPerangkatDaerah,
            ],
        ]);
    }
}

