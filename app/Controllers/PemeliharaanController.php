<?php

namespace App\Controllers;

use App\Models\RiwayatPemeliharaanModel;
use App\Models\KendaraanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemeliharaanController extends BaseController
{
    protected RiwayatPemeliharaanModel $pemeliharaanModel;
    protected KendaraanModel $kendaraanModel;

    public function __construct()
    {
        $this->pemeliharaanModel = new RiwayatPemeliharaanModel();
        $this->kendaraanModel    = new KendaraanModel();
    }

    /**
     * Menampilkan seluruh daftar riwayat pemeliharaan KDO
     */
    public function index()
    {
        $data = [
            'title'       => 'Riwayat Pemeliharaan & Servis Kendaraan Dinas',
            'active_menu' => 'pemeliharaan',
            'riwayat'     => $this->pemeliharaanModel->getWithKendaraan(),
        ];

        return view('pemeliharaan/index', $data);
    }

    /**
     * Form tambah riwayat servis baru
     */
    public function create()
    {
        $selectedKendaraanId = $this->request->getGet('kendaraan_id');
        $kendaraanList       = $this->kendaraanModel->getKendaraanDetail();

        $data = [
            'title'               => 'Catat Pemeliharaan / Servis KDO',
            'active_menu'         => 'pemeliharaan',
            'kendaraan'           => $kendaraanList,
            'selectedKendaraanId' => $selectedKendaraanId,
            'validation'          => \Config\Services::validation(),
        ];

        return view('pemeliharaan/create', $data);
    }

    /**
     * Menyimpan riwayat servis dan menyelaraskan status kondisi kendaraan
     */
    public function store()
    {
        $kendaraanId        = $this->request->getPost('kendaraan_id');
        $statusKondisiAkhir = $this->request->getPost('status_kondisi_akhir');

        $postData = [
            'kendaraan_id'         => $kendaraanId,
            'tanggal_servis'       => $this->request->getPost('tanggal_servis'),
            'deskripsi_perbaikan'  => trim((string) $this->request->getPost('deskripsi_perbaikan')),
            'biaya'                => str_replace(['.', ','], ['', '.'], (string) $this->request->getPost('biaya')),
            'bengkel'              => trim((string) $this->request->getPost('bengkel')),
            'status_kondisi_akhir' => $statusKondisiAkhir,
        ];

        if (!$this->pemeliharaanModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->pemeliharaanModel->errors());
        }

        // Sinkronisasi otomatis: perbarui kondisi armada kendaraan sesuai status_kondisi_akhir
        $this->kendaraanModel->update($kendaraanId, [
            'kondisi' => $statusKondisiAkhir,
        ]);

        return redirect()->to(base_url('kendaraan/detail/' . $kendaraanId))->with('success', 'Riwayat servis berhasil dicatat & status kondisi kendaraan telah diperbarui.');
    }

    /**
     * Form edit riwayat servis
     */
    public function edit($id = null)
    {
        $riwayat = $this->pemeliharaanModel->find($id);
        if (!$riwayat) {
            throw PageNotFoundException::forPageNotFound('Data riwayat servis tidak ditemukan.');
        }

        $kendaraanList = $this->kendaraanModel->getKendaraanDetail();

        $data = [
            'title'         => 'Edit Riwayat Servis KDO',
            'active_menu'   => 'pemeliharaan',
            'riwayat'       => $riwayat,
            'kendaraan'     => $kendaraanList,
            'validation'    => \Config\Services::validation(),
        ];

        return view('pemeliharaan/edit', $data);
    }

    /**
     * Memperbarui riwayat servis
     */
    public function update($id = null)
    {
        $riwayat = $this->pemeliharaanModel->find($id);
        if (!$riwayat) {
            throw PageNotFoundException::forPageNotFound('Data riwayat servis tidak ditemukan.');
        }

        $kendaraanId        = $this->request->getPost('kendaraan_id');
        $statusKondisiAkhir = $this->request->getPost('status_kondisi_akhir');

        $postData = [
            'id'                   => (int) $id,
            'kendaraan_id'         => $kendaraanId,
            'tanggal_servis'       => $this->request->getPost('tanggal_servis'),
            'deskripsi_perbaikan'  => trim((string) $this->request->getPost('deskripsi_perbaikan')),
            'biaya'                => str_replace(['.', ','], ['', '.'], (string) $this->request->getPost('biaya')),
            'bengkel'              => trim((string) $this->request->getPost('bengkel')),
            'status_kondisi_akhir' => $statusKondisiAkhir,
        ];

        if (!$this->pemeliharaanModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->pemeliharaanModel->errors());
        }

        // Sinkronisasi status kondisi armada kendaraan
        $this->kendaraanModel->update($kendaraanId, [
            'kondisi' => $statusKondisiAkhir,
        ]);

        return redirect()->to(base_url('pemeliharaan'))->with('success', 'Data riwayat servis berhasil diperbarui.');
    }

    /**
     * Menghapus riwayat servis
     */
    public function delete($id = null)
    {
        $riwayat = $this->pemeliharaanModel->find($id);
        if (!$riwayat) {
            return redirect()->to(base_url('pemeliharaan'))->with('error', 'Data riwayat servis tidak ditemukan.');
        }

        $this->pemeliharaanModel->delete($id);
        return redirect()->to(base_url('pemeliharaan'))->with('success', 'Data riwayat servis berhasil dihapus.');
    }
}

