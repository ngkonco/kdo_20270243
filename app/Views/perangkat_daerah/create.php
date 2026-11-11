<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('perangkat-daerah') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark">Tambah Perangkat Daerah Baru</h4>
        </div>
        <p class="text-muted mb-0 small mt-1">Registrasi dinas atau badan pengguna aset Barang Milik Daerah.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-building-circle-check text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Data Perangkat Daerah</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('perangkat-daerah/store') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="kode_instansi" class="form-label fw-semibold text-secondary">
                                Kode Instansi / SKPD <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="kode_instansi" id="kode_instansi" class="form-control text-uppercase font-monospace <?= (isset(session('errors')['kode_instansi'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: DISKOMINFO-05" value="<?= old('kode_instansi') ?>" required>
                            <?php if (isset(session('errors')['kode_instansi'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['kode_instansi']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7">
                            <label for="nama_instansi" class="form-label fw-semibold text-secondary">
                                Nama Perangkat Daerah <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control <?= (isset(session('errors')['nama_instansi'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: Dinas Komunikasi dan Informatika" value="<?= old('nama_instansi') ?>" required>
                            <?php if (isset(session('errors')['nama_instansi'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['nama_instansi']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-12">
                            <label for="no_telepon" class="form-label fw-semibold text-secondary">
                                Nomor Telepon / Fax Kantor
                            </label>
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control <?= (isset(session('errors')['no_telepon'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: (0271) 712345" value="<?= old('no_telepon') ?>">
                            <?php if (isset(session('errors')['no_telepon'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['no_telepon']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label fw-semibold text-secondary">
                                Alamat Kantor Perangkat Daerah
                            </label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control <?= (isset(session('errors')['alamat'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: Jl. Jenderal Sudirman No. 10, Surakarta"><?= old('alamat') ?></textarea>
                            <?php if (isset(session('errors')['alamat'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['alamat']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="<?= base_url('perangkat-daerah') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fa-solid fa-save me-1"></i> Simpan Instansi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

