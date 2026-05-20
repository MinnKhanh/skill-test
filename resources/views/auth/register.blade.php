@extends('layouts.auth')

@section('title', 'Register')
@section('header', 'Create Account')
@section('subheader', 'Fill in your profile information to start using App thống kê data.')

@section('content')
<form id="registerForm" class="space-y-3" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    @if ($errors->any())
        <div class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
        <div>
            <label for="first_name" class="block text-xs font-bold text-[#334155]">Tên</label>
            <input id="first_name" name="first_name" value="{{ old('first_name') }}" required maxlength="{{ config('validate.max_length.name') }}"
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
        </div>
        <div>
            <label for="last_name" class="block text-xs font-bold text-[#334155]">Họ</label>
            <input id="last_name" name="last_name" value="{{ old('last_name') }}" required maxlength="{{ config('validate.max_length.name') }}"
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
        <div>
            <label for="age" class="block text-xs font-bold text-[#334155]">Tuổi</label>
            <input id="age" name="age" type="number" min="1" max="120" value="{{ old('age') }}" required
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
        </div>
        <div>
            <label for="gender" class="block text-xs font-bold text-[#334155]">Giới tính</label>
            <select id="gender" name="gender" required
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
                <option value="">Chọn</option>
                @foreach (\App\Enums\Gender::cases() as $gender)
                    <option value="{{ $gender->value }}" @selected(old('gender') === $gender->value)>{{ $gender->label() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label for="birth_date" class="block text-xs font-bold text-[#334155]">Ngày sinh</label>
        <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
    </div>

    <div>
        <label for="avatar" class="block text-xs font-bold text-[#334155]">Ảnh đại diện</label>
        <input id="avatar" name="avatar" type="file" accept="image/png,image/jpeg"
            class="mt-1.5 block w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 py-2 text-xs font-medium text-[#526174] shadow-sm file:mr-3 file:rounded-md file:border-0 file:bg-[#153342] file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-white">
    </div>

    <div>
        <label for="email" class="block text-xs font-bold text-[#334155]">Email</label>
        <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
            placeholder="Example@email.com">
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
        <div>
            <label for="password" class="block text-xs font-bold text-[#334155]">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
                placeholder="At least 8 characters">
        </div>
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-[#334155]">Confirm</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
        </div>
    </div>

    @if (config('services.recaptcha.enabled') && config('services.recaptcha.site_key'))
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
    @endif

    <button type="submit" id="submitBtn"
        class="flex h-10 w-full justify-center rounded-lg border border-transparent bg-[#153342] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#0d2634] focus:outline-none focus:ring-2 focus:ring-[#153342] focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-70">
        <span id="btnText">Create account</span>
        <svg id="loader" class="ml-2 hidden h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </button>

    <p class="pt-2 text-center text-xs font-semibold text-[#64748b]">
        Already have an account?
        <a href="{{ route('login') }}" class="font-bold text-[#2563eb] hover:text-[#153342]">Sign in</a>
    </p>
</form>

@if (config('services.recaptcha.enabled') && config('services.recaptcha.site_key'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<script>
    document.getElementById('registerForm').addEventListener('submit', function() {
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('loader').classList.remove('hidden');
        document.getElementById('btnText').textContent = 'Creating...';
    });
</script>
@endsection
