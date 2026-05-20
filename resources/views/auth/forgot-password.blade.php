@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('header', 'Forgot Password')
@section('subheader', 'Enter your email and we will send reset instructions if the account exists.')

@section('content')
<form class="space-y-4" action="{{ route('password.email') }}" method="POST" novalidate>
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
        <label for="email" class="block text-xs font-bold text-[#334155]">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required
            class="mt-1.5 block h-10 w-full rounded-lg border border-[#d9e2ec] bg-[#f8fbfd] px-3 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"
            placeholder="Example@email.com">
    </div>

    <button type="submit" class="flex h-10 w-full justify-center rounded-lg border border-transparent bg-[#153342] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#0d2634] focus:outline-none focus:ring-2 focus:ring-[#153342] focus:ring-offset-2">
        Send reset link
    </button>

    <p class="pt-2 text-center text-xs font-semibold text-[#64748b]">
        <a href="{{ route('login') }}" class="font-bold text-[#2563eb] hover:text-[#153342]">Back to login</a>
    </p>
</form>
@endsection
