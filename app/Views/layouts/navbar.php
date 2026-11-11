<!-- Metronic Header / Top Navbar -->
<header class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-2 px-4 shadow-sm" style="height: 70px;">
    <div class="container-fluid px-0 d-flex justify-content-between align-items-center">
        <!-- Left: Sidebar Toggle & Page Title/Breadcrumb -->
        <div class="d-flex align-items-center gap-3">
            <button id="sidebarToggleBtn" class="btn btn-outline-secondary btn-sm rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <h1 class="h6 mb-0 fw-bold text-dark"><?= esc($title ?? 'Dashboard KDO') ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 11px;">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-decoration-none text-muted"><i class="fa-solid fa-house-chimney me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page"><?= esc($title ?? 'Dashboard') ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Right: Realtime Clock, Quick Actions, Status -->
        <div class="d-flex align-items-center gap-3">
            <!-- Digital Clock -->
            <div class="d-none d-md-flex align-items-center gap-2 px-3 py-1 bg-light rounded-pill border text-secondary" style="font-size: 12px;">
                <i class="fa-regular fa-clock text-primary"></i>
                <span id="liveClock" class="fw-semibold">11:00:00 WIB</span>
            </div>

            <!-- Database Status Indicator -->
            <div class="d-none d-lg-flex align-items-center gap-2 px-3 py-1 bg-success bg-opacity-10 text-success rounded-pill" style="font-size: 11px;">
                <span class="spinner-grow spinner-grow-sm" role="status" style="width: 8px; height: 8px;"></span>
                <span class="fw-semibold">MariaDB Connected</span>
            </div>

            <!-- Quick Add Dropdown or Action -->
            <a href="<?= base_url('kendaraan/create') ?>" class="btn btn-primary btn-sm px-3 rounded-2 shadow-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span class="d-none d-sm-inline fw-semibold">Tambah KDO</span>
            </a>

            <!-- Admin Avatar dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode(session('nama_lengkap') ?? 'Admin BMD') ?>&background=1e1e2d&color=3699ff&bold=true" alt="Avatar" width="34" height="34" class="rounded-circle shadow-sm border border-2 border-primary border-opacity-50">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2" aria-labelledby="dropdownUser" style="width: 240px;">
                    <li class="px-3 py-2 border-bottom">
                        <span class="d-block fw-bold text-dark fs-7"><?= esc(session('nama_lengkap') ?? 'Administrator BMD') ?></span>
                        <small class="text-muted d-block text-truncate" style="font-size: 11px;"><?= esc(session('email') ?? 'admin@bmd.pemda.go.id') ?></small>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 mt-1" style="font-size: 10px;">Role: <?= strtoupper(esc(session('role') ?? 'ADMIN')) ?></span>
                    </li>
                    <li><a class="dropdown-item py-2 d-flex align-items-center gap-2 text-secondary" href="<?= base_url('kendaraan') ?>"><i class="fa-solid fa-car text-primary"></i>Kelola Armada</a></li>
                    <li><a class="dropdown-item py-2 d-flex align-items-center gap-2 text-secondary" href="<?= base_url('pemeliharaan') ?>"><i class="fa-solid fa-wrench text-warning"></i>Jadwal Servis</a></li>
                    <li><a class="dropdown-item py-2 d-flex align-items-center gap-2 text-secondary" href="<?= base_url('users') ?>"><i class="fa-solid fa-users-gear text-info"></i>Master Pengguna</a></li>
                    <li><a class="dropdown-item py-2 d-flex align-items-center gap-2 text-secondary" href="<?= base_url('roles') ?>"><i class="fa-solid fa-shield-halved text-success"></i>Master Role & Hak Akses</a></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2 text-danger fw-semibold" href="<?= base_url('logout') ?>">
                            <i class="fa-solid fa-right-from-bracket"></i>Keluar (Logout)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    function updateClock() {
        const now = new Date();
        const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const timeString = now.toLocaleTimeString('id-ID', options) + ' WIB';
        const clockEl = document.getElementById('liveClock');
        if (clockEl) {
            clockEl.textContent = timeString;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

