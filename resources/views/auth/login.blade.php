<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Inspagenda-2</title>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent),
                        radial-gradient(circle at bottom left, rgba(129, 140, 248, 0.1), transparent),
                        var(--bg-app);
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
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

        .login-header {
            text-align: center;
        }

        .login-logo {
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

        .login-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--text-muted);
        }

        .error-alert {
            background-color: var(--danger-light);
            border: 1px solid var(--danger);
            color: var(--danger);
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">I</div>
            <h1 class="login-title">Selamat Datang Kembali</h1>
            <p class="login-subtitle">Masuk ke Inspagenda-2 untuk mengelola audit</p>
        </div>

        @if($errors->any())
            <div class="error-alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="nama@perusahaan.com" required value="{{ old('email') }}" autofocus>
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <label class="form-label" for="password" style="margin-bottom: 0;">Kata Sandi</label>
                    <a href="#" style="font-size: 12px; font-weight: 600; color: var(--accent);">Lupa Sandi?</a>
                </div>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>

            <div style="display: flex; align-items: center; gap: 8px; margin: 4px 0;">
                <input type="checkbox" id="remember" name="remember" style="accent-color: var(--accent); cursor: pointer;">
                <label for="remember" style="font-size: 13px; color: var(--text-muted); cursor: pointer; user-select: none;">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 12px; font-size: 15px; margin-top: 8px;">Masuk Aplikasi</button>
        </form>

        <div style="text-align: center; font-size: 13px; color: var(--text-muted); border-top: 1px solid var(--border-color); padding-top: 20px;">
            Belum memiliki akun admin? <a href="/register-admin-secret" style="color: var(--accent); font-weight: 600;">Daftar Rahasia</a>
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
