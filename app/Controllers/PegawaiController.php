<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\PerangkatDaerahModel;
use App\Models\KendaraanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PegawaiController extends BaseController
{
    protected PegawaiModel $pegawaiModel;
    protected PerangkatDaerahModel $perangkatDaerahModel;
    protected KendaraanModel $kendaraanModel;

    public function __construct()
    {
        $this->pegawaiModel         = new PegawaiModel();
        $this->perangkatDaerahModel = new PerangkatDaerahModel();
        $this->kendaraanModel       = new KendaraanModel();
    }

    /**
     * Menampilkan daftar pegawai PNS penanggung jawab KDO
     */
    public function index()
    {
        $data = [
            'title'       => 'Data Pegawai PNS Penanggung Jawab KDO',
            'active_menu' => 'pegawai',
            'pegawai'     => $this->pegawaiModel->getWithInstansi(),
        ];

        return view('pegawai/index', $data);
    }

    /**
     * Form tambah data pegawai
     */
    public function create()
    {
        $data = [
            'title'            => 'Tambah Pegawai PNS Baru',
            'active_menu'      => 'pegawai',
            'perangkat_daerah' => $this->perangkatDaerahModel->orderBy('nama_instansi', 'ASC')->findAll(),
            'validation'       => \Config\Services::validation(),
        ];

        return view('pegawai/create', $data);
    }

    /**
     * Menyimpan data pegawai ke database
     */
    public function store()
    {
        $postData = [
            'perangkat_daerah_id' => $this->request->getPost('perangkat_daerah_id'),
            'nip'                 => trim((string) $this->request->getPost('nip')),
            'nama_pegawai'        => trim((string) $this->request->getPost('nama_pegawai')),
            'jabatan'             => trim((string) $this->request->getPost('jabatan')),
            'golongan'            => trim((string) $this->request->getPost('golongan')),
        ];

        if (!$this->pegawaiModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->pegawaiModel->errors());
        }

        return redirect()->to(base_url('pegawai'))->with('success', 'Data Pegawai PNS berhasil ditambahkan.');
    }

    /**
     * Form edit data pegawai
     */
    public function edit($id = null)
    {
        $pegawai = $this->pegawaiModel->find($id);
        if (!$pegawai) {
            throw PageNotFoundException::forPageNotFound('Data pegawai tidak ditemukan.');
        }

        $data = [
            'title'            => 'Edit Data Pegawai PNS',
            'active_menu'      => 'pegawai',
            'pegawai'          => $pegawai,
            'perangkat_daerah' => $this->perangkatDaerahModel->orderBy('nama_instansi', 'ASC')->findAll(),
            'validation'       => \Config\Services::validation(),
        ];

        return view('pegawai/edit', $data);
    }

    /**
     * Memperbarui data pegawai
     */
    public function update($id = null)
    {
        $pegawai = $this->pegawaiModel->find($id);
        if (!$pegawai) {
            throw PageNotFoundException::forPageNotFound('Data pegawai tidak ditemukan.');
        }

        $postData = [
            'id'                  => (int) $id,
            'perangkat_daerah_id' => $this->request->getPost('perangkat_daerah_id'),
            'nip'                 => trim((string) $this->request->getPost('nip')),
            'nama_pegawai'        => trim((string) $this->request->getPost('nama_pegawai')),
            'jabatan'             => trim((string) $this->request->getPost('jabatan')),
            'golongan'            => trim((string) $this->request->getPost('golongan')),
        ];

        if (!$this->pegawaiModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->pegawaiModel->errors());
        }

        return redirect()->to(base_url('pegawai'))->with('success', 'Data Pegawai PNS berhasil diperbarui.');
    }

    /**
     * Menghapus data pegawai
     */
    public function delete($id = null)
    {
        $pegawai = $this->pegawaiModel->find($id);
        if (!$pegawai) {
            return redirect()->to(base_url('pegawai'))->with('error', 'Data pegawai tidak ditemukan.');
        }

        // Cek apakah pegawai saat ini memegang kendaraan
        $assignedKendaraan = $this->kendaraanModel->where('pegawai_id', $id)->findAll();
        if (!empty($assignedKendaraan)) {
            // Kita lepaskan relasi pegawai_id pada kendaraan (SET NULL) atau beri opsi informasi
            $this->kendaraanModel->where('pegawai_id', $id)->set(['pegawai_id' => null])->update();
        }

        $this->pegawaiModel->delete($id);
        return redirect()->to(base_url('pegawai'))->with('success', 'Data Pegawai PNS berhasil dihapus. Kendaraan terkait kini berstatus Pool.');
    }

    /**
     * Endpoint AJAX untuk memuat pegawai berdasarkan instansi terpilih (Cascading Dropdown)
     */
    public function getByInstansi($instansiId = null)
    {
        if (empty($instansiId)) {
            return $this->response->setJSON([]);
        }

        $pegawaiList = $this->pegawaiModel->getByPerangkatDaerah((int) $instansiId);
        return $this->response->setJSON($pegawaiList);
    }
}

