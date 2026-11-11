<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\PerangkatDaerahModel;
use App\Models\PegawaiModel;
use App\Models\RiwayatPemeliharaanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KendaraanController extends BaseController
{
    protected KendaraanModel $kendaraanModel;
    protected PerangkatDaerahModel $perangkatDaerahModel;
    protected PegawaiModel $pegawaiModel;
    protected RiwayatPemeliharaanModel $pemeliharaanModel;

    public function __construct()
    {
        $this->kendaraanModel       = new KendaraanModel();
        $this->perangkatDaerahModel = new PerangkatDaerahModel();
        $this->pegawaiModel         = new PegawaiModel();
        $this->pemeliharaanModel    = new RiwayatPemeliharaanModel();
    }

    /**
     * Menampilkan daftar armada KDO dengan filter kondisi & instansi
     */
    public function index()
    {
        $kondisiFilter  = $this->request->getGet('kondisi');
        $instansiFilter = $this->request->getGet('perangkat_daerah_id');

        $kendaraanList = $this->kendaraanModel->filterKendaraan($kondisiFilter, $instansiFilter);
        $perangkatDaerahList = $this->perangkatDaerahModel->orderBy('nama_instansi', 'ASC')->findAll();

        $data = [
            'title'               => 'Daftar Kendaraan Dinas Operasional (KDO)',
            'active_menu'         => 'kendaraan',
            'kendaraan'           => $kendaraanList,
            'perangkat_daerah'    => $perangkatDaerahList,
            'selected_kondisi'    => $kondisiFilter,
            'selected_instansi'   => $instansiFilter,
        ];

        return view('kendaraan/index', $data);
    }

    /**
     * Menampilkan detail spesifikasi unit KDO, penanggung jawab, instansi, dan riwayat pemeliharaan
     */
    public function detail($id = null)
    {
        $kendaraan = $this->kendaraanModel->getKendaraanDetail($id);
        if (!$kendaraan) {
            throw PageNotFoundException::forPageNotFound('Data Kendaraan Dinas tidak ditemukan.');
        }

        // Ambil riwayat pemeliharaan dan total biaya
        $riwayatList = $this->pemeliharaanModel->getByKendaraanId($id);
        $totalBiaya  = $this->pemeliharaanModel->getTotalBiayaByKendaraan($id);

        $data = [
            'title'        => 'Detail Unit KDO: ' . $kendaraan['nomor_polisi'],
            'active_menu'  => 'kendaraan',
            'kendaraan'    => $kendaraan,
            'riwayatList'  => $riwayatList,
            'totalBiaya'   => $totalBiaya,
        ];

        return view('kendaraan/detail', $data);
    }

    /**
     * Form tambah unit kendaraan dinas baru
     */
    public function create()
    {
        $perangkatDaerahList = $this->perangkatDaerahModel->orderBy('nama_instansi', 'ASC')->findAll();
        $pegawaiList         = $this->pegawaiModel->orderBy('nama_pegawai', 'ASC')->findAll();

        $data = [
            'title'            => 'Pencatatan Unit KDO Baru',
            'active_menu'      => 'kendaraan',
            'perangkat_daerah' => $perangkatDaerahList,
            'pegawai'          => $pegawaiList,
            'validation'       => \Config\Services::validation(),
        ];

        return view('kendaraan/create', $data);
    }

    /**
     * Menyimpan data kendaraan dinas ke database
     */
    public function store()
    {
        $pegawaiId = $this->request->getPost('pegawai_id');
        $pegawaiId = (!empty($pegawaiId) && is_numeric($pegawaiId)) ? (int) $pegawaiId : null;

        $postData = [
            'perangkat_daerah_id' => $this->request->getPost('perangkat_daerah_id'),
            'pegawai_id'          => $pegawaiId,
            'nomor_polisi'        => strtoupper(trim((string) $this->request->getPost('nomor_polisi'))),
            'merk'                => trim((string) $this->request->getPost('merk')),
            'tipe_model'          => trim((string) $this->request->getPost('tipe_model')),
            'tahun_produksi'      => $this->request->getPost('tahun_produksi'),
            'warna'               => trim((string) $this->request->getPost('warna')),
            'kondisi'             => $this->request->getPost('kondisi'),
        ];

        if (!$this->kendaraanModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->kendaraanModel->errors());
        }

        return redirect()->to(base_url('kendaraan'))->with('success', 'Unit Kendaraan Dinas berhasil didaftarkan.');
    }

    /**
     * Form edit kendaraan dinas
     */
    public function edit($id = null)
    {
        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            throw PageNotFoundException::forPageNotFound('Data Kendaraan Dinas tidak ditemukan.');
        }

        $perangkatDaerahList = $this->perangkatDaerahModel->orderBy('nama_instansi', 'ASC')->findAll();
        // Ambil pegawai milik instansi terkait
        $pegawaiList = $this->pegawaiModel->getByPerangkatDaerah($kendaraan['perangkat_daerah_id']);

        $data = [
            'title'            => 'Edit Data Kendaraan Dinas',
            'active_menu'      => 'kendaraan',
            'kendaraan'        => $kendaraan,
            'perangkat_daerah' => $perangkatDaerahList,
            'pegawai'          => $pegawaiList,
            'validation'       => \Config\Services::validation(),
        ];

        return view('kendaraan/edit', $data);
    }

    /**
     * Memperbarui data kendaraan dinas
     */
    public function update($id = null)
    {
        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            throw PageNotFoundException::forPageNotFound('Data Kendaraan Dinas tidak ditemukan.');
        }

        $pegawaiId = $this->request->getPost('pegawai_id');
        $pegawaiId = (!empty($pegawaiId) && is_numeric($pegawaiId)) ? (int) $pegawaiId : null;

        $postData = [
            'id'                  => (int) $id,
            'perangkat_daerah_id' => $this->request->getPost('perangkat_daerah_id'),
            'pegawai_id'          => $pegawaiId,
            'nomor_polisi'        => strtoupper(trim((string) $this->request->getPost('nomor_polisi'))),
            'merk'                => trim((string) $this->request->getPost('merk')),
            'tipe_model'          => trim((string) $this->request->getPost('tipe_model')),
            'tahun_produksi'      => $this->request->getPost('tahun_produksi'),
            'warna'               => trim((string) $this->request->getPost('warna')),
            'kondisi'             => $this->request->getPost('kondisi'),
        ];

        if (!$this->kendaraanModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->kendaraanModel->errors());
        }

        return redirect()->to(base_url('kendaraan'))->with('success', 'Data Kendaraan Dinas berhasil diperbarui.');
    }

    /**
     * Menghapus unit kendaraan dinas
     */
    public function delete($id = null)
    {
        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'Data Kendaraan Dinas tidak ditemukan.');
        }

        $this->kendaraanModel->delete($id);
        return redirect()->to(base_url('kendaraan'))->with('success', 'Unit Kendaraan Dinas berhasil dihapus dari inventaris.');
    }

    /**
     * Endpoint API JSON untuk filter kendaraan via AJAX
     */
    public function filterData()
    {
        $kondisi   = $this->request->getGet('kondisi');
        $instansi  = $this->request->getGet('perangkat_daerah_id');

        $data = $this->kendaraanModel->filterKendaraan($kondisi, $instansi);

        return $this->response->setJSON([
            'status' => 'success',
            'count'  => count($data),
            'data'   => $data,
        ]);
    }
}

