<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('pegawai') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark">Tambah Pegawai PNS Baru</h4>
        </div>
        <p class="text-muted mb-0 small mt-1">Registrasi pegawai penanggung jawab aset kendaraan dinas.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-user-plus text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Data Pegawai PNS</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('pegawai/store') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="perangkat_daerah_id" class="form-label fw-semibold text-secondary">
                                Perangkat Daerah (Instansi) <span class="text-danger">*</span>
                            </label>
                            <select name="perangkat_daerah_id" id="perangkat_daerah_id" class="form-select <?= (isset(session('errors')['perangkat_daerah_id'])) ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Perangkat Daerah --</option>
                                <?php foreach ($perangkat_daerah as $instansi): ?>
                                    <option value="<?= esc($instansi['id']) ?>" <?= (old('perangkat_daerah_id') == $instansi['id']) ? 'selected' : '' ?>>
                                        [<?= esc($instansi['kode_instansi']) ?>] <?= esc($instansi['nama_instansi']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset(session('errors')['perangkat_daerah_id'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['perangkat_daerah_id']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="nip" class="form-label fw-semibold text-secondary">
                                NIP Pegawai (18 Digit) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-fingerprint text-muted"></i></span>
                                <input type="text" name="nip" id="nip" class="form-control font-monospace <?= (isset(session('errors')['nip'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: 198005122005011003" maxlength="18" value="<?= old('nip') ?>" required>
                                <?php if (isset(session('errors')['nip'])): ?>
                                    <div class="invalid-feedback"><?= esc(session('errors')['nip']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="golongan" class="form-label fw-semibold text-secondary">
                                Pangkat / Golongan <span class="text-danger">*</span>
                            </label>
                            <select name="golongan" id="golongan" class="form-select <?= (isset(session('errors')['golongan'])) ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Golongan Ruang --</option>
                                <optgroup label="Golongan IV (Pembina)">
                                    <option value="IV/e" <?= (old('golongan') === 'IV/e') ? 'selected' : '' ?>>IV/e (Pembina Utama)</option>
                                    <option value="IV/d" <?= (old('golongan') === 'IV/d') ? 'selected' : '' ?>>IV/d (Pembina Utama Madya)</option>
                                    <option value="IV/c" <?= (old('golongan') === 'IV/c') ? 'selected' : '' ?>>IV/c (Pembina Utama Muda)</option>
                                    <option value="IV/b" <?= (old('golongan') === 'IV/b') ? 'selected' : '' ?>>IV/b (Pembina Tingkat I)</option>
                                    <option value="IV/a" <?= (old('golongan') === 'IV/a') ? 'selected' : '' ?>>IV/a (Pembina)</option>
                                </optgroup>
                                <optgroup label="Golongan III (Penata)">
                                    <option value="III/d" <?= (old('golongan') === 'III/d') ? 'selected' : '' ?>>III/d (Penata Tingkat I)</option>
                                    <option value="III/c" <?= (old('golongan') === 'III/c') ? 'selected' : '' ?>>III/c (Penata)</option>
                                    <option value="III/b" <?= (old('golongan') === 'III/b') ? 'selected' : '' ?>>III/b (Penata Muda Tingkat I)</option>
                                    <option value="III/a" <?= (old('golongan') === 'III/a') ? 'selected' : '' ?>>III/a (Penata Muda)</option>
                                </optgroup>
                                <optgroup label="Golongan II (Pengatur)">
                                    <option value="II/d" <?= (old('golongan') === 'II/d') ? 'selected' : '' ?>>II/d (Pengatur Tingkat I)</option>
                                    <option value="II/c" <?= (old('golongan') === 'II/c') ? 'selected' : '' ?>>II/c (Pengatur)</option>
                                    <option value="II/b" <?= (old('golongan') === 'II/b') ? 'selected' : '' ?>>II/b (Pengatur Muda Tingkat I)</option>
                                    <option value="II/a" <?= (old('golongan') === 'II/a') ? 'selected' : '' ?>>II/a (Pengatur Muda)</option>
                                </optgroup>
                            </select>
                            <?php if (isset(session('errors')['golongan'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['golongan']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="nama_pegawai" class="form-label fw-semibold text-secondary">
                                Nama Lengkap & Gelar <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control <?= (isset(session('errors')['nama_pegawai'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: Drs. H. Bambang Susilo, M.Pd." value="<?= old('nama_pegawai') ?>" required>
                            <?php if (isset(session('errors')['nama_pegawai'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['nama_pegawai']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="jabatan" class="form-label fw-semibold text-secondary">
                                Jabatan Struktural / Fungsional <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control <?= (isset(session('errors')['jabatan'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: Kepala Dinas / Kasubag Umum & Kepegawaian" value="<?= old('jabatan') ?>" required>
                            <?php if (isset(session('errors')['jabatan'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['jabatan']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="<?= base_url('pegawai') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fa-solid fa-save me-1"></i> Simpan Pegawai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

