<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Tambah Role Pengguna Baru</h4>
        <p class="text-muted mb-0 small">Definisikan nama peran baru dan atur izin akses modul sistem secara terperinci.</p>
    </div>
    <div>
        <a href="<?= base_url('roles') ?>" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Role</span>
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-shield-plus text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Pendaftaran Role</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('roles/store') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="kode_role" class="form-label fw-semibold text-dark">
                                Kode Role <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-code"></i></span>
                                <input type="text" class="form-control font-monospace <?= session('errors.kode_role') ? 'is-invalid' : '' ?>" 
                                       id="kode_role" name="kode_role" value="<?= old('kode_role') ?>" 
                                       placeholder="contoh: auditor, staf_aset" required>
                                <?php if (session('errors.kode_role')): ?>
                                    <div class="invalid-feedback"><?= session('errors.kode_role') ?></div>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted">Gunakan huruf kecil tanpa spasi (bisa strip atau underscore).</small>
                        </div>

                        <div class="col-md-6">
                            <label for="nama_role" class="form-label fw-semibold text-dark">
                                Nama Role <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-id-card-clip"></i></span>
                                <input type="text" class="form-control <?= session('errors.nama_role') ? 'is-invalid' : '' ?>" 
                                       id="nama_role" name="nama_role" value="<?= old('nama_role') ?>" 
                                       placeholder="contoh: Auditor Inspektorat Daerah" required>
                                <?php if (session('errors.nama_role')): ?>
                                    <div class="invalid-feedback"><?= session('errors.nama_role') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="deskripsi" class="form-label fw-semibold text-dark">Deskripsi Peran & Tugas</label>
                            <textarea class="form-control <?= session('errors.deskripsi') ? 'is-invalid' : '' ?>" 
                                      id="deskripsi" name="deskripsi" rows="2" 
                                      placeholder="Uraian singkat wewenang dan tanggung jawab role ini..."><?= old('deskripsi') ?></textarea>
                            <?php if (session('errors.deskripsi')): ?>
                                <div class="invalid-feedback"><?= session('errors.deskripsi') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Matriks Hak Akses Modul -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-key text-primary me-2"></i>Matriks Izin Modul (Hak Akses)</h6>
                                <small class="text-muted">Centang modul yang berhak diakses oleh role ini.</small>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-secondary" id="btnSelectAll">Pilih Semua</button>
                                <button type="button" class="btn btn-outline-secondary" id="btnDeselectAll">Batal Semua</button>
                            </div>
                        </div>

                        <div class="row g-3">
                            <?php 
                                $oldPerms = old('permissions') ?? [];
                                if (!is_array($oldPerms)) { $oldPerms = []; }
                            ?>
                            <?php foreach ($availablePermissions as $key => $perm): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 p-3 permission-card bg-light bg-opacity-50">
                                        <div class="form-check d-flex align-items-start gap-2">
                                            <input class="form-check-input permission-checkbox mt-1" type="checkbox" 
                                                   name="permissions[]" value="<?= esc($key) ?>" 
                                                   id="perm_<?= esc($key) ?>"
                                                   <?= in_array($key, $oldPerms, true) ? 'checked' : '' ?>>
                                            <label class="form-check-label w-100" for="perm_<?= esc($key) ?>" style="cursor: pointer;">
                                                <div class="fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                                                    <i class="fa-solid <?= esc($perm['icon']) ?> text-primary"></i>
                                                    <span><?= esc($perm['name']) ?></span>
                                                </div>
                                                <small class="text-muted d-block lh-sm"><?= esc($perm['description']) ?></small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="<?= base_url('roles') ?>" class="btn btn-light px-4 py-2 border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center gap-2 shadow-sm">
                            <i class="fa-solid fa-save"></i>
                            <span class="fw-semibold">Simpan Role Baru</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('btnSelectAll').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = true);
    });
    document.getElementById('btnDeselectAll').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = false);
    });
</script>
<?= $this->endSection() ?>

