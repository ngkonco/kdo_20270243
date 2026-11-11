<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Master Perangkat Daerah (Instansi)</h4>
        <p class="text-muted mb-0 small">Dinas, Badan, dan Lembaga Pemerintah Daerah pemilik/pengguna aset KDO.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('perangkat-daerah/create') ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-plus-circle"></i>
            <span class="fw-semibold">Tambah Instansi Baru</span>
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-building-columns text-primary fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Data Perangkat Daerah</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($perangkat_daerah) ?> Instansi</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="instansiTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode Instansi</th>
                        <th>Nama Perangkat Daerah</th>
                        <th>Alamat Kantor</th>
                        <th>Kontak Telepon</th>
                        <th class="text-center">Total Pegawai</th>
                        <th class="text-center">Total KDO</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($perangkat_daerah)): ?>
                        <?php $no = 1; foreach ($perangkat_daerah as $pd): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-light text-primary border font-monospace px-2 py-1">
                                        <?= esc($pd['kode_instansi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($pd['nama_instansi']) ?></div>
                                </td>
                                <td>
                                    <small class="text-muted"><?= esc($pd['alamat'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <span class="text-secondary small"><?= esc($pd['no_telepon'] ?? '-') ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-subtle-info px-2 py-1 rounded-pill">
                                        <?= esc($pd['total_pegawai']) ?> ASN
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-subtle-success px-2 py-1 rounded-pill">
                                        <?= esc($pd['total_kendaraan']) ?> Unit
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('perangkat-daerah/edit/' . $pd['id']) ?>" class="btn btn-outline-primary" title="Edit Instansi">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="<?= base_url('perangkat-daerah/delete/' . $pd['id']) ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Instansi <?= esc($pd['nama_instansi']) ?>" title="Hapus Instansi">
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
        $('#instansiTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari kode atau nama instansi...",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ instansi",
                paginate: { next: "&rarr;", previous: "&larr;" }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [7] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>

