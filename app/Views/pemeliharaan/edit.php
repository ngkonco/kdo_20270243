<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('pemeliharaan') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark">Edit Riwayat Pemeliharaan KDO</h4>
        </div>
        <p class="text-muted mb-0 small mt-1">Perbarui catatan perbaikan atau penyesuaian biaya servis kendaraan.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Perubahan Data Servis</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('pemeliharaan/update/' . $riwayat['id']) ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="kendaraan_id" class="form-label fw-semibold text-secondary">
                                Kendaraan Dinas (KDO) <span class="text-danger">*</span>
                            </label>
                            <select name="kendaraan_id" id="kendaraan_id" class="form-select <?= (isset(session('errors')['kendaraan_id'])) ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Armada Kendaraan --</option>
                                <?php foreach ($kendaraan as $k): ?>
                                    <option value="<?= esc($k['id']) ?>" <?= (old('kendaraan_id', $riwayat['kendaraan_id']) == $k['id']) ? 'selected' : '' ?>>
                                        <?= esc($k['nomor_polisi']) ?> - <?= esc($k['merk']) ?> <?= esc($k['tipe_model']) ?> (<?= esc($k['nama_instansi']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset(session('errors')['kendaraan_id'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['kendaraan_id']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_servis" class="form-label fw-semibold text-secondary">
                                Tanggal Servis <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_servis" id="tanggal_servis" class="form-control <?= (isset(session('errors')['tanggal_servis'])) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_servis', $riwayat['tanggal_servis']) ?>" required>
                            <?php if (isset(session('errors')['tanggal_servis'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['tanggal_servis']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="bengkel" class="form-label fw-semibold text-secondary">
                                Nama Bengkel / Rekanan Pelaksana <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="bengkel" id="bengkel" class="form-control <?= (isset(session('errors')['bengkel'])) ? 'is-invalid' : '' ?>" value="<?= old('bengkel', $riwayat['bengkel']) ?>" required>
                            <?php if (isset(session('errors')['bengkel'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['bengkel']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="biaya" class="form-label fw-semibold text-secondary">
                                Total Biaya Pemeliharaan (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">Rp</span>
                                <input type="number" step="0.01" min="0" name="biaya" id="biaya" class="form-control <?= (isset(session('errors')['biaya'])) ? 'is-invalid' : '' ?>" value="<?= old('biaya', (float)$riwayat['biaya']) ?>" required>
                                <?php if (isset(session('errors')['biaya'])): ?>
                                    <div class="invalid-feedback"><?= esc(session('errors')['biaya']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="status_kondisi_akhir" class="form-label fw-semibold text-secondary">
                                Status Kondisi Pasca Servis <span class="text-danger">*</span>
                            </label>
                            <select name="status_kondisi_akhir" id="status_kondisi_akhir" class="form-select <?= (isset(session('errors')['status_kondisi_akhir'])) ? 'is-invalid' : '' ?>" required>
                                <option value="Baik" <?= (old('status_kondisi_akhir', $riwayat['status_kondisi_akhir']) === 'Baik') ? 'selected' : '' ?>>Kondisi Baik (Selesai Perbaikan)</option>
                                <option value="Rusak Ringan" <?= (old('status_kondisi_akhir', $riwayat['status_kondisi_akhir']) === 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan (Masih Menunggu Suku Cadang)</option>
                                <option value="Rusak Berat" <?= (old('status_kondisi_akhir', $riwayat['status_kondisi_akhir']) === 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat (Belum Layak Jalan)</option>
                            </select>
                            <?php if (isset(session('errors')['status_kondisi_akhir'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['status_kondisi_akhir']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="deskripsi_perbaikan" class="form-label fw-semibold text-secondary">
                                Uraian Perbaikan & Rincian Suku Cadang <span class="text-danger">*</span>
                            </label>
                            <textarea name="deskripsi_perbaikan" id="deskripsi_perbaikan" rows="4" class="form-control <?= (isset(session('errors')['deskripsi_perbaikan'])) ? 'is-invalid' : '' ?>" required><?= old('deskripsi_perbaikan', $riwayat['deskripsi_perbaikan']) ?></textarea>
                            <?php if (isset(session('errors')['deskripsi_perbaikan'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['deskripsi_perbaikan']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="<?= base_url('pemeliharaan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fa-solid fa-save me-1"></i> Perbarui Catatan Servis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

