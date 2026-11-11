<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Welcome Header Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-primary bg-gradient text-white border-0 shadow-sm overflow-hidden position-relative p-4" style="background: linear-gradient(135deg, #1e1e2d 0%, #151521 100%) !important;">
            <div class="position-absolute end-0 bottom-0 opacity-10 pe-4 pb-2 d-none d-md-block">
                <i class="fa-solid fa-car-rear" style="font-size: 160px; color: #ffffff;"></i>
            </div>
            <div class="position-relative z-1">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-50 px-3 py-1 rounded-pill mb-2">
                            <i class="fa-solid fa-layer-group me-1"></i> Sistem Manajemen Aset Daerah
                        </span>
                        <h2 class="h3 fw-bold mb-1 text-white">Sistem Pengelolaan Kendaraan Dinas Operasional (KDO)</h2>
                        <p class="text-white-50 mb-0" style="font-size: 0.95rem;">
                            Monitoring status aset, kelaikan armada operasional, dan riwayat pemeliharaan Barang Milik Daerah (BMD).
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= base_url('kendaraan/create') ?>" class="btn btn-primary px-3 py-2 shadow-sm rounded-3">
                            <i class="fa-solid fa-circle-plus me-1"></i> Catat Unit KDO
                        </a>
                        <a href="<?= base_url('pemeliharaan/create') ?>" class="btn btn-light px-3 py-2 shadow-sm rounded-3">
                            <i class="fa-solid fa-wrench me-1"></i> Input Servis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4 Statistic Summary Cards -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total KDO -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-start border-4 border-primary">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">Total Armada KDO</span>
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-cars fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= esc($stats['total']) ?></h3>
                    <span class="text-muted small">Unit Aset</span>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center text-muted small">
                    <span>Tersebar di <?= esc($totalInstansi) ?> Instansi</span>
                    <a href="<?= base_url('kendaraan') ?>" class="text-primary text-decoration-none fw-semibold">Lihat &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Kondisi Baik -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-start border-4 border-success">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">Kondisi Baik</span>
                    <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-shield-check fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <h3 class="fw-bold mb-0 text-success"><?= esc($stats['baik']) ?></h3>
                    <span class="text-muted small">Unit Siap Jalan</span>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center text-muted small">
                    <span class="text-success fw-medium">
                        <?= ($stats['total'] > 0) ? round(($stats['baik'] / $stats['total']) * 100, 1) : 0 ?>% dari total armada
                    </span>
                    <a href="<?= base_url('kendaraan?kondisi=Baik') ?>" class="text-success text-decoration-none fw-semibold">Filter &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Rusak Ringan -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-start border-4 border-warning">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">Rusak Ringan</span>
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <h3 class="fw-bold mb-0 text-warning"><?= esc($stats['rusak_ringan']) ?></h3>
                    <span class="text-muted small">Perlu Perawatan</span>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center text-muted small">
                    <span class="text-warning fw-medium">Jadwalkan Servis</span>
                    <a href="<?= base_url('kendaraan?kondisi=Rusak+Ringan') ?>" class="text-warning text-decoration-none fw-semibold">Filter &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Rusak Berat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-start border-4 border-danger">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted fw-semibold fs-7 text-uppercase tracking-wider">Rusak Berat</span>
                    <div class="rounded-3 p-3 bg-danger bg-opacity-10 text-danger">
                        <i class="fa-solid fa-circle-xmark fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <h3 class="fw-bold mb-0 text-danger"><?= esc($stats['rusak_berat']) ?></h3>
                    <span class="text-muted small">Unit Non-Operasional</span>
                </div>
                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center text-muted small">
                    <span class="text-danger fw-medium">Perlu Overhaul / Lelang</span>
                    <a href="<?= base_url('kendaraan?kondisi=Rusak+Berat') ?>" class="text-danger text-decoration-none fw-semibold">Filter &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Charts Section -->
<div class="row g-4 mb-4">
    <!-- Donut Chart: Komposisi Kondisi Armada KDO -->
    <div class="col-lg-5">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-primary fs-5"></i>
                    <h6 class="mb-0 fw-bold text-dark">Komposisi Kondisi KDO</h6>
                </div>
                <span class="badge bg-light text-secondary border">Persentase Kelaikan</span>
            </div>
            <div class="card-body d-flex flex-column justify-content-center p-4">
                <div style="position: relative; height: 260px;">
                    <canvas id="kondisiDonutChart"></canvas>
                </div>
                <div class="row text-center mt-3 pt-2 border-top g-2">
                    <div class="col-4">
                        <small class="text-muted d-block" style="font-size: 11px;">Baik</small>
                        <span class="fw-bold text-success fs-6"><?= esc($stats['baik']) ?> Unit</span>
                    </div>
                    <div class="col-4 border-start border-end">
                        <small class="text-muted d-block" style="font-size: 11px;">Rusak Ringan</small>
                        <span class="fw-bold text-warning fs-6"><?= esc($stats['rusak_ringan']) ?> Unit</span>
                    </div>
                    <div class="col-4">
                        <small class="text-muted d-block" style="font-size: 11px;">Rusak Berat</small>
                        <span class="fw-bold text-danger fs-6"><?= esc($stats['rusak_berat']) ?> Unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart: Distribusi Kendaraan per Perangkat Daerah -->
    <div class="col-lg-7">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chart-column text-primary fs-5"></i>
                    <h6 class="mb-0 fw-bold text-dark">Distribusi Armada per Perangkat Daerah</h6>
                </div>
                <span class="badge bg-light text-secondary border">Inventaris Instansi</span>
            </div>
            <div class="card-body p-4">
                <div style="position: relative; height: 290px;">
                    <canvas id="instansiBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table: 5 Armada Butuh Perbaikan / Servis -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-danger bg-opacity-10 text-danger rounded-2">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Armada Butuh Perbaikan / Pemeliharaan Terkini</h6>
                        <small class="text-muted" style="font-size: 12px;">Daftar unit KDO dengan status kondisi Rusak Ringan atau Rusak Berat</small>
                    </div>
                </div>
                <a href="<?= base_url('kendaraan?kondisi=Rusak+Ringan') ?>" class="btn btn-outline-secondary btn-sm rounded-2">
                    Lihat Seluruh Kendaraan Bermasalah &rarr;
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No. Polisi</th>
                            <th>Merk & Model</th>
                            <th>Perangkat Daerah</th>
                            <th>Penanggung Jawab PNS</th>
                            <th>Tahun</th>
                            <th>Status Kondisi</th>
                            <th class="text-end pe-4">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kendaraanPerbaikan)): ?>
                            <?php foreach ($kendaraanPerbaikan as $kdo): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="plat-nomor-dinas"><?= esc($kdo['nomor_polisi']) ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= esc($kdo['merk']) ?> <?= esc($kdo['tipe_model']) ?></div>
                                        <small class="text-muted"><?= esc($kdo['warna']) ?></small>
                                    </td>
                                    <td>
                                        <span class="text-secondary fw-medium"><?= esc($kdo['nama_instansi']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($kdo['nama_pegawai'])): ?>
                                            <div class="fw-medium text-dark"><i class="fa-solid fa-user-check text-success me-1"></i><?= esc($kdo['nama_pegawai']) ?></div>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border">Pool Kendaraan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($kdo['tahun_produksi']) ?></td>
                                    <td>
                                        <?php if ($kdo['kondisi'] === 'Rusak Berat'): ?>
                                            <span class="badge badge-subtle-danger px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fa-solid fa-circle-xmark me-1"></i> Rusak Berat
                                            </span>
                                        <?php elseif ($kdo['kondisi'] === 'Rusak Ringan'): ?>
                                            <span class="badge badge-subtle-warning px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fa-solid fa-triangle-exclamation me-1"></i> Rusak Ringan
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-subtle-success px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fa-solid fa-circle-check me-1"></i> Baik
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('kendaraan/detail/' . $kdo['id']) ?>" class="btn btn-light border text-primary" title="Detail Unit">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('pemeliharaan/create?kendaraan_id=' . $kdo['id']) ?>" class="btn btn-warning text-dark" title="Input Servis">
                                                <i class="fa-solid fa-wrench me-1"></i> Servis
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-circle-check text-success fs-3 d-block mb-2"></i>
                                    Alhamdulillah, saat ini seluruh armada KDO berada dalam kondisi Baik!
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data dari Controller
        const kondisiData = <?= $chartKondisi ?>;
        const instansiData = <?= $chartPerangkatDaerah ?>;

        // 1. Inisialisasi Donut Chart (Kondisi KDO)
        const ctxDonut = document.getElementById('kondisiDonutChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: kondisiData.labels,
                datasets: [{
                    data: kondisiData.data,
                    backgroundColor: kondisiData.colors,
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            usePointStyle: true,
                            font: { family: 'Plus Jakarta Sans', size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const val = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((val / total) * 100) : 0;
                                return ` ${context.label}: ${val} Unit (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // 2. Inisialisasi Bar Chart (Distribusi Perangkat Daerah)
        const ctxBar = document.getElementById('instansiBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: instansiData.labels,
                datasets: [{
                    label: 'Jumlah Unit KDO',
                    data: instansiData.datasets,
                    backgroundColor: '#3699ff',
                    borderRadius: 6,
                    maxBarThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { family: 'Plus Jakarta Sans' }
                        },
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        ticks: { font: { family: 'Plus Jakarta Sans', weight: '600' } },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: function(items) {
                                const idx = items[0].dataIndex;
                                return instansiData.full_names[idx] || items[0].label;
                            },
                            label: function(context) {
                                return ` Total Armada: ${context.raw} Unit KDO`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>

