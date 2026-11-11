<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Master Pengguna Sistem</h4>
        <p class="text-muted mb-0 small">Kelola seluruh akun operator, administrator, dan pimpinan yang memiliki hak akses SIM-KDO.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('users/create') ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-user-plus"></i>
            <span class="fw-semibold">Tambah Pengguna Baru</span>
        </a>
    </div>
</div>

<!-- Statistik Ringkas Pengguna -->
<div class="row g-3 mb-4">
    <?php
        $totalUsers    = count($users);
        $totalAdmin    = 0;
        $totalOperator = 0;
        $totalPimpinan = 0;
        foreach ($users as $u) {
            $r = strtolower($u['kode_role'] ?? $u['role'] ?? '');
            if ($r === 'admin') { $totalAdmin++; }
            elseif ($r === 'operator') { $totalOperator++; }
            elseif ($r === 'pimpinan') { $totalPimpinan++; }
        }
    ?>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Pengguna</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1"><?= $totalUsers ?></h3>
                </div>
                <div class="p-3 bg-secondary bg-opacity-10 text-secondary rounded-3">
                    <i class="fa-solid fa-users fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Administrator</span>
                    <h3 class="fw-bold text-danger mb-0 mt-1"><?= $totalAdmin ?></h3>
                </div>
                <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3">
                    <i class="fa-solid fa-user-shield fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Operator Aset</span>
                    <h3 class="fw-bold text-primary mb-0 mt-1"><?= $totalOperator ?></h3>
                </div>
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="fa-solid fa-user-pen fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Pimpinan / Kepala</span>
                    <h3 class="fw-bold text-success mb-0 mt-1"><?= $totalPimpinan ?></h3>
                </div>
                <div class="p-3 bg-success bg-opacity-10 text-success rounded-3">
                    <i class="fa-solid fa-user-tie fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-users-gear text-primary fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Daftar Akun Pengguna Aktif</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($users) ?> Akun</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="userTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Pengguna & Email</th>
                        <th>Username</th>
                        <th>Role / Wewenang</th>
                        <th>Waktu Registrasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php $no = 1; foreach ($users as $u): ?>
                            <?php 
                                $isSelf = ((int)$u['id'] === (int)session('user_id'));
                                $isMainAdmin = ((int)$u['id'] === 1);
                                $roleCode = strtolower($u['kode_role'] ?? $u['role'] ?? 'operator');
                            ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light border text-primary fw-bold d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px; min-width: 38px;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                                <span><?= esc($u['nama_lengkap']) ?></span>
                                                <?php if ($isSelf): ?>
                                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-0" style="font-size: 10px;">Anda</span>
                                                <?php endif; ?>
                                            </div>
                                            <small class="text-muted"><i class="fa-regular fa-envelope me-1"></i><?= esc($u['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                        @<?= esc($u['username']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($roleCode === 'admin'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">
                                            <i class="fa-solid fa-shield-halved me-1"></i><?= esc($u['nama_role'] ?? 'Administrator') ?>
                                        </span>
                                    <?php elseif ($roleCode === 'operator'): ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                            <i class="fa-solid fa-user-pen me-1"></i><?= esc($u['nama_role'] ?? 'Operator Aset') ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">
                                            <i class="fa-solid fa-user-tie me-1"></i><?= esc($u['nama_role'] ?? 'Pimpinan') ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-secondary">
                                        <i class="fa-regular fa-calendar me-1"></i><?= !empty($u['created_at']) ? date('d M Y, H:i', strtotime($u['created_at'])) : '-' ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-subtle-success px-2 py-1 rounded-pill">
                                        <i class="fa-solid fa-circle-check me-1"></i> Aktif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-outline-primary" title="Edit Pengguna">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>
                                        <?php if (!$isSelf && !$isMainAdmin): ?>
                                            <form action="<?= base_url('users/delete/' . $u['id']) ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Pengguna <?= esc($u['nama_lengkap']) ?>" title="Hapus Pengguna">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-outline-secondary disabled" title="<?= $isSelf ? 'Akun Anda sedang aktif' : 'Akun Administrator utama dilindungi' ?>" disabled>
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
        $('#userTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari nama, email, username...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ pengguna",
                paginate: { next: "&rarr;", previous: "&larr;" }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [6] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>

