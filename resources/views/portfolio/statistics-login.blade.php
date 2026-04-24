@extends('layouts.statistics')

@section('content')
    <section class="statistics-login-card fade-in visible">
        <span class="section-chip">PRIVATE STATS</span>
        <h1>{{ $lang === 'en' ? 'Statistics Access' : 'Statisztikai Belepes' }}</h1>
        <p>
            {{ $lang === 'en'
                ? 'This page is protected. Enter the password to open the statistics dashboard.'
                : 'Ez a felulet vedett. Add meg a jelszot a statisztikai dashboard megnyitasahoz.' }}
        </p>

        <form class="statistics-login-form" method="POST" action="{{ route('statistics.login') }}">
            @csrf
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="password" name="password" placeholder="{{ $lang === 'en' ? 'Password' : 'Jelszo' }}" required>
            <button type="submit">{{ $lang === 'en' ? 'Login' : 'Belepes' }}</button>
        </form>

        @error('password')
            <p class="form-error">{{ $message }}</p>
        @enderror

        @if ($passwordHint)
            <p class="statistics-hint">
                {{ $lang === 'en' ? 'Current password:' : 'Jelenlegi jelszo:' }} <strong>{{ $passwordHint }}</strong>
            </p>
        @endif
    </section>
@endsection
