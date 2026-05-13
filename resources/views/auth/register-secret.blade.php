<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Admin Rahasia - Inspagenda-2</title>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(129, 140, 248, 0.15), transparent),
                        radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.1), transparent),
                        var(--bg-app);
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 480px;
            background-color: var(--bg-surface-glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            gap: 24px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
        }

        .register-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 24px;
            box-shadow: 0 8px 16px var(--accent-glow);
            margin-bottom: 16px;
        }

        .register-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .register-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 500;
        }

        .alert-error {
            background-color: var(--danger-light);
            border: 1px solid var(--danger);
            color: var(--danger);
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <div class="register-logo">I</div>
            <h1 class="register-title">Pendaftaran Admin</h1>
            <p class="register-subtitle">Daftarkan akun administrator baru secara rahasia</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register-admin-secret?secret={{ $secret }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Contoh: Ziamul Umam" required value="{{ old('name') }}" autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email Resmi</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="nama@perusahaan.com" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ketik ulang kata sandi" required>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 12px; font-size: 15px; margin-top: 8px;">Daftarkan Akun Admin</button>
        </form>

        <div style="text-align: center; font-size: 13px; color: var(--text-muted); border-top: 1px solid var(--border-color); padding-top: 20px;">
            Sudah memiliki akun? <a href="{{ route('login') }}" style="color: var(--accent); font-weight: 600;">Log In</a>
        </div>
    </div>

    <script>
        // Automatic dark/light theme load
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>
</html>
