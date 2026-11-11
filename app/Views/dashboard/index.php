<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $totalArmada = (int) ($stats['total'] ?? 0);
    $totalBaik   = (int) ($stats['baik'] ?? 0);
    $totalRingan = (int) ($stats['rusak_ringan'] ?? 0);
    $totalBerat  = (int) ($stats['rusak_berat'] ?? 0);

    $pctBaik   = $totalArmada > 0 ? round(($totalBaik / $totalArmada) * 100, 1) : 0;
    $pctRingan = $totalArmada > 0 ? round(($totalRingan / $totalArmada) * 100, 1) : 0;
    $pctBerat  = $totalArmada > 0 ? round(($totalBerat / $totalArmada) * 100, 1) : 0;
?>

<!-- Welcome Executive Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden text-white" 
             style="background: linear-gradient(135deg, #1e1e2d 0%, #171725 100%); border-radius: 1rem; border: 1px solid rgba(255,255,255,0.06) !important;">
            <div class="card-body p-4 p-lg-5 position-relative">
                <div class="row align-items-center g-4 position-relative z-1">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" 
                             style="background: rgba(54, 153, 255, 0.15); border: 1px solid rgba(54, 153, 255, 0.3);">
                            <span class="spinner-grow spinner-grow-sm text-info" style="width: 7px; height: 7px;" role="status"></span>
                            <span class="text-info fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">SISTEM MANAJEMEN ASET DAERAH (BMD)</span>
                        </div>
                        <h2 class="h3 fw-bold mb-2 text-white tracking-wide">
                            Pengelolaan Kendaraan Dinas Operasional (KDO)
                        </h2>
                        <p class="mb-4 text-light text-opacity-75" style="max-width: 650px; font-size: 0.95rem; line-height: 1.5;">
                            Monitoring status kelaikan fisik armada, distribusi penugasan aset SKPD, serta rekapitulasi riwayat pemeliharaan secara terintegrasi dan akuntabel.
                        </p>
                        
                        <!-- Mini Highlights Row -->
                        <div class="d-flex flex-wrap gap-3 pt-1">
                            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);">
                                <i class="fa-solid fa-car-side text-primary"></i>
                                <span class="small text-light fw-medium"><strong><?= esc($totalArmada) ?></strong> Total Aset</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);">
                                <i class="fa-solid fa-building-columns text-info"></i>
                                <span class="small text-light fw-medium"><strong><?= esc($totalInstansi) ?></strong> Perangkat Daerah</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                <span class="small text-light fw-medium"><strong><?= esc($pctBaik) ?>%</strong> Kelaikan Siap Operasi</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-lg-end">
                        <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-lg-end">
                            <a href="<?= base_url('kendaraan/create') ?>" 
                               class="btn btn-primary px-4 py-2 rounded-3 shadow d-flex align-items-center justify-content-center gap-2 fw-semibold"
                               style="background: linear-gradient(135deg, #3699ff 0%, #009ef7 100%); border: none;">
                                <i class="fa-solid fa-circle-plus"></i>
                                <span>Catat Unit KDO Baru</span>
                            </a>
                            <a href="<?= base_url('pemeliharaan/create') ?>" 
                               class="btn btn-light px-4 py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2 fw-semibold text-dark border">
                                <i class="fa-solid fa-wrench text-warning"></i>
                                <span>Input Log Servis</span>
                            </a>
                            <a href="<?= base_url('kendaraan') ?>" 
                               class="btn btn-outline-light px-4 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-medium border-opacity-25" style="font-size: 0.9rem;">
                                <i class="fa-solid fa-table-list"></i>
                                <span>Inventaris Seluruh Armada</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Executive Fleet Readiness Progress Bar (Inovatif) -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3 p-3 bg-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-heart-pulse text-primary fs-5"></i>
                    <div>
                        <span class="fw-bold text-dark fs-7">Skor Kesiapan Operasional Armada (Operational Readiness Index)</span>
                        <small class="text-muted d-block" style="font-size: 11px;">Tinjauan kelaikan armada operasional siap tugas vs kebutuhan perbaikan</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3" style="font-size: 12px;">
                    <span class="d-flex align-items-center gap-1 text-success fw-semibold">
                        <i class="fa-solid fa-circle fs-8 text-success"></i> Siap Jalan (<?= esc($pctBaik) ?>%)
                    </span>
                    <span class="d-flex align-items-center gap-1 text-warning fw-semibold">
                        <i class="fa-solid fa-circle fs-8 text-warning"></i> Perawatan (<?= esc($pctRingan) ?>%)
                    </span>
                    <span class="d-flex align-items-center gap-1 text-danger fw-semibold">
                        <i class="fa-solid fa-circle fs-8 text-danger"></i> Non-Operasional (<?= esc($pctBerat) ?>%)
                    </span>
                </div>
            </div>

            <!-- Segmented Multi-Color Progress Bar -->
            <div class="progress rounded-pill shadow-inner" style="height: 12px; background-color: #f1f5f9;">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pctBaik ?>%;" 
                     aria-valuenow="<?= $pctBaik ?>" aria-valuemin="0" aria-valuemax="100" title="Kondisi Baik: <?= $pctBaik ?>%"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $pctRingan ?>%;" 
                     aria-valuenow="<?= $pctRingan ?>" aria-valuemin="0" aria-valuemax="100" title="Rusak Ringan: <?= $pctRingan ?>%"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $pctBerat ?>%;" 
                     aria-valuenow="<?= $pctBerat ?>" aria-valuemin="0" aria-valuemax="100" title="Rusak Berat: <?= $pctBerat ?>%"></div>
            </div>
        </div>
    </div>
