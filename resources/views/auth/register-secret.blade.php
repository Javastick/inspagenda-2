<!DOCTYPE html>
<html lang="id" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Admin — Inspagenda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-base-200 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-inspagenda-nobg.png') }}" alt="Logo" class="h-16 w-auto mx-auto mb-3">
            <h1 class="text-2xl font-bold text-base-content">Inspagenda</h1>
            <p class="text-base-content/60 text-sm mt-1">Registrasi Akun Admin</p>
        </div>

        <!-- Register Card -->
        <div class="card bg-base-100 shadow-xl border border-warning/30">
            <div class="card-body gap-4">
                <div class="alert alert-warning text-xs py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Halaman ini hanya untuk keperluan internal.
                </div>

                <h2 class="card-title justify-center text-xl">Buat Akun Admin</h2>

                @if($errors->any())
                    <div class="alert alert-error text-sm py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/register-admin-secret?secret={{ $secret }}" class="flex flex-col gap-4">
                    @csrf

                    <div class="form-control">
                        <label class="label" for="name">
                            <span class="label-text font-medium">Nama Lengkap</span>
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="input input-bordered w-full @error('name') input-error @enderror"
                               placeholder="Nama Admin" required autofocus>
                    </div>

                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text font-medium">Email</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="input input-bordered w-full @error('email') input-error @enderror"
                               placeholder="admin@example.com" required>
                    </div>

                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text font-medium">Password</span>
                        </label>
                        <input id="password" type="password" name="password"
                               class="input input-bordered w-full @error('password') input-error @enderror"
                               placeholder="min. 8 karakter" required>
                    </div>

                    <div class="form-control">
                        <label class="label" for="password_confirmation">
                            <span class="label-text font-medium">Konfirmasi Password</span>
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="input input-bordered w-full"
                               placeholder="Ulangi password" required>
                    </div>

                    <div class="form-control mt-2">
                        <button type="submit" class="btn btn-warning w-full text-warning-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                            Daftarkan Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center mt-6 text-xs text-base-content/40">
            <a href="/login" class="link link-hover">← Kembali ke Login</a>
        </p>
    </div>

</body>
</html>
