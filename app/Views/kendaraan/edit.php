<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('kendaraan') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark">Edit Data Kendaraan Dinas: <?= esc($kendaraan['nomor_polisi']) ?></h4>
        </div>
        <p class="text-muted mb-0 small mt-1">Perbarui data spesifikasi fisik atau penugasan pegawai pemegang aset.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Perubahan Data KDO</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('kendaraan/update/' . $kendaraan['id']) ?>" method="POST" id="editKdoForm">
                    <?= csrf_field() ?>

                    <div class="row g-4">
                        <!-- Bagian 1: Instansi & Pegawai Penanggung Jawab -->
                        <div class="col-12">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-building-user me-1"></i> 1. Penugasan & Kepemilikan Aset
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label for="perangkat_daerah_id" class="form-label fw-semibold text-secondary">
                                Perangkat Daerah (Instansi) <span class="text-danger">*</span>
                            </label>
                            <select name="perangkat_daerah_id" id="perangkat_daerah_id" class="form-select <?= (isset(session('errors')['perangkat_daerah_id'])) ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Perangkat Daerah --</option>
                                <?php foreach ($perangkat_daerah as $instansi): ?>
                                    <option value="<?= esc($instansi['id']) ?>" <?= (old('perangkat_daerah_id', $kendaraan['perangkat_daerah_id']) == $instansi['id']) ? 'selected' : '' ?>>
                                        [<?= esc($instansi['kode_instansi']) ?>] <?= esc($instansi['nama_instansi']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset(session('errors')['perangkat_daerah_id'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['perangkat_daerah_id']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="pegawai_id" class="form-label fw-semibold text-secondary">
                                Pegawai PNS Pemegang <small class="text-muted fw-normal">(Opsional / Kosongkan jika Pool)</small>
                            </label>
                            <select name="pegawai_id" id="pegawai_id" class="form-select <?= (isset(session('errors')['pegawai_id'])) ? 'is-invalid' : '' ?>">
                                <option value="">-- Tidak Ditugaskan (Kendaraan Pool) --</option>
                                <?php foreach ($pegawai as $p): ?>
                                    <option value="<?= esc($p['id']) ?>" <?= (old('pegawai_id', $kendaraan['pegawai_id']) == $p['id']) ? 'selected' : '' ?>>
                                        <?= esc($p['nama_pegawai']) ?> (NIP: <?= esc($p['nip']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset(session('errors')['pegawai_id'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['pegawai_id']) ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Bagian 2: Spesifikasi Kendaraan -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-car-side me-1"></i> 2. Identitas & Spesifikasi Fisik Kendaraan
                            </h6>
                        </div>

                        <div class="col-md-4">
                            <label for="nomor_polisi" class="form-label fw-semibold text-secondary">
                                Nomor Polisi (Plat Merah) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-danger"><i class="fa-solid fa-hashtag"></i></span>
                                <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control text-uppercase <?= (isset(session('errors')['nomor_polisi'])) ? 'is-invalid' : '' ?>" value="<?= old('nomor_polisi', $kendaraan['nomor_polisi']) ?>" required>
                                <?php if (isset(session('errors')['nomor_polisi'])): ?>
                                    <div class="invalid-feedback"><?= esc(session('errors')['nomor_polisi']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="merk" class="form-label fw-semibold text-secondary">
                                Merk Pabrikan <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="merk" id="merk" class="form-control <?= (isset(session('errors')['merk'])) ? 'is-invalid' : '' ?>" value="<?= old('merk', $kendaraan['merk']) ?>" required>
                            <?php if (isset(session('errors')['merk'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['merk']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="tipe_model" class="form-label fw-semibold text-secondary">
                                Tipe / Model <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="tipe_model" id="tipe_model" class="form-control <?= (isset(session('errors')['tipe_model'])) ? 'is-invalid' : '' ?>" value="<?= old('tipe_model', $kendaraan['tipe_model']) ?>" required>
                            <?php if (isset(session('errors')['tipe_model'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['tipe_model']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="tahun_produksi" class="form-label fw-semibold text-secondary">
                                Tahun Produksi <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="tahun_produksi" id="tahun_produksi" class="form-control <?= (isset(session('errors')['tahun_produksi'])) ? 'is-invalid' : '' ?>" min="1980" max="<?= date('Y') ?>" value="<?= old('tahun_produksi', $kendaraan['tahun_produksi']) ?>" required>
                            <?php if (isset(session('errors')['tahun_produksi'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['tahun_produksi']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="warna" class="form-label fw-semibold text-secondary">
                                Warna Kendaraan <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="warna" id="warna" class="form-control <?= (isset(session('errors')['warna'])) ? 'is-invalid' : '' ?>" value="<?= old('warna', $kendaraan['warna']) ?>" required>
                            <?php if (isset(session('errors')['warna'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['warna']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="kondisi" class="form-label fw-semibold text-secondary">
                                Status Kondisi Fisik <span class="text-danger">*</span>
                            </label>
                            <select name="kondisi" id="kondisi" class="form-select <?= (isset(session('errors')['kondisi'])) ? 'is-invalid' : '' ?>" required>
                                <option value="Baik" <?= (old('kondisi', $kendaraan['kondisi']) === 'Baik') ? 'selected' : '' ?>>Kondisi Baik (Siap Operasional)</option>
                                <option value="Rusak Ringan" <?= (old('kondisi', $kendaraan['kondisi']) === 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan (Perlu Servis Ringan)</option>
                                <option value="Rusak Berat" <?= (old('kondisi', $kendaraan['kondisi']) === 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat (Tidak Layak Jalan)</option>
                            </select>
                            <?php if (isset(session('errors')['kondisi'])): ?>
                                <div class="invalid-feedback"><?= esc(session('errors')['kondisi']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                        <a href="<?= base_url('kendaraan') ?>" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fa-solid fa-save me-1"></i> Perbarui Data KDO
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
    document.addEventListener("DOMContentLoaded", function() {
        const instansiSelect = document.getElementById('perangkat_daerah_id');
        const pegawaiSelect  = document.getElementById('pegawai_id');
        const initialPegawai = "<?= esc($kendaraan['pegawai_id'] ?? '') ?>";

        function filterPegawaiByInstansi(instansiId) {
            if (!instansiId) {
                pegawaiSelect.innerHTML = '<option value="">-- Tidak Ditugaskan (Kendaraan Pool) --</option>';
                return;
            }

            fetch(`<?= base_url('pegawai/by-instansi/') ?>/${instansiId}`)
                .then(response => response.json())
                .then(data => {
                    const currentVal = pegawaiSelect.value || initialPegawai;
                    pegawaiSelect.innerHTML = '<option value="">-- Tidak Ditugaskan (Kendaraan Pool) --</option>';
                    data.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p.id;
                        opt.textContent = `${p.nama_pegawai} (NIP: ${p.nip}) - ${p.jabatan}`;
                        if (p.id == currentVal) {
                            opt.selected = true;
                        }
                        pegawaiSelect.appendChild(opt);
                    });
                })
                .catch(err => console.error("Error fetching pegawai:", err));
        }

        instansiSelect.addEventListener('change', function() {
            filterPegawaiByInstansi(this.value);
        });
    });
</script>
<?= $this->endSection() ?>

