<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Breadcrumb Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('kendaraan') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark">Detail Unit Kendaraan Dinas Operasional (KDO)</h4>
        </div>
        <p class="text-muted mb-0 small mt-1">Kartu inventaris aset Barang Milik Daerah (BMD) nomor register kendaraan.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('pemeliharaan/create?kendaraan_id=' . $kendaraan['id']) ?>" class="btn btn-warning text-dark px-3 py-2 rounded-3 shadow-sm fw-semibold">
            <i class="fa-solid fa-wrench me-1"></i> Catat Servis Unit Ini
        </a>
        <a href="<?= base_url('kendaraan/edit/' . $kendaraan['id']) ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm fw-semibold">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data Unit
        </a>
    </div>
</div>

<!-- Main Asset Specification Banner Card -->
<div class="card shadow-sm mb-4 border-0 overflow-hidden">
    <div class="card-body p-4 bg-white">
        <div class="row align-items-center g-4">
            <div class="col-lg-3 text-center border-end-lg">
                <div class="p-3 bg-light rounded-4 d-inline-block shadow-sm mb-3">
                    <i class="fa-solid fa-car-side text-primary" style="font-size: 70px;"></i>
                </div>
                <div>
                    <span class="plat-nomor-dinas fs-5 mb-2"><?= esc($kendaraan['nomor_polisi']) ?></span>
                </div>
                <div class="mt-2">
                    <?php if ($kendaraan['kondisi'] === 'Baik'): ?>
                        <span class="badge badge-subtle-success px-3 py-2 rounded-pill fw-semibold fs-7">
                            <i class="fa-solid fa-circle-check me-1"></i> Kondisi: Baik
                        </span>
                    <?php elseif ($kendaraan['kondisi'] === 'Rusak Ringan'): ?>
                        <span class="badge badge-subtle-warning px-3 py-2 rounded-pill fw-semibold fs-7">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Kondisi: Rusak Ringan
                        </span>
                    <?php else: ?>
                        <span class="badge badge-subtle-danger px-3 py-2 rounded-pill fw-semibold fs-7">
                            <i class="fa-solid fa-circle-xmark me-1"></i> Kondisi: Rusak Berat
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-3">
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">MERK / PABRIKAN</small>
                        <span class="fw-bold text-dark fs-6"><?= esc($kendaraan['merk']) ?></span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">TIPE & MODEL</small>
                        <span class="fw-bold text-dark fs-6"><?= esc($kendaraan['tipe_model']) ?></span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">TAHUN PRODUKSI</small>
                        <span class="fw-bold text-dark fs-6"><?= esc($kendaraan['tahun_produksi']) ?></span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">WARNA KENDARAAN</small>
                        <span class="fw-bold text-dark fs-6"><?= esc($kendaraan['warna']) ?></span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">TERCATAT SEJAK</small>
                        <span class="fw-semibold text-secondary fs-7"><?= date('d F Y', strtotime($kendaraan['created_at'] ?? 'now')) ?></span>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">STATUS PENGGUNAAN</small>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                            <?= !empty($kendaraan['nama_pegawai']) ? 'Jabatan / Operasional Dinas' : 'Pool / Operasional Umum' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Card Perangkat Daerah -->
    <div class="col-lg-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-building-columns text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Perangkat Daerah Pengguna Aset</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="fa-solid fa-landmark fs-4"></i>
                    </div>
                    <div>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary mb-1">[<?= esc($kendaraan['kode_instansi']) ?>]</span>
                        <h5 class="fw-bold text-dark mb-1"><?= esc($kendaraan['nama_instansi']) ?></h5>
                        <p class="text-muted small mb-0"><i class="fa-solid fa-location-dot me-1 text-danger"></i><?= esc($kendaraan['alamat_instansi'] ?? 'Alamat belum diatur') ?></p>
                    </div>
                </div>
                <div class="border-top pt-3 d-flex justify-content-between text-muted small">
                    <span><i class="fa-solid fa-phone me-1"></i>Kontak Kantor:</span>
                    <strong class="text-dark"><?= esc($kendaraan['telp_instansi'] ?? '-') ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Pegawai PNS Penanggung Jawab -->
    <div class="col-lg-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-id-card text-success fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">PNS Penanggung Jawab Kendaraan</h6>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($kendaraan['nama_pegawai'])): ?>
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="p-3 bg-success bg-opacity-10 text-success rounded-3">
                            <i class="fa-solid fa-user-tie fs-4"></i>
                        </div>
                        <div>
                            <span class="badge bg-success bg-opacity-10 text-success mb-1">Golongan <?= esc($kendaraan['golongan']) ?></span>
                            <h5 class="fw-bold text-dark mb-1"><?= esc($kendaraan['nama_pegawai']) ?></h5>
                            <div class="text-secondary fw-medium small mb-1"><?= esc($kendaraan['jabatan']) ?></div>
                            <small class="text-muted"><i class="fa-solid fa-fingerprint me-1"></i>NIP: <?= esc($kendaraan['nip']) ?></small>
                        </div>
                    </div>
                    <div class="border-top pt-3 d-flex justify-content-between text-muted small">
                        <span>Status Pemegang:</span>
                        <strong class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Penugasan Resmi Aktif</strong>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <div class="p-3 bg-light rounded-circle d-inline-block mb-2">
                            <i class="fa-solid fa-car-side text-secondary fs-3"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Armada Pool (Non-Perorangan)</h6>
                        <p class="small text-muted mb-0">Kendaraan ini tidak ditugaskan ke pegawai perorangan dan difungsikan sebagai kendaraan operasional pool dinas.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Card Riwayat Pemeliharaan & Servis -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-wrench text-warning fs-5"></i>
            <div>
                <h6 class="mb-0 fw-bold text-dark">Riwayat Pemeliharaan & Perbaikan Unit Ini</h6>
                <small class="text-muted">Total Pengeluaran Pemeliharaan: <strong class="text-primary">Rp <?= number_format($totalBiaya, 0, ',', '.') ?></strong></small>
            </div>
        </div>
        <a href="<?= base_url('pemeliharaan/create?kendaraan_id=' . $kendaraan['id']) ?>" class="btn btn-warning btn-sm text-dark fw-semibold">
            <i class="fa-solid fa-plus-circle me-1"></i> Tambah Catatan Servis
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 140px;">Tanggal Servis</th>
                        <th>Bengkel / Vendor</th>
                        <th>Deskripsi Perbaikan & Suku Cadang</th>
                        <th class="text-end" style="width: 160px;">Biaya (Rp)</th>
                        <th class="text-center" style="width: 140px;">Kondisi Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayatList)): ?>
                        <?php foreach ($riwayatList as $r): ?>
                            <tr>
                                <td class="ps-4 fw-semibold text-secondary">
                                    <i class="fa-regular fa-calendar-days me-1 text-primary"></i>
                                    <?= date('d/m/Y', strtotime($r['tanggal_servis'])) ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($r['bengkel']) ?></div>
                                </td>
                                <td>
                                    <span class="text-secondary"><?= nl2br(esc($r['deskripsi_perbaikan'])) ?></span>
                                </td>
                                <td class="text-end fw-bold text-dark">
                                    Rp <?= number_format((float)$r['biaya'], 0, ',', '.') ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($r['status_kondisi_akhir'] === 'Baik'): ?>
                                        <span class="badge badge-subtle-success px-3 py-1 rounded-pill fw-semibold">Baik</span>
                                    <?php elseif ($r['status_kondisi_akhir'] === 'Rusak Ringan'): ?>
                                        <span class="badge badge-subtle-warning px-3 py-1 rounded-pill fw-semibold">Rusak Ringan</span>
                                    <?php else: ?>
                                        <span class="badge badge-subtle-danger px-3 py-1 rounded-pill fw-semibold">Rusak Berat</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-clipboard-check text-muted fs-3 d-block mb-2"></i>
                                Belum ada riwayat pemeliharaan yang tercatat untuk kendaraan ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