</div>

<!-- 4 Statistic Summary Cards -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total KDO -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-0 shadow-sm rounded-3">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted fw-semibold text-uppercase tracking-wider" style="font-size: 11px;">Total Armada KDO</span>
                        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center text-white" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #3699ff 0%, #009ef7 100%);">
                            <i class="fa-solid fa-car-side fs-5"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0 text-dark"><?= esc($totalArmada) ?></h2>
                        <span class="text-muted fw-medium fs-7">Unit Terdata</span>
                    </div>
                    <small class="text-secondary d-block">Tersebar di <?= esc($totalInstansi) ?> Perangkat Daerah</small>
                </div>
                
                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                    <span class="badge bg-light text-primary border" style="font-size: 11px;">Inventaris BMD</span>
                    <a href="<?= base_url('kendaraan') ?>" class="text-primary text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                        <span>Lihat Semua</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Kondisi Baik -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-0 shadow-sm rounded-3">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted fw-semibold text-uppercase tracking-wider" style="font-size: 11px;">Kondisi Siap Jalan</span>
                        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center text-white" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fa-solid fa-circle-check fs-5"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0 text-success"><?= esc($totalBaik) ?></h2>
                        <span class="text-muted fw-medium fs-7">Unit Baik</span>
                    </div>
                    <small class="text-success fw-semibold d-block">
                        <i class="fa-solid fa-check me-1"></i><?= esc($pctBaik) ?>% dari total armada
                    </small>
                </div>
                
                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                    <span class="badge badge-subtle-success" style="font-size: 11px;">Kelaikan Maksimal</span>
                    <a href="<?= base_url('kendaraan?kondisi=Baik') ?>" class="text-success text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                        <span>Filter Data</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Rusak Ringan -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-0 shadow-sm rounded-3">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted fw-semibold text-uppercase tracking-wider" style="font-size: 11px;">Rusak Ringan</span>
                        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center text-white" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0 text-warning"><?= esc($totalRingan) ?></h2>
                        <span class="text-muted fw-medium fs-7">Unit Perlu Servis</span>
                    </div>
                    <small class="text-warning fw-semibold d-block">
                        <i class="fa-solid fa-clock me-1"></i><?= esc($pctRingan) ?>% butuh perawatan berkala
                    </small>
                </div>
                
                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                    <span class="badge badge-subtle-warning" style="font-size: 11px;">Prioritas Perbaikan</span>
                    <a href="<?= base_url('kendaraan?kondisi=Rusak+Ringan') ?>" class="text-warning text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                        <span>Filter Data</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Rusak Berat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 card-custom-hover border-0 shadow-sm rounded-3">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted fw-semibold text-uppercase tracking-wider" style="font-size: 11px;">Rusak Berat</span>
                        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center text-white" 
                             style="width: 48px; height: 48px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                            <i class="fa-solid fa-circle-xmark fs-5"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0 text-danger"><?= esc($totalBerat) ?></h2>
                        <span class="text-muted fw-medium fs-7">Non-Operasional</span>
                    </div>
                    <small class="text-danger fw-semibold d-block">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i><?= esc($pctBerat) ?>% overhaul / lelang
                    </small>
                </div>
                
                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                    <span class="badge badge-subtle-danger" style="font-size: 11px;">Tindakan Mendesak</span>
                    <a href="<?= base_url('kendaraan?kondisi=Rusak+Berat') ?>" class="text-danger text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                        <span>Filter Data</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Charts Section -->
