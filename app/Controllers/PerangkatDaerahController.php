<?php

namespace App\Controllers;

use App\Models\PerangkatDaerahModel;
use App\Models\KendaraanModel;
use App\Models\PegawaiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PerangkatDaerahController extends BaseController
{
    protected PerangkatDaerahModel $perangkatDaerahModel;
    protected KendaraanModel $kendaraanModel;
    protected PegawaiModel $pegawaiModel;

    public function __construct()
    {
        $this->perangkatDaerahModel = new PerangkatDaerahModel();
        $this->kendaraanModel       = new KendaraanModel();
        $this->pegawaiModel         = new PegawaiModel();
    }

    /**
     * Menampilkan daftar perangkat daerah
     */
    public function index()
    {
        $data = [
            'title'            => 'Master Perangkat Daerah (Instansi)',
            'active_menu'      => 'perangkat_daerah',
            'perangkat_daerah' => $this->perangkatDaerahModel->getWithCounts(),
        ];

        return view('perangkat_daerah/index', $data);
    }

    /**
     * Form tambah perangkat daerah baru
     */
    public function create()
    {
        $data = [
            'title'       => 'Tambah Perangkat Daerah Baru',
            'active_menu' => 'perangkat_daerah',
            'validation'  => \Config\Services::validation(),
        ];

        return view('perangkat_daerah/create', $data);
    }

    /**
     * Menyimpan data perangkat daerah ke database
     */
    public function store()
    {
        $postData = [
            'kode_instansi' => strtoupper(trim((string) $this->request->getPost('kode_instansi'))),
            'nama_instansi' => trim((string) $this->request->getPost('nama_instansi')),
            'alamat'        => trim((string) $this->request->getPost('alamat')),
            'no_telepon'    => trim((string) $this->request->getPost('no_telepon')),
        ];

        if (!$this->perangkatDaerahModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->perangkatDaerahModel->errors());
        }

        return redirect()->to(base_url('perangkat-daerah'))->with('success', 'Data Perangkat Daerah berhasil ditambahkan.');
    }

    /**
     * Form edit data perangkat daerah
     */
    public function edit($id = null)
    {
        $instansi = $this->perangkatDaerahModel->find($id);
        if (!$instansi) {
            throw PageNotFoundException::forPageNotFound('Perangkat Daerah tidak ditemukan.');
        }

        $data = [
            'title'       => 'Edit Perangkat Daerah',
            'active_menu' => 'perangkat_daerah',
            'instansi'    => $instansi,
            'validation'  => \Config\Services::validation(),
        ];

        return view('perangkat_daerah/edit', $data);
    }

    /**
     * Memperbarui data perangkat daerah
     */
    public function update($id = null)
    {
        $instansi = $this->perangkatDaerahModel->find($id);
        if (!$instansi) {
            throw PageNotFoundException::forPageNotFound('Perangkat Daerah tidak ditemukan.');
        }

        $postData = [
            'id'            => (int) $id,
            'kode_instansi' => strtoupper(trim((string) $this->request->getPost('kode_instansi'))),
            'nama_instansi' => trim((string) $this->request->getPost('nama_instansi')),
            'alamat'        => trim((string) $this->request->getPost('alamat')),
            'no_telepon'    => trim((string) $this->request->getPost('no_telepon')),
        ];

        if (!$this->perangkatDaerahModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->perangkatDaerahModel->errors());
        }

        return redirect()->to(base_url('perangkat-daerah'))->with('success', 'Perangkat Daerah berhasil diperbarui.');
    }

    /**
     * Menghapus data perangkat daerah dengan verifikasi relasi
     */
    public function delete($id = null)
    {
        $instansi = $this->perangkatDaerahModel->find($id);
        if (!$instansi) {
            return redirect()->to(base_url('perangkat-daerah'))->with('error', 'Perangkat Daerah tidak ditemukan.');
        }

        // Cek apakah masih memiliki kendaraan atau pegawai
        $countKendaraan = $this->kendaraanModel->where('perangkat_daerah_id', $id)->countAllResults();
        $countPegawai   = $this->pegawaiModel->where('perangkat_daerah_id', $id)->countAllResults();

        if ($countKendaraan > 0 || $countPegawai > 0) {
            return redirect()->to(base_url('perangkat-daerah'))->with(
                'error',
                "Gagal menghapus: Instansi masih memiliki {$countKendaraan} unit kendaraan dan {$countPegawai} pegawai terkait. Hapus atau pindahkan data terkait terlebih dahulu."
            );
        }

        $this->perangkatDaerahModel->delete($id);
        return redirect()->to(base_url('perangkat-daerah'))->with('success', 'Perangkat Daerah berhasil dihapus.');
    }
}

