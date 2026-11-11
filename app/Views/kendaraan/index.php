<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Breadcrumb and Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Daftar Kendaraan Dinas Operasional (KDO)</h4>
        <p class="text-muted mb-0 small">Inventarisasi dan pengelolaan status kelaikan aset kendaraan Barang Milik Daerah (BMD).</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('kendaraan/create') ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-plus-circle"></i>
            <span class="fw-semibold">Tambah Unit KDO</span>
        </a>
    </div>
</div>

<!-- Filter Card -->
<div class="card shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="<?= base_url('kendaraan') ?>" method="GET" class="row g-3 align-items-end">
            <!-- Filter Kondisi -->
            <div class="col-md-4">
                <label for="filterKondisi" class="form-label small fw-semibold text-secondary">Filter Kondisi Kendaraan</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-traffic-light text-muted"></i></span>
                    <select name="kondisi" id="filterKondisi" class="form-select border-start-0">
                        <option value="">-- Semua Kondisi KDO --</option>
                        <option value="Baik" <?= ($selected_kondisi === 'Baik') ? 'selected' : '' ?>>Kondisi Baik</option>
                        <option value="Rusak Ringan" <?= ($selected_kondisi === 'Rusak Ringan') ? 'selected' : '' ?>>Kondisi Rusak Ringan</option>
                        <option value="Rusak Berat" <?= ($selected_kondisi === 'Rusak Berat') ? 'selected' : '' ?>>Kondisi Rusak Berat</option>
                    </select>
                </div>
            </div>

            <!-- Filter Perangkat Daerah -->
            <div class="col-md-5">
                <label for="filterInstansi" class="form-label small fw-semibold text-secondary">Filter Perangkat Daerah (Instansi)</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-building-columns text-muted"></i></span>
                    <select name="perangkat_daerah_id" id="filterInstansi" class="form-select border-start-0">
                        <option value="">-- Seluruh Perangkat Daerah --</option>
                        <?php foreach ($perangkat_daerah as $instansi): ?>
                            <option value="<?= esc($instansi['id']) ?>" <?= ((string)$selected_instansi === (string)$instansi['id']) ? 'selected' : '' ?>>
                                [<?= esc($instansi['kode_instansi']) ?>] <?= esc($instansi['nama_instansi']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm px-3 flex-grow-1">
                    <i class="fa-solid fa-filter me-1"></i> Terapkan Filter
                </button>
                <a href="<?= base_url('kendaraan') ?>" class="btn btn-outline-secondary btn-sm px-3" title="Reset Filter">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Data Table Card -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-table-list text-primary fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Data Inventaris Armada KDO</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($kendaraan) ?> Unit</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="kendaraanTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Plat Nomor</th>
                        <th>Merk & Model</th>
                        <th>Perangkat Daerah</th>
                        <th>Penanggung Jawab PNS</th>
                        <th>Tahun</th>
                        <th>Status Kondisi</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kendaraan)): ?>
                        <?php $no = 1; foreach ($kendaraan as $k): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <a href="<?= base_url('kendaraan/detail/' . $k['id']) ?>" class="text-decoration-none">
                                        <span class="plat-nomor-dinas"><?= esc($k['nomor_polisi']) ?></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($k['merk']) ?> <?= esc($k['tipe_model']) ?></div>
                                    <small class="text-muted"><i class="fa-solid fa-palette me-1"></i><?= esc($k['warna']) ?></small>
                                </td>
                                <td>
                                    <span class="text-secondary fw-semibold"><?= esc($k['nama_instansi']) ?></span>
                                    <small class="d-block text-muted" style="font-size: 11px;">[<?= esc($k['kode_instansi']) ?>]</small>
                                </td>
                                <td>
                                    <?php if (!empty($k['nama_pegawai'])): ?>
                                        <div class="fw-medium text-dark"><i class="fa-solid fa-user-check text-success me-1"></i><?= esc($k['nama_pegawai']) ?></div>
                                        <small class="text-muted" style="font-size: 11px;">NIP: <?= esc($k['nip']) ?></small>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border px-2 py-1">
                                            <i class="fa-solid fa-car-side me-1"></i> Unit Pool / Umum
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= esc($k['tahun_produksi']) ?></span></td>
                                <td>
                                    <?php if ($k['kondisi'] === 'Baik'): ?>
                                        <span class="badge badge-subtle-success px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fa-solid fa-circle-check me-1"></i> Baik
                                        </span>
                                    <?php elseif ($k['kondisi'] === 'Rusak Ringan'): ?>
                                        <span class="badge badge-subtle-warning px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Rusak Ringan
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-subtle-danger px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Rusak Berat
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('kendaraan/detail/' . $k['id']) ?>" class="btn btn-outline-info" title="Detail Unit Aset">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('kendaraan/edit/' . $k['id']) ?>" class="btn btn-outline-primary" title="Edit Data KDO">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="<?= base_url('kendaraan/delete/' . $k['id']) ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Kendaraan <?= esc($k['nomor_polisi']) ?>" title="Hapus Data">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
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
        $('#kendaraanTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari nomor polisi, merk, instansi...",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoEmpty: "Data tidak tersedia",
                zeroRecords: "Tidak ada data armada yang cocok",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "&rarr;",
                    previous: "&larr;"
                }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [7] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>

