@extends('layouts.statistics')

@section('content')
    <section class="statistics-page statistics-dashboard">
        <div class="statistics-topbar">
            <div class="statistics-topbar-copy">
                <span class="section-chip">PRIVATE ANALYTICS</span>
                <p>{{ $lang === 'en' ? 'Protected statistics dashboard' : 'Vedett statisztikai dashboard' }}</p>
            </div>
            <form method="POST" action="{{ route('statistics.logout') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ $lang }}">
                <button type="submit" class="statistics-logout-button">{{ $lang === 'en' ? 'Logout' : 'Kilepes' }}</button>
            </form>
        </div>

        <div class="statistics-hero fade-in">
            <span class="section-chip">ANALYTICS</span>
            <h1>{{ $page['hero_title'] }}</h1>
            <p>{{ $page['hero_text'] }}</p>
            <p class="statistics-intro">{{ $page['intro'] }}</p>
        </div>

        <div class="statistics-grid">
            <article class="statistics-card fade-in">
                <span>{{ $page['cards']['today'] }}</span>
                <strong>{{ $stats['today']['unique'] }}</strong>
            </article>
            <article class="statistics-card fade-in">
                <span>{{ $page['cards']['total'] }}</span>
                <strong>{{ $stats['totals']['unique'] }}</strong>
            </article>
            <article class="statistics-card fade-in">
                <span>{{ $page['cards']['pageviews'] }}</span>
                <strong>{{ $stats['today']['pageviews'] }}</strong>
            </article>
            <article class="statistics-card fade-in">
                <span>{{ $page['cards']['mobile'] }}</span>
                <strong>{{ $stats['today']['Mobile'] }}</strong>
            </article>
            <article class="statistics-card fade-in">
                <span>{{ $page['cards']['desktop'] }}</span>
                <strong>{{ $stats['today']['Desktop'] }}</strong>
            </article>
        </div>

        <div class="statistics-panels">
            <article class="statistics-panel fade-in">
                <h2>{{ $page['chart_title'] }}</h2>
                <p>{{ $page['chart_text'] }}</p>

                @if (count($stats['chart']))
                    <div class="statistics-chart" aria-label="{{ $page['chart_title'] }}">
                        @php($maxVisits = max(array_column($stats['chart'], 'unique')) ?: 1)

                        @foreach ($stats['chart'] as $day)
                            <div class="statistics-bar-wrap">
                                <div class="statistics-bar-value">{{ $day['unique'] }} / {{ $day['pageviews'] }}</div>
                                <div class="statistics-bar">
                                    <span style="height: {{ max(10, (int) round(($day['unique'] / $maxVisits) * 100)) }}%"></span>
                                </div>
                                <div class="statistics-bar-label">{{ $day['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="statistics-empty">{{ $page['empty'] }}</p>
                @endif
            </article>

            <article class="statistics-panel fade-in">
                <h2>{{ $page['devices_title'] }}</h2>
                <div class="device-stats">
                    <div class="device-stat">
                        <span>Desktop</span>
                        <strong>{{ $stats['today']['Desktop'] }}</strong>
                    </div>
                    <div class="device-stat">
                        <span>Mobile</span>
                        <strong>{{ $stats['today']['Mobile'] }}</strong>
                    </div>
                    <div class="device-stat">
                        <span>Tablet</span>
                        <strong>{{ $stats['today']['Tablet'] }}</strong>
                    </div>
                </div>
            </article>
        </div>

        <div class="statistics-panels">
            <article class="statistics-panel fade-in">
                <h2>{{ $lang === 'en' ? 'Top countries today' : 'Mai top orszagok' }}</h2>
                @if (count($stats['todayCountries']))
                    <div class="device-stats">
                        @foreach ($stats['todayCountries'] as $country => $count)
                            <div class="device-stat">
                                <span>{{ $country }}</span>
                                <strong>{{ $count }}</strong>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="statistics-empty">{{ $page['empty'] }}</p>
                @endif
            </article>

            <article class="statistics-panel fade-in">
                <h2>{{ $lang === 'en' ? 'Most viewed pages' : 'Legnezettebb oldalak' }}</h2>
                @if (count($stats['topPages']))
                    <div class="device-stats">
                        @foreach ($stats['topPages'] as $path => $count)
                            <div class="device-stat">
                                <span>{{ $path }}</span>
                                <strong>{{ $count }}</strong>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="statistics-empty">{{ $page['empty'] }}</p>
                @endif
            </article>
        </div>

        <article class="statistics-panel fade-in">
            <h2>{{ $lang === 'en' ? 'Top countries overall' : 'Osszesitett top orszagok' }}</h2>
            @if (count($stats['topCountries']))
                <div class="device-stats">
                    @foreach ($stats['topCountries'] as $country => $count)
                        <div class="device-stat">
                            <span>{{ $country }}</span>
                            <strong>{{ $count }}</strong>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="statistics-empty">{{ $page['empty'] }}</p>
            @endif
        </article>

        <article class="statistics-panel fade-in">
            <h2>{{ $page['recent_title'] }}</h2>
            <p>{{ $page['recent_text'] }}</p>

            @if (count($stats['latestVisitors']))
                <div class="statistics-table-wrap">
                    <table class="statistics-table">
                        <thead>
                            <tr>
                                <th>{{ $lang === 'en' ? 'Date' : 'Datum' }}</th>
                                <th>{{ $lang === 'en' ? 'Time' : 'Ido' }}</th>
                                <th>IP</th>
                                <th>{{ $lang === 'en' ? 'Country' : 'Orszag' }}</th>
                                <th>{{ $lang === 'en' ? 'City' : 'Varos' }}</th>
                                <th>{{ $lang === 'en' ? 'Device' : 'Eszkoz' }}</th>
                                <th>{{ $lang === 'en' ? 'Page' : 'Oldal' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats['latestVisitors'] as $visitor)
                                <tr>
                                    <td>{{ $visitor['date'] }}</td>
                                    <td>{{ $visitor['time'] }}</td>
                                    <td>{{ $visitor['ip'] }}</td>
                                    <td>{{ $visitor['country'] }}</td>
                                    <td>{{ $visitor['city'] ?: '-' }}</td>
                                    <td>{{ $visitor['device'] }}</td>
                                    <td>{{ $visitor['path'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="statistics-empty">{{ $page['empty'] }}</p>
            @endif
        </article>
    </section>
@endsection
