<!DOCTYPE html>
<html lang="id" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin — Inspagenda</title>
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
            <p class="text-base-content/60 text-sm mt-1">Portal Admin Inspektorat</p>
        </div>

        <!-- Login Card -->
        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body gap-4">
                <h2 class="card-title justify-center text-xl">Masuk ke Akun Admin</h2>

                @if(session('success'))
                    <div class="alert alert-success text-sm py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error text-sm py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/login" class="flex flex-col gap-4">
                    @csrf

                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text font-medium">Email</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="input input-bordered w-full @error('email') input-error @enderror"
                               placeholder="contoh@example.com" required autofocus>
                    </div>

                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text font-medium">Password</span>
                        </label>
                        <input id="password" type="password" name="password"
                               class="input input-bordered w-full @error('password') input-error @enderror"
                               placeholder="••••••••" required>
                    </div>

                    <div class="form-control mt-2">
                        <button type="submit" class="btn btn-primary w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center mt-6 text-xs text-base-content/40">
            <a href="/" class="link link-hover">← Kembali ke Beranda</a>
        </p>
    </div>

</body>
</html>
