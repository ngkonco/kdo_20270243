<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistem Informasi KDO - BMD') ?> | SIM-KDO</title>

    <!-- CSRF Meta Tags for AJAX Requests -->
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6.5.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
            --bs-body-bg: #f5f8fa;
            --bs-primary: #3699ff;
            --bs-primary-rgb: 54, 153, 255;
            --sidebar-width: 260px;
        }

        body {
            font-family: var(--bs-body-font-family);
            background-color: var(--bs-body-bg);
            color: #181c32;
            overflow-x: hidden;
        }

        /* Layout Architecture */
        #main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar-wrapper.show {
                margin-left: 0;
            }
            #main-wrapper {
                margin-left: 0 !important;
            }
        }

        /* Cards and Elements Styling (Metronic-like) */
        .card {
            border: 0;
            border-radius: 0.75rem;
            box-shadow: 0 0 20px 0 rgba(76,87,125,0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px 0 rgba(76,87,125,0.08);
        }

        .badge-subtle-success {
            background-color: #e8fff3 !important;
            color: #10b981 !important;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        .badge-subtle-warning {
            background-color: #fff8dd !important;
            color: #f59e0b !important;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        .badge-subtle-danger {
            background-color: #ffe2e5 !important;
            color: #ef4444 !important;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .badge-subtle-info {
            background-color: #e1f0ff !important;
            color: #009ef7 !important;
            border: 1px solid rgba(0, 158, 247, 0.2);
        }

        /* Plat Nomor Dinas Merah Style */
        .plat-nomor-dinas {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            color: #ffffff;
            font-family: 'Consolas', 'Courier New', monospace;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 2px solid #7f1d1d;
            box-shadow: inset 0 1px 2px rgba(255,255,255,0.3), 0 2px 4px rgba(0,0,0,0.15);
            display: inline-block;
        }

        /* Table custom styling */
        .table thead th {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #7e8299;
            background-color: #f9f9fc;
            border-bottom: 1px solid #ebedf3;
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.9rem;
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
            color: #3f4254;
            border-bottom: 1px solid #f3f3f7;
        }
    </style>
</head>
<body>

    <!-- Sidebar Layout -->
    <?= $this->include('layouts/sidebar') ?>

    <!-- Main Content Wrapper -->
    <div id="main-wrapper">
        <!-- Header Navbar -->
        <?= $this->include('layouts/navbar') ?>

        <!-- Page Body Content -->
        <main class="flex-grow-1 p-4">
            <!-- Inline Alert Messages if any -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-3 rounded-3 shadow-sm border-0 border-start border-4 border-success mb-4" role="alert">
                    <i class="fa-solid fa-circle-check fs-4 text-success"></i>
                    <div>
                        <strong class="d-block">Berhasil!</strong>
                        <span><?= esc(session()->getFlashdata('success')) ?></span>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-3 rounded-3 shadow-sm border-0 border-start border-4 border-danger mb-4" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-4 text-danger"></i>
                    <div>
                        <strong class="d-block">Gagal!</strong>
                        <span><?= esc(session()->getFlashdata('error')) ?></span>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-warning alert-dismissible fade show rounded-3 shadow-sm border-0 border-start border-4 border-warning mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-warning fs-5"></i>
                        <strong>Perhatian: Mohon periksa kembali formulir Anda!</strong>
                    </div>
                    <ul class="mb-0 ps-4 small">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Render specific page content -->
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 px-4 mt-auto">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-muted small">
                <div>
                    <strong>Sistem Informasi Pengelolaan KDO - BMD</strong> &copy; <?= date('Y') ?>. Hak Cipta Dilindungi Undang-Undang.
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span><i class="fa-solid fa-code text-primary me-1"></i>CodeIgniter 4</span>
                    <span><i class="fa-brands fa-docker text-info me-1"></i>Docker DevSecOps</span>
                    <span><i class="fa-solid fa-shield-halved text-success me-1"></i>OWASP Top 10 Hardened</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Core Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global App Scripts -->
    <script>
        $(document).ready(function() {
            // Sidebar Mobile Toggle
            $('#sidebarToggleBtn').on('click', function() {
                $('#sidebar-wrapper').toggleClass('show');
            });

            $('#sidebarCloseBtn').on('click', function() {
                $('#sidebar-wrapper').removeClass('show');
            });

            // SweetAlert Delete Confirmation
            $(document).on('click', '.btn-delete-confirm', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const url = $(this).attr('href');
                const entityName = $(this).data('name') || 'data ini';

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    text: `Apakah Anda yakin ingin menghapus ${entityName}? Data yang telah dihapus tidak dapat dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (form.length > 0) {
                            form.submit();
                        } else if (url) {
                            window.location.href = url;
                        }
                    }
                });
            });

            // Toast feedback from session flashdata if present
            <?php if (session()->getFlashdata('success')): ?>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '<?= esc(session()->getFlashdata('success')) ?>',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: '<?= esc(session()->getFlashdata('error')) ?>',
                    confirmButtonColor: '#3699ff'
                });
            <?php endif; ?>
        });
    </script>

    <!-- Additional Child Scripts Section -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>

