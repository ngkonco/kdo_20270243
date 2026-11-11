<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Tambah Pengguna Baru</h4>
        <p class="text-muted mb-0 small">Daftarkan akun operator atau pejabat baru untuk mengakses SIM-KDO.</p>
    </div>
    <div>
        <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Pengguna</span>
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-user-plus text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Formulir Registrasi Akun</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('users/store') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label fw-semibold text-dark">
                                Nama Lengkap & Gelar <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : '' ?>" 
                                       id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" 
                                       placeholder="contoh: Budi Setiawan, S.Kom." required>
                                <?php if (session('errors.nama_lengkap')): ?>
                                    <div class="invalid-feedback"><?= session('errors.nama_lengkap') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold text-dark">
                                Username <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-at"></i></span>
                                <input type="text" class="form-control font-monospace <?= session('errors.username') ? 'is-invalid' : '' ?>" 
                                       id="username" name="username" value="<?= old('username') ?>" 
                                       placeholder="contoh: budi_aset" required>
                                <?php if (session('errors.username')): ?>
                                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted">Huruf kecil tanpa spasi.</small>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-dark">
                                Alamat Email Kedinasan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" 
                                       id="email" name="email" value="<?= old('email') ?>" 
                                       placeholder="contoh: budi@bmd.pemda.go.id" required>
                                <?php if (session('errors.email')): ?>
                                    <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-semibold text-dark">
                                Role / Tingkat Akses <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-shield-halved"></i></span>
                                <select class="form-select <?= session('errors.role_id') ? 'is-invalid' : '' ?>" id="role_id" name="role_id" required>
                                    <option value="">-- Pilih Role Pengguna --</option>
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r['id'] ?>" <?= (old('role_id') == $r['id']) ? 'selected' : '' ?>>
                                            <?= esc($r['nama_role']) ?> (<?= esc($r['kode_role']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.role_id')): ?>
                                    <div class="invalid-feedback"><?= session('errors.role_id') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold text-dark">
                                Kata Sandi (Password) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" 
                                       id="password" name="password" placeholder="Minimal 6 karakter..." required>
                                <button type="button" class="btn btn-outline-secondary toggle-pass" data-target="password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <?php if (session('errors.password')): ?>
                                    <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="pass_confirm" class="form-label fw-semibold text-dark">
                                Konfirmasi Kata Sandi <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock-check"></i></span>
                                <input type="password" class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>" 
                                       id="pass_confirm" name="pass_confirm" placeholder="Ketik ulang kata sandi..." required>
                                <button type="button" class="btn btn-outline-secondary toggle-pass" data-target="pass_confirm">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <?php if (session('errors.pass_confirm')): ?>
                                    <div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-4 mt-3 border-top">
                        <a href="<?= base_url('users') ?>" class="btn btn-light px-4 py-2 border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center gap-2 shadow-sm">
                            <i class="fa-solid fa-user-check"></i>
                            <span class="fw-semibold">Daftarkan Pengguna</span>
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
    document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
<?= $this->endSection() ?>

