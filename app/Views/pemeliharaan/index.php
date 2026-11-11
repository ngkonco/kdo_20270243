<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Riwayat Pemeliharaan & Servis KDO</h4>
        <p class="text-muted mb-0 small">Log pemeliharaan berkala, perbaikan suku cadang, dan pencatatan biaya pemeliharaan BMD.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('pemeliharaan/create') ?>" class="btn btn-warning text-dark px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2 fw-semibold">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Catat Servis Baru</span>
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-wrench text-warning fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Rekapitulasi Pemeliharaan Kendaraan Dinas</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($riwayat) ?> Tindakan Servis</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="pemeliharaanTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal Servis</th>
                        <th>Plat & Kendaraan</th>
                        <th>Perangkat Daerah</th>
                        <th>Bengkel Pelaksana</th>
                        <th>Uraian Perbaikan</th>
                        <th class="text-end">Biaya (Rp)</th>
                        <th>Kondisi Akhir</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat)): ?>
                        <?php $no = 1; foreach ($riwayat as $r): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <span class="fw-semibold text-secondary">
                                        <i class="fa-regular fa-calendar-days text-primary me-1"></i>
                                        <?= date('d/m/Y', strtotime($r['tanggal_servis'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('kendaraan/detail/' . $r['kendaraan_id']) ?>" class="text-decoration-none">
                                        <span class="plat-nomor-dinas"><?= esc($r['nomor_polisi']) ?></span>
                                    </a>
                                    <div class="small fw-semibold text-dark mt-1"><?= esc($r['merk']) ?> <?= esc($r['tipe_model']) ?></div>
                                </td>
                                <td>
                                    <span class="text-secondary small fw-medium"><?= esc($r['nama_instansi']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= esc($r['bengkel']) ?></span>
                                </td>
                                <td>
                                    <span class="text-secondary small"><?= esc(character_limiter($r['deskripsi_perbaikan'], 80)) ?></span>
                                </td>
                                <td class="text-end fw-bold text-dark font-monospace">
                                    Rp <?= number_format((float)$r['biaya'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php if ($r['status_kondisi_akhir'] === 'Baik'): ?>
                                        <span class="badge badge-subtle-success px-2 py-1 rounded-pill fw-semibold">Baik</span>
                                    <?php elseif ($r['status_kondisi_akhir'] === 'Rusak Ringan'): ?>
                                        <span class="badge badge-subtle-warning px-2 py-1 rounded-pill fw-semibold">Rusak Ringan</span>
                                    <?php else: ?>
                                        <span class="badge badge-subtle-danger px-2 py-1 rounded-pill fw-semibold">Rusak Berat</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('pemeliharaan/edit/' . $r['id']) ?>" class="btn btn-outline-primary" title="Edit Catatan Servis">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="<?= base_url('pemeliharaan/delete/' . $r['id']) ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Riwayat Servis <?= esc($r['nomor_polisi']) ?>" title="Hapus Catatan Servis">
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
        $('#pemeliharaanTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari nomor polisi, bengkel, uraian...",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ servis",
                paginate: { next: "&rarr;", previous: "&larr;" }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [8] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>

