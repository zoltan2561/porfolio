@extends('layouts.portfolio')

@section('content')
    <section class="skills-page-hero">
        <div class="skills-page-card fade-in">
            <span class="section-chip">TECH STACK</span>
            <h1>{{ $page['hero_title'] }}</h1>
            <p>{{ $page['hero_text'] }}</p>
            <div class="hero-actions">
                <a href="{{ $links['contact'] }}" class="cta-button">{{ $page['primary_cta'] }}</a>
                <a href="{{ $links['projects'] }}" class="cta-button">{{ $page['secondary_cta'] }}</a>
            </div>
        </div>
    </section>

    @include($lang === 'hu' ? 'portfolio.partials.skills-hu' : 'portfolio.partials.skills-en')

    <section class="skills-page-cta">
        <div class="skills-page-card fade-in">
            <h2>{{ $page['footer_title'] }}</h2>
            <p>{{ $page['footer_text'] }}</p>
            <div class="hero-actions">
                <a href="{{ $links['contact'] }}" class="cta-button">{{ $page['primary_cta'] }}</a>
                <a href="{{ $homeUrl }}" class="cta-button">{{ $page['back_home'] }}</a>
            </div>
        </div>
    </section>
@endsection
