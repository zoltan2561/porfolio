<?php

namespace App\Http\Controllers;

use App\Services\VisitorCounter;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home(Request $request, VisitorCounter $counter)
    {
        $lang = $this->resolveLocale($request);
        $counter->track($request);

        return view('portfolio.home', $this->buildPageData($lang, 'home'));
    }

    public function skills(Request $request, VisitorCounter $counter)
    {
        $lang = $this->resolveLocale($request);
        $counter->track($request);

        return view('portfolio.skills', $this->buildPageData($lang, 'skills'));
    }

    private function resolveLocale(Request $request): string
    {
        $lang = $request->query('lang') === 'en' ? 'en' : 'hu';

        app()->setLocale($lang);

        return $lang;
    }

    private function buildPageData(string $lang, string $page): array
    {
        $localeContent = config("portfolio.locales.{$lang}");
        $person = config('portfolio.person');
        $baseUrl = rtrim(config('portfolio.base_url') ?: config('app.url') ?: url('/'), '/');

        $homeUrl = route('home', $lang === 'en' ? ['lang' => 'en'] : []);
        $skillsUrl = route('skills', $lang === 'en' ? ['lang' => 'en'] : []);

        $homeHuUrl = route('home');
        $homeEnUrl = route('home', ['lang' => 'en']);
        $skillsHuUrl = route('skills');
        $skillsEnUrl = route('skills', ['lang' => 'en']);

        $meta = $localeContent['meta'][$page];
        $currentUrl = $page === 'home' ? ($lang === 'en' ? $homeEnUrl : $homeHuUrl) : ($lang === 'en' ? $skillsEnUrl : $skillsHuUrl);
        $canonicalUrl = $page === 'home' ? $homeHuUrl : $skillsHuUrl;

        $typewriterSets = $localeContent[$page]['typewriter_sets'];
        $typewriterLines = $typewriterSets[array_rand($typewriterSets)];

        $preloaderSets = $page === 'home' ? $localeContent['home']['preloader_sets'] : [];
        $preloaderLines = $preloaderSets ? $preloaderSets[array_rand($preloaderSets)] : [];

        $schema = $this->buildSchema($baseUrl, $currentUrl, $page, $meta, $person);

        return [
            'lang' => $lang,
            'pageName' => $page,
            'meta' => $meta,
            'person' => $person,
            'nav' => $localeContent['nav'],
            'page' => $localeContent[$page],
            'homeUrl' => $homeUrl,
            'skillsUrl' => $skillsUrl,
            'homeHuUrl' => $homeHuUrl,
            'homeEnUrl' => $homeEnUrl,
            'skillsHuUrl' => $skillsHuUrl,
            'skillsEnUrl' => $skillsEnUrl,
            'canonicalUrl' => $canonicalUrl,
            'currentUrl' => $currentUrl,
            'schemaJson' => json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
            'typewriterLines' => $typewriterLines,
            'preloaderLines' => $preloaderLines,
            'ogImage' => asset('icons/og.jpg'),
            'favicon' => asset('ico.png'),
            'assets' => [
                'css' => asset('Style.css'),
                'js' => asset('script.js'),
                'profile' => asset($person['image']),
                'cv' => asset('cv.pdf'),
            ],
            'links' => [
                'about' => $homeUrl.'#rolam',
                'services' => $homeUrl.'#szolgaltatasok',
                'projects' => $homeUrl.'#projektek',
                'contact' => $homeUrl.'#kapcsolat',
            ],
        ];
    }

    private function buildSchema(string $baseUrl, string $currentUrl, string $page, array $meta, array $person): array
    {
        $graph = [
            [
                '@type' => 'Person',
                '@id' => $baseUrl.'#person',
                'name' => $person['name'],
                'url' => $baseUrl,
                'image' => $baseUrl.'/icons/profile-bw.jpg',
                'jobTitle' => $person['job_title'],
                'sameAs' => $person['same_as'],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $baseUrl.'#website',
                'url' => $baseUrl,
                'name' => config('portfolio.site_name'),
                'inLanguage' => ['hu-HU', 'en-US'],
            ],
        ];

        if ($page === 'home') {
            $graph[] = [
                '@type' => 'ProfessionalService',
                '@id' => $baseUrl.'#service',
                'name' => 'Papp Zoltán digitális szolgáltatások',
                'url' => $baseUrl,
                'provider' => ['@id' => $baseUrl.'#person'],
                'areaServed' => 'HU',
                'serviceType' => config('portfolio.service_types'),
            ];
        } else {
            $graph[] = [
                '@type' => 'WebPage',
                '@id' => $currentUrl.'#webpage',
                'url' => $currentUrl,
                'name' => $meta['title'],
                'description' => $meta['description'],
                'isPartOf' => ['@id' => $baseUrl.'#website'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }
}
