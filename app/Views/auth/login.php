<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Sistem KDO - BMD') ?> | SIM-KDO</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6.5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #151521;
            background-image: radial-gradient(#26263b 1px, transparent 1px);
            background-size: 24px 24px;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #1e1e2d;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.25rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            max-width: 460px;
            width: 100%;
        }

        .form-control {
            background-color: #151521;
            border: 1px solid #2d2d44;
            color: #ffffff;
            border-radius: 0.6rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background-color: #181828;
            border-color: #3699ff;
            color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(54, 153, 255, 0.25);
        }

        .input-group-text {
            background-color: #151521;
            border: 1px solid #2d2d44;
            color: #7e8299;
            border-radius: 0.6rem;
        }

        .btn-primary {
            background-color: #3699ff;
            border-color: #3699ff;
            border-radius: 0.6rem;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #1b84ff;
            border-color: #1b84ff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(54, 153, 255, 0.4);
        }

        .demo-pill {
            cursor: pointer;
            background-color: #242436;
            border: 1px solid #32324d;
            transition: all 0.2s ease;
        }

        .demo-pill:hover {
            background-color: #2f2f47;
            border-color: #3699ff;
            color: #ffffff !important;
        }
    </style>
</head>
<body>

    <div class="container p-3">
        <div class="login-card mx-auto p-4 p-md-5">
            <!-- Header Brand -->
            <div class="text-center mb-4">
                <div class="bg-primary bg-gradient rounded-4 p-3 d-inline-flex align-items-center justify-content-center shadow mb-3" style="width: 58px; height: 58px;">
                    <i class="fa-solid fa-car-side text-white fs-3"></i>
                </div>
                <h4 class="fw-bold mb-1 text-white">SIM-KDO</h4>
                <p class="text-secondary small mb-0">Pengelolaan Kendaraan Dinas Operasional - BMD</p>
            </div>

            <!-- Flash Alerts -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger py-2 px-3 small d-flex align-items-center gap-2 rounded-3 border-0 bg-danger bg-opacity-25 text-danger border-start border-3 border-danger mb-3" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-6"></i>
                    <div><?= esc(session()->getFlashdata('error')) ?></div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success py-2 px-3 small d-flex align-items-center gap-2 rounded-3 border-0 bg-success bg-opacity-25 text-success border-start border-3 border-success mb-3" role="alert">
                    <i class="fa-solid fa-circle-check fs-6"></i>
                    <div><?= esc(session()->getFlashdata('success')) ?></div>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('login/process') ?>" method="POST" id="loginForm">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="username" class="form-label text-light small fw-semibold">Username atau Email</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="username" id="username" class="form-control border-start-0" placeholder="admin atau admin@bmd.pemda.go.id" value="<?= old('username') ?>" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label text-light small fw-semibold mb-0">Kata Sandi</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0" placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary border border-start-0 text-secondary" type="button" id="togglePassword">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-4 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Quick Demo Credentials Box -->
            <div class="p-3 rounded-3 mt-2" style="background-color: #171724; border: 1px dashed #2f2f44;">
                <div class="d-flex align-items-center gap-2 text-warning mb-2" style="font-size: 11px;">
                    <i class="fa-solid fa-bolt"></i>
                    <strong class="text-uppercase tracking-wider">Akses Cepat Pengujian (1-Klik)</strong>
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="demo-pill p-2 rounded-2 d-flex justify-content-between align-items-center" onclick="fillCredentials('admin', 'admin123')">
                        <div class="small">
                            <span class="badge bg-primary bg-opacity-25 text-primary me-1">Admin</span>
                            <span class="text-white fw-semibold">admin</span> / <span class="text-muted">admin123</span>
                        </div>
                        <i class="fa-solid fa-arrow-turn-down text-primary small"></i>
                    </div>
                    <div class="demo-pill p-2 rounded-2 d-flex justify-content-between align-items-center" onclick="fillCredentials('operator', 'operator123')">
                        <div class="small">
                            <span class="badge bg-success bg-opacity-25 text-success me-1">Operator</span>
                            <span class="text-white fw-semibold">operator</span> / <span class="text-muted">operator123</span>
                        </div>
                        <i class="fa-solid fa-arrow-turn-down text-success small"></i>
                    </div>
                </div>
            </div>

            <!-- Footer info -->
            <div class="text-center mt-4 pt-2 text-muted" style="font-size: 11px;">
                <i class="fa-solid fa-shield-halved text-success me-1"></i> Dilindungi CSRF & Bcrypt Hash Protection
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function fillCredentials(user, pass) {
            document.getElementById('username').value = user;
            document.getElementById('password').value = pass;
        }

        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>

