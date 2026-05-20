@extends('layouts.auth')

@section('title', 'Reset Password')
@section('header', 'Reset Password')
@section('subheader', 'Choose a new secure password for your account.')

@section('content')
<form class="space-y-4" action="{{ route('password.update') }}" method="POST" novalidate>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    @if ($errors->any())
        <div class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div>
        <label for="email" class="block text-xs font-bold text-[#334155]">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $email) }}" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
    </div>

    <div>
        <label for="password" class="block text-xs font-bold text-[#334155]">Password</label>
        <input id="password" name="password" type="password" autocomplete="new-password" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
    </div>

    <div>
        <label for="password_confirmation" class="block text-xs font-bold text-[#334155]">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10">
    </div>

    <button type="submit" class="flex h-10 w-full justify-center rounded-lg border border-transparent bg-[#153342] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#0d2634] focus:outline-none focus:ring-2 focus:ring-[#153342] focus:ring-offset-2">
        Reset password
    </button>
</form>
@endsection
