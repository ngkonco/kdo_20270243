<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Daftar Pegawai Negeri Sipil (PNS)</h4>
        <p class="text-muted mb-0 small">Master data aparatur penanggung jawab dan pemegang kendaraan dinas operasional.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('pegawai/create') ?>" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="fa-solid fa-user-plus"></i>
            <span class="fw-semibold">Tambah Pegawai PNS</span>
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-users-gear text-primary fs-5"></i>
            <h6 class="mb-0 fw-bold text-dark">Data Aparatur Sipil Negara Penanggung Jawab KDO</h6>
        </div>
        <span class="badge bg-light text-secondary border">Total: <?= count($pegawai) ?> Pegawai</span>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="pegawaiTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>NIP (18 Digit)</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan Kedinasan</th>
                        <th>Gol.</th>
                        <th>Perangkat Daerah</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pegawai)): ?>
                        <?php $no = 1; foreach ($pegawai as $p): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                        <?= esc($p['nip']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($p['nama_pegawai']) ?></div>
                                </td>
                                <td>
                                    <span class="text-secondary"><?= esc($p['jabatan']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                        <?= esc($p['golongan']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary"><?= esc($p['nama_instansi']) ?></span>
                                    <small class="d-block text-muted" style="font-size: 11px;">[<?= esc($p['kode_instansi']) ?>]</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('pegawai/edit/' . $p['id']) ?>" class="btn btn-outline-primary" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="<?= base_url('pegawai/delete/' . $p['id']) ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-delete-confirm" data-name="Pegawai <?= esc($p['nama_pegawai']) ?>" title="Hapus Data">
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
        $('#pegawaiTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari NIP, nama pegawai, jabatan...",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ pegawai",
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

