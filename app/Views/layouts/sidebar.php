<!-- Metronic Style Dark Sidebar -->
<aside id="sidebar-wrapper" class="bg-dark text-white d-flex flex-column flex-shrink-0 position-fixed top-0 start-0 h-100 z-3" style="width: 260px; background-color: #1e1e2d !important; transition: all 0.3s ease; box-shadow: 2px 0 12px rgba(0,0,0,0.2);">
    <!-- Sidebar Header / Brand Logo -->
    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom border-secondary border-opacity-25" style="height: 70px;">
        <a href="<?= base_url('/') ?>" class="d-flex align-items-center text-white text-decoration-none gap-3">
            <div class="brand-icon bg-primary bg-gradient rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
                <i class="fa-solid fa-car-side text-white fs-5"></i>
            </div>
            <div class="lh-1">
                <span class="fs-6 fw-bold tracking-wide d-block text-white">SIM-KDO</span>
                <small class="text-secondary fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">BMD KAB/KOTA</small>
            </div>
        </a>
        <button id="sidebarCloseBtn" class="btn btn-sm btn-icon text-secondary d-lg-none" type="button">
            <i class="fa-solid fa-xmark fs-5"></i>
        </button>
    </div>

    <!-- User Mini Profile in Sidebar -->
    <div class="px-4 py-3 mx-3 my-3 rounded-3" style="background-color: #151521;">
        <div class="d-flex align-items-center gap-3">
            <div class="position-relative">
                <div class="rounded-circle bg-primary bg-opacity-25 text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 2px solid #3699ff;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-dark rounded-circle"></span>
            </div>
            <div class="overflow-hidden">
                <div class="text-white fw-semibold text-truncate fs-7">Administrator</div>
                <small class="text-muted d-block text-truncate" style="font-size: 11px;">Pengelola Aset BMD</small>
            </div>
        </div>
    </div>

    <!-- Navigation Menu Items -->
    <div class="sidebar-nav-container flex-grow-1 overflow-y-auto px-3 py-2">
        <div class="text-uppercase text-secondary fw-bold px-3 mb-2" style="font-size: 10px; letter-spacing: 1.2px;">Menu Utama</div>
        <ul class="nav nav-pills flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-2 <?= ($active_menu === 'dashboard') ? 'active bg-primary text-white shadow-sm' : 'text-secondary hover-dark' ?>">
                    <i class="fa-solid fa-chart-pie fs-6" style="width: 20px;"></i>
                    <span class="fw-medium fs-7">Dashboard Analitik</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-secondary fw-bold px-3 mb-2" style="font-size: 10px; letter-spacing: 1.2px;">Pengelolaan KDO</div>
        <ul class="nav nav-pills flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="<?= base_url('kendaraan') ?>" class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-2 <?= ($active_menu === 'kendaraan') ? 'active bg-primary text-white shadow-sm' : 'text-secondary hover-dark' ?>">
                    <i class="fa-solid fa-taxi fs-6" style="width: 20px;"></i>
                    <span class="fw-medium fs-7">Armada KDO (Aset)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('pemeliharaan') ?>" class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-2 <?= ($active_menu === 'pemeliharaan') ? 'active bg-primary text-white shadow-sm' : 'text-secondary hover-dark' ?>">
                    <i class="fa-solid fa-wrench fs-6" style="width: 20px;"></i>
                    <span class="fw-medium fs-7">Riwayat Servis</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-secondary fw-bold px-3 mb-2" style="font-size: 10px; letter-spacing: 1.2px;">Master Data</div>
        <ul class="nav nav-pills flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="<?= base_url('pegawai') ?>" class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-2 <?= ($active_menu === 'pegawai') ? 'active bg-primary text-white shadow-sm' : 'text-secondary hover-dark' ?>">
                    <i class="fa-solid fa-id-badge fs-6" style="width: 20px;"></i>
                    <span class="fw-medium fs-7">Pegawai PNS Pemegang</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('perangkat-daerah') ?>" class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-2 <?= ($active_menu === 'perangkat_daerah') ? 'active bg-primary text-white shadow-sm' : 'text-secondary hover-dark' ?>">
                    <i class="fa-solid fa-building-columns fs-6" style="width: 20px;"></i>
                    <span class="fw-medium fs-7">Perangkat Daerah</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Footer Badge -->
    <div class="p-3 border-top border-secondary border-opacity-25" style="background-color: #1a1a27;">
        <div class="d-flex align-items-center justify-content-between text-secondary" style="font-size: 11px;">
            <span><i class="fa-solid fa-shield-halved text-success me-1"></i> Security: Hardened</span>
            <span class="badge bg-secondary bg-opacity-25 text-light">v1.0.0</span>
        </div>
    </div>
</aside>

<style>
    .hover-dark:hover {
        background-color: #26263b;
        color: #ffffff !important;
    }
    .fs-7 {
        font-size: 0.9rem;
    }
    .sidebar-nav-container::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-nav-container::-webkit-scrollbar-thumb {
        background: #2d2d44;
        border-radius: 4px;
    }
</style>