<div class="row g-4 mb-4">
    <!-- Donut Chart: Komposisi Kondisi Armada KDO -->
    <div class="col-lg-5">
        <div class="card h-100 shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Komposisi Kondisi KDO</h6>
                        <small class="text-muted" style="font-size: 11px;">Rasio kelaikan fisik armada daerah</small>
                    </div>
                </div>
                <span class="badge bg-light text-secondary border">Persentase</span>
            </div>
            <div class="card-body d-flex flex-column justify-content-between p-4">
                <!-- Relative Chart Container with Center Badge -->
                <div class="position-relative d-flex align-items-center justify-content-center" style="height: 250px;">
                    <canvas id="kondisiDonutChart"></canvas>
                    
                    <!-- Center Overlay Info inside Donut Hole -->
                    <div class="position-absolute text-center pointer-events-none" style="pointer-events: none;">
                        <span class="d-block fw-bold fs-3 text-dark lh-1"><?= esc($totalArmada) ?></span>
                        <small class="text-muted text-uppercase fw-semibold" style="font-size: 10px; letter-spacing: 0.8px;">Total Unit</small>
                    </div>
                </div>

                <!-- Structured Legend Cards below -->
                <div class="row g-2 text-center mt-3 pt-3 border-top">
                    <div class="col-4">
                        <div class="p-2 rounded-2 bg-light bg-opacity-50 border border-success border-opacity-25">
                            <small class="text-muted d-block" style="font-size: 11px;"><i class="fa-solid fa-circle text-success fs-8 me-1"></i>Baik</small>
                            <span class="fw-bold text-success fs-6"><?= esc($totalBaik) ?> Unit</span>
                            <small class="text-muted d-block" style="font-size: 10px;"><?= esc($pctBaik) ?>%</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 rounded-2 bg-light bg-opacity-50 border border-warning border-opacity-25">
                            <small class="text-muted d-block" style="font-size: 11px;"><i class="fa-solid fa-circle text-warning fs-8 me-1"></i>R. Ringan</small>
                            <span class="fw-bold text-warning fs-6"><?= esc($totalRingan) ?> Unit</span>
                            <small class="text-muted d-block" style="font-size: 10px;"><?= esc($pctRingan) ?>%</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 rounded-2 bg-light bg-opacity-50 border border-danger border-opacity-25">
                            <small class="text-muted d-block" style="font-size: 11px;"><i class="fa-solid fa-circle text-danger fs-8 me-1"></i>R. Berat</small>
                            <span class="fw-bold text-danger fs-6"><?= esc($totalBerat) ?> Unit</span>
                            <small class="text-muted d-block" style="font-size: 10px;"><?= esc($pctBerat) ?>%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart: Distribusi Kendaraan per Perangkat Daerah -->
    <div class="col-lg-7">
        <div class="card h-100 shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Distribusi Armada per Perangkat Daerah</h6>
                        <small class="text-muted" style="font-size: 11px;">Alokasi kendaraan operasional di setiap SKPD</small>
                    </div>
                </div>
                <a href="<?= base_url('perangkat-daerah') ?>" class="badge bg-light text-primary border text-decoration-none">
                    Lihat Instansi &rarr;
                </a>
            </div>
            <div class="card-body p-4">
                <div style="position: relative; height: 310px;">
                    <canvas id="instansiBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table: 5 Armada Butuh Perbaikan / Servis -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-screwdriver-wrench fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Armada Butuh Perbaikan / Pemeliharaan Terkini</h6>
                        <small class="text-muted" style="font-size: 12px;">Daftar unit KDO prioritas penanganan (Kondisi Rusak Ringan atau Rusak Berat)</small>
                    </div>
                </div>
                <a href="<?= base_url('kendaraan?kondisi=Rusak+Ringan') ?>" class="btn btn-outline-secondary btn-sm rounded-2 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-filter"></i>
                    <span>Lihat Seluruh Kendaraan Bermasalah</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No. Polisi</th>
                            <th>Merk & Model Unit</th>
                            <th>Perangkat Daerah</th>
                            <th>Penanggung Jawab PNS</th>
                            <th class="text-center">Tahun</th>
                            <th>Status Kondisi</th>
                            <th class="text-end pe-4" style="width: 140px;">Aksi Cepat</th>
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
                                        <div class="fw-bold text-dark"><?= esc($kdo['merk']) ?> <?= esc($kdo['tipe_model']) ?></div>
                                        <small class="text-muted"><i class="fa-solid fa-palette me-1"></i><?= esc($kdo['warna']) ?></small>
                                    </td>
                                    <td>
                                        <span class="text-secondary fw-medium"><?= esc($kdo['nama_instansi']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($kdo['nama_pegawai'])): ?>
                                            <div class="fw-semibold text-dark d-flex align-items-center gap-1">
                                                <i class="fa-solid fa-user-tie text-primary me-1"></i><?= esc($kdo['nama_pegawai']) ?>
                                            </div>
                                            <small class="text-muted font-monospace" style="font-size: 11px;">NIP: <?= esc($kdo['nip'] ?? '-') ?></small>
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border px-2 py-1">
                                                <i class="fa-solid fa-warehouse me-1"></i>Pool Kendaraan
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border font-monospace"><?= esc($kdo['tahun_produksi']) ?></span>
                                    </td>
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
                                            <a href="<?= base_url('kendaraan/detail/' . $kdo['id']) ?>" class="btn btn-outline-secondary" title="Detail Unit Aset">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('pemeliharaan/create?kendaraan_id=' . $kdo['id']) ?>" class="btn btn-warning text-dark fw-semibold" title="Input Catatan Servis">
                                                <i class="fa-solid fa-wrench me-1"></i> Servis
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <div class="mb-2">
                                        <i class="fa-solid fa-circle-check text-success fs-1"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Seluruh Armada Siap Beroperasi!</h6>
                                    <p class="small text-muted mb-0">Tidak ada unit KDO yang berstatus Rusak Ringan maupun Rusak Berat saat ini.</p>
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
                    backgroundColor: [
                        '#10b981', // Hijau Baik
                        '#f59e0b', // Kuning Rusak Ringan
                        '#ef4444'  // Merah Rusak Berat
                    ],
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
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
                    hoverBackgroundColor: '#009ef7',
                    borderRadius: 8,
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
                            font: { family: 'Plus Jakarta Sans', size: 11 }
                        },
                        grid: { color: '#f1f5f9' }
                    },
                    x: {
                        ticks: { 
                            font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 } 
                        },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            title: function(items) {
                                const idx = items[0].dataIndex;
                                return instansiData.full_names[idx] || items[0].label;
                            },
                            label: function(context) {
                                return ` Jumlah Armada: ${context.raw} Unit KDO`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
