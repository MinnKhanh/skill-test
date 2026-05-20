@extends('layouts.auth')

@section('title', 'Sign In')
@section('header', 'Welcome Back 👋')
@section('subheader', 'Today is a new day. It is your day. You shape it. Sign in to start managing your projects.')

@section('content')
<form id="loginForm" class="space-y-4" action="{{ route('login') }}" method="POST" novalidate>
    @csrf

    @if (session('status'))
        <div class="rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-800" role="status">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div>
        <label for="email" class="block text-xs font-bold text-[#334155]">
            Email
        </label>
        <div class="relative mt-1.5">
            <input id="email" name="email" type="email" autocomplete="email" required maxlength="{{ config('validate.max_length.email', 255) }}"
                class="block h-10 w-full rounded-lg border @error('email') border-red-300 @else border-[#d9e2ec] @enderror bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] transition focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
                placeholder="Example@email.com" value="{{ old('email') }}" aria-describedby="@error('email') email-error @enderror">
        </div>
        @error('email')
            <p id="email-error" class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-xs font-bold text-[#334155]">
            Password
        </label>
        <div class="relative mt-1.5">
            <input id="password" name="password" type="password" autocomplete="current-password" required maxlength="{{ config('validate.max_length.password', 255) }}"
                class="block h-10 w-full rounded-lg border @error('password') border-red-300 @else border-[#d9e2ec] @enderror bg-[#f8fbfd] px-3 pr-14 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] transition focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
                placeholder="At least 8 characters" aria-describedby="@error('password') password-error @enderror">
            <button type="button" id="togglePassword"
                class="absolute inset-y-0 right-0 flex items-center px-3 text-xs font-bold text-[#64748b] hover:text-[#153342] focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
                aria-label="Show password">
                Show
            </button>
        </div>
        @error('password')
            <p id="password-error" class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox"
                class="h-3.5 w-3.5 rounded border-[#d9e2ec] text-[#153342] focus:ring-[#153342]">
            <label for="remember" class="ml-2 block text-xs font-semibold text-[#64748b]">
                Remember me
            </label>
        </div>

        <div class="text-xs">
            <a href="{{ Route::has('password.request') ? route('password.request') : '#' }}" class="font-bold text-[#2563eb] transition hover:text-[#153342]">
                Forgot Password?
            </a>
        </div>
    </div>

    <div>
        <button type="submit" id="submitBtn"
            class="flex h-10 w-full justify-center rounded-lg border border-transparent bg-[#153342] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#0d2634] focus:outline-none focus:ring-2 focus:ring-[#153342] focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-70">
            <span id="btnText">Sign in</span>
            <svg id="loader" class="ml-2 hidden h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </div>

    <div class="flex items-center gap-3 py-3">
        <div class="h-px flex-1 bg-[#e4eaf0]"></div>
        <span class="text-xs font-semibold text-[#94a3b8]">Or</span>
        <div class="h-px flex-1 bg-[#e4eaf0]"></div>
    </div>

    <div class="grid gap-2">
        <a href="{{ route('auth.google.redirect') }}" class="flex h-10 w-full items-center justify-center gap-3 rounded-lg bg-[#f3f8fb] text-xs font-bold text-[#526174] transition hover:bg-[#eaf2f7]">
            <span class="text-base leading-none text-[#4285f4]">G</span>
            <span>Sign in with Google</span>
        </a>
    </div>

    <p class="pt-5 text-center text-xs font-semibold text-[#64748b]">
        Do not you have an account?
        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="font-bold text-[#2563eb] hover:text-[#153342]">Sign up</a>
    </p>
</form>

<p class="mt-16 text-center text-[10px] font-bold uppercase text-[#b4bfcb]">© 2023 All Rights Reserved</p>

<script>
    const btn = document.getElementById('submitBtn');
    const loader = document.getElementById('loader');
    const btnText = document.getElementById('btnText');
    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function() {
        const isHidden = password.type === 'password';

        password.type = isHidden ? 'text' : 'password';
        togglePassword.textContent = isHidden ? 'Hide' : 'Show';
        togglePassword.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    });

    document.getElementById('loginForm').addEventListener('submit', function() {
        btn.disabled = true;
        loader.classList.remove('hidden');
        btnText.textContent = 'Signing in...';
    });
</script>
@endsection
