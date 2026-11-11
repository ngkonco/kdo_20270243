<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Master Role & Hak Akses</h4>
        <p class="text-muted mb-0 small">Kelola tingkatan wewenang pengguna dan matriks hak akses modul dalam SIM-KDO.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('roles/create') ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-plus-circle"></i>
            <span class="fw-semibold">Tambah Role Baru</span>
        </a>
    </div>
</div>

<!-- Statistik Ringkas Role -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Role Terdaftar</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1"><?= count($roles) ?></h3>
                </div>
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="fa-solid fa-shield-halved fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Role Tingkat Tinggi</span>
                    <h3 class="fw-bold text-danger mb-0 mt-1">Administrator</h3>
                </div>
                <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3">
                    <i class="fa-solid fa-user-shield fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Operasional Akses</span>
                    <h3 class="fw-bold text-success mb-0 mt-1">Role-Based Access</h3>
                </div>
                <div class="p-3 bg-success bg-opacity-10 text-success rounded-3">
                    <i class="fa-solid fa-lock-open fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-shield-cat text-primary fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Daftar Role & Wewenang Modul</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($roles) ?> Role</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="roleTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 140px;">Kode Role</th>
                        <th>Nama Role & Keterangan</th>
                        <th>Cakupan Hak Akses Modul</th>
                        <th class="text-center" style="width: 130px;">Pengguna Aktif</th>
                        <th class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($roles)): ?>
                        <?php $no = 1; foreach ($roles as $r): ?>
                            <?php 
                                $perms = !empty($r['hak_akses']) ? json_decode($r['hak_akses'], true) : [];
                                if (!is_array($perms)) { $perms = []; }
                            ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <?php if ($r['kode_role'] === 'admin'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 font-monospace">
                                            <i class="fa-solid fa-crown me-1"></i><?= esc($r['kode_role']) ?>
                                        </span>
                                    <?php elseif ($r['kode_role'] === 'operator'): ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 font-monospace">
                                            <i class="fa-solid fa-user-pen me-1"></i><?= esc($r['kode_role']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 font-monospace">
                                            <i class="fa-solid fa-user-tie me-1"></i><?= esc($r['kode_role']) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($r['nama_role']) ?></div>
                                    <small class="text-muted"><?= esc($r['deskripsi'] ?? 'Tidak ada keterangan.') ?></small>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php if (!empty($perms)): ?>
                                            <?php foreach ($perms as $permKey): ?>
                                                <?php $permInfo = $availablePermissions[$permKey] ?? null; ?>
                                                <span class="badge bg-light text-secondary border px-2 py-1 rounded-2" style="font-size: 11px;">
                                                    <i class="fa-solid <?= $permInfo ? esc($permInfo['icon']) : 'fa-check' ?> text-primary me-1"></i>
                                                    <?= $permInfo ? esc($permInfo['name']) : esc($permKey) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted small fst-italic">Belum ada modul yang diizinkan</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
                                        <i class="fa-solid fa-users text-primary me-1"></i> <?= esc($r['total_users']) ?> Akun
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('roles/edit/' . $r['id']) ?>" class="btn btn-outline-primary" title="Edit Role">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <?php if ($r['kode_role'] !== 'admin' && (int)$r['id'] !== 1): ?>
                                            <form action="<?= base_url('roles/delete/' . $r['id']) ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Role <?= esc($r['nama_role']) ?>" title="Hapus Role">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-outline-secondary disabled" title="Role Default Terkunci" disabled>
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#roleTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari nama atau kode role...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ role",
                paginate: { next: "&rarr;", previous: "&larr;" }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [3, 5] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>

