<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#070b0f]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App thống kê data - @yield('title', 'Login')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full text-[#253142]">
    <div class="flex min-h-full items-center justify-center bg-[#070b0f] px-4 py-6 sm:px-6 lg:px-8">
        <main class="grid w-full max-w-5xl overflow-hidden rounded-[22px] bg-white p-4 shadow-[0_30px_90px_rgba(0,0,0,0.45)] md:grid-cols-[0.98fr_1.22fr] lg:min-h-[660px] lg:p-5">
            <section class="flex min-h-[620px] items-center justify-center px-6 py-8 sm:px-10 md:min-h-full md:px-12 lg:px-16">
                <div class="w-full max-w-[290px]">
                    <p class="mb-10 text-center text-xs font-bold uppercase tracking-[0.18em] text-[#9aa8b7] md:text-left">App thống kê data</p>
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold tracking-[-0.01em] text-[#263142]">
                            @yield('header', 'Welcome Back')
                        </h1>
                        <p class="mt-4 text-xs font-medium leading-5 text-[#5f6d80]">
                            @yield('subheader', 'Today is a new day. It is your day. You shape it. Sign in to start managing your projects.')
                        </p>
                    </div>

                    @yield('content')
                </div>
            </section>

            <section class="relative hidden min-h-full overflow-hidden rounded-[16px] md:block" aria-label="Login visual">
                <img
                    src="https://images.unsplash.com/photo-1562690868-60bbe7293e94?auto=format&fit=crop&w=1200&q=85"
                    alt=""
                    class="h-full w-full object-cover"
                >
                <div class="absolute inset-0 bg-black/12"></div>
            </section>
        </main>
    </div>
</body>
</html>
