<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Masuk ke Sistem Informasi KDO - BMD') ?> | SIM-KDO</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6.5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #3699ff;
            --brand-primary-hover: #1b84ff;
            --bg-dark-core: #11111b;
            --bg-dark-card: #1e1e2d;
            --bg-dark-input: #151521;
            --border-subtle: #2b2b40;
            --border-hover: #3699ff;
            --text-title: #ffffff;
            --text-body: #e2e8f0;
            --text-muted-custom: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark-core);
            background-image: 
                radial-gradient(at 0% 0%, rgba(54, 153, 255, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(#222235 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 28px 28px;
            color: var(--text-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow behind card */
        .ambient-glow {
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(54, 153, 255, 0.15) 0%, rgba(54, 153, 255, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
        }

        .login-card {
            background-color: var(--bg-dark-card);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 35px rgba(54, 153, 255, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(16px);
            overflow: hidden;
        }

        .card-top-accent {
            height: 4px;
            background: linear-gradient(90deg, #3699ff 0%, #00d2ff 50%, #10b981 100%);
        }

        /* Form Labels & Inputs */
        .form-label-custom {
            color: #f1f5f9;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-bottom: 0.5rem;
        }

        .input-group-custom {
            border: 1px solid var(--border-subtle);
            border-radius: 0.75rem;
            overflow: hidden;
            background-color: var(--bg-dark-input);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-group-custom:focus-within {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(54, 153, 255, 0.2);
            background-color: #181827;
        }

        .input-group-custom .input-group-text {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding-left: 1.15rem;
            padding-right: 0.75rem;
            font-size: 1.05rem;
        }

        .input-group-custom:focus-within .input-group-text {
            color: var(--brand-primary);
        }

        .input-group-custom .form-control {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.85rem 1rem 0.85rem 0.25rem;
        }

        .input-group-custom .form-control::placeholder {
            color: #64748b;
            font-weight: 400;
            opacity: 1;
        }

        .input-group-custom .form-control:focus {
            box-shadow: none;
            background: transparent;
            color: #ffffff;
        }

        .btn-toggle-password {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding-right: 1.15rem;
            padding-left: 0.75rem;
            transition: color 0.2s ease;
        }

        .btn-toggle-password:hover {
            color: #ffffff;
        }

        /* Primary Button */
        .btn-login-submit {
            background: linear-gradient(135deg, #3699ff 0%, #1b84ff 100%);
            border: none;
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            box-shadow: 0 4px 18px rgba(54, 153, 255, 0.35);
            transition: all 0.25s ease;
        }

        .btn-login-submit:hover {
            background: linear-gradient(135deg, #1b84ff 0%, #0d6efd 100%);
            box-shadow: 0 6px 24px rgba(54, 153, 255, 0.55);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-login-submit:active {
            transform: translateY(0);
        }

        /* Demo Credentials Interactive Card */
        .demo-box {
            background-color: #151522;
            border: 1px solid #28283c;
            border-radius: 1rem;
            padding: 1.1rem;
        }

        .demo-card-item {
            background-color: #1a1a2c;
            border: 1px solid #2d2d46;
            border-radius: 0.65rem;
            padding: 0.65rem 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .demo-card-item:hover {
            background-color: #24243d;
            border-color: #3699ff;
            transform: translateX(3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .font-mono-val {
            font-family: 'JetBrains Mono', 'Consolas', monospace;
            font-size: 0.825rem;
            background: #11111a;
            padding: 2px 7px;
            border-radius: 5px;
            border: 1px solid #29293d;
        }

        /* Alert Styling with Maximum Contrast */
        .alert-custom-danger {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            border-radius: 0.75rem;
        }

        .alert-custom-success {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #6ee7b7;
            border-radius: 0.75rem;
        }

        /* Toast animation */
        .flash-pill {
            display: inline-block;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

    <!-- Ambient Glow Effect -->
    <div class="ambient-glow"></div>

    <div class="container d-flex justify-content-center position-relative z-1">
        <div class="login-card p-0">
            <!-- Top Color Stripe Accent -->
            <div class="card-top-accent"></div>

            <div class="p-4 p-sm-5">
                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-4 shadow-lg mb-3" style="width: 64px; height: 64px; background: linear-gradient(135deg, #3699ff 0%, #009ef7 100%); border: 2px solid rgba(255,255,255,0.2);">
                        <i class="fa-solid fa-car-side text-white fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-1 text-white tracking-wide">SIM-KDO BMD</h3>
                    <p class="mb-0 fw-medium" style="color: #94a3b8; font-size: 0.9rem;">
                        Pengelolaan Kendaraan Dinas Operasional
                    </p>
                    <span class="badge bg-primary bg-opacity-20 text-info border border-primary border-opacity-30 rounded-pill px-3 py-1 mt-2" style="font-size: 11px;">
                        <i class="fa-solid fa-building-shield me-1"></i> Badan Pengelolaan Keuangan & Aset Daerah
                    </span>
                </div>

                <!-- Flash Alert Messages (High-Contrast) -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-custom-danger py-2 px-3 small d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fs-5 text-danger flex-shrink-0"></i>
                        <div class="fw-medium text-white"><?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-custom-success py-2 px-3 small d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="fa-solid fa-circle-check fs-5 text-success flex-shrink-0"></i>
                        <div class="fw-medium text-white"><?= esc(session()->getFlashdata('success')) ?></div>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form action="<?= base_url('login/process') ?>" method="POST" id="loginForm">
                    <?= csrf_field() ?>

                    <!-- Username / Email Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label-custom d-block">
                            <i class="fa-solid fa-user-shield me-1 text-primary"></i> Username atau Email Resmi
                        </label>
                        <div class="input-group-custom d-flex align-items-center">
                            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="admin atau admin@bmd.pemda.go.id" value="<?= old('username') ?>" required autofocus autocomplete="username">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label-custom mb-0">
                                <i class="fa-solid fa-key me-1 text-primary"></i> Kata Sandi (Password)
                            </label>
                            <span class="small fw-semibold text-primary" style="font-size: 11px;">Terenkripsi Bcrypt</span>
                        </div>
                        <div class="input-group-custom d-flex align-items-center mt-1">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan kata sandi..." required autocomplete="current-password">
                            <button class="btn-toggle-password" type="button" id="togglePassword" title="Tampilkan / Sembunyikan Kata Sandi">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-login-submit w-100 d-flex align-items-center justify-content-center gap-2 mb-4">
                        <i class="fa-solid fa-arrow-right-to-bracket fs-6"></i>
                        <span>Masuk ke Dashboard Sistem</span>
                    </button>
                </form>

                <!-- 1-Click Demo Credentials Card with High-Contrast Typography -->
                <!--
                <div class="demo-box">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-bolt text-warning fs-6"></i>
                            <span class="fw-bold text-white small text-uppercase tracking-wider">Akses Pengujian Cepat (1-Klik)</span>
                        </div>
                        <span class="badge bg-warning bg-opacity-20 text-warning px-2 py-0.5 rounded-pill" style="font-size: 10px;">Klik untuk isi otomatis</span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                       
                        <div class="demo-card-item d-flex align-items-center justify-content-between" onclick="fillCredentials('admin', 'admin123')">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary text-white px-2 py-1 fw-bold rounded-2" style="font-size: 11px;">ADMIN</span>
                                <div>
                                    <span class="text-white fw-bold me-1">admin</span>
                                    <span class="text-light opacity-50">/</span>
                                    <span class="font-mono-val text-warning fw-semibold ms-1">admin123</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-arrow-right text-primary small"></i>
                        </div>

                        
                        <div class="demo-card-item d-flex align-items-center justify-content-between" onclick="fillCredentials('operator', 'operator123')">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success text-white px-2 py-1 fw-bold rounded-2" style="font-size: 11px;">OPERATOR</span>
                                <div>
                                    <span class="text-white fw-bold me-1">operator</span>
                                    <span class="text-light opacity-50">/</span>
                                    <span class="font-mono-val text-warning fw-semibold ms-1">operator123</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-arrow-right text-success small"></i>
                        </div>

                        
                        <div class="demo-card-item d-flex align-items-center justify-content-between" onclick="fillCredentials('pimpinan', 'pimpinan123')">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-info text-dark px-2 py-1 fw-bold rounded-2" style="font-size: 11px;">PIMPINAN</span>
                                <div>
                                    <span class="text-white fw-bold me-1">pimpinan</span>
                                    <span class="text-light opacity-50">/</span>
                                    <span class="font-mono-val text-warning fw-semibold ms-1">pimpinan123</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-arrow-right text-info small"></i>
                        </div>
                    </div>
                </div>
                -->
                <!-- Security Trust Footer Badges -->
                <div class="d-flex justify-content-center align-items-center gap-3 mt-4 pt-2 text-center" style="font-size: 11px;">
                    <span class="text-white-50"><i class="fa-solid fa-shield-halved text-success me-1"></i> OWASP Top 10</span>
                    <span class="text-secondary">•</span>
                    <span class="text-white-50"><i class="fa-solid fa-lock text-primary me-1"></i> CSRF Active</span>
                    <span class="text-secondary">•</span>
                    <span class="text-white-50"><i class="fa-solid fa-server text-info me-1"></i> PHP 8.4</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function fillCredentials(user, pass) {
            const userInput = document.getElementById('username');
            const passInput = document.getElementById('password');

            userInput.value = user;
            passInput.value = pass;

            // Visual highlight feedback on inputs
            userInput.parentElement.style.borderColor = '#3699ff';
            passInput.parentElement.style.borderColor = '#3699ff';
            setTimeout(() => {
                userInput.parentElement.style.borderColor = '';
                passInput.parentElement.style.borderColor = '';
            }, 600);
        }

        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.add('text-primary');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.remove('text-primary');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
