<?php
include_once 'counter_daily.php';

$lang = 'hu';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['hu', 'en'], true)) {
  $lang = $_GET['lang'];
}

$baseUrl = 'https://pzoli.com';
$skillsPageUrl = 'skills-page.php' . ($lang === 'en' ? '?lang=en' : '');
$currentUrl = $baseUrl . '/skills-page.php' . ($lang === 'en' ? '?lang=en' : '');
$canonicalUrl = $baseUrl . '/skills-page.php';
$homeUrl = 'index.php' . ($lang === 'en' ? '?lang=en' : '');

$meta = [
  'hu' => [
    'title' => 'Papp Zoltán – Technológiák és szakmai háttér',
    'description' => 'Részletes áttekintés azokról a technológiákról és területekről, amelyekkel webes, automatizálási és IT projekteken dolgozom.',
    'heroTitle' => 'Technológiák és szakmai háttér',
    'heroText' => 'Itt találod részletesebben, milyen eszközökkel és rendszerekkel dolgozom. Ha neked inkább az a fontos, hogy miben tudok segíteni, a főoldalon rövidebben és ügyfélbarátabban is végigvezetlek rajta.',
    'primaryCta' => '📩 Beszéljünk a projektedről',
    'secondaryCta' => '🚀 Vissza a projektekhez',
    'backHome' => '⬅ Vissza a főoldalra',
    'navSkills' => 'Technológiák',
    'footerTitle' => 'Ha van egy konkrét elképzelésed',
    'footerText' => 'Nem kell előre tudnod, milyen stack kell hozzá. Elég, ha elmondod a célt, én segítek jó irányba bontani a technikai oldalt.'
  ],
  'en' => [
    'title' => 'Papp Zoltán – Technologies and Technical Background',
    'description' => 'A detailed overview of the technologies and areas I use across web, automation, and IT projects.',
    'heroTitle' => 'Technologies and Technical Background',
    'heroText' => 'This page gives a deeper look into the tools and systems I work with. If you only need the client-friendly overview, the homepage walks through it in a shorter way.',
    'primaryCta' => '📩 Let\'s talk about your project',
    'secondaryCta' => '🚀 Back to projects',
    'backHome' => '⬅ Back to home',
    'navSkills' => 'Tech Stack',
    'footerTitle' => 'If you already have an idea',
    'footerText' => 'You do not need to know the right stack in advance. It is enough to describe the goal, and I can help turn that into a practical technical direction.'
  ]
];

$schema = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'Person',
      '@id' => $baseUrl . '#person',
      'name' => 'Papp Zoltán',
      'url' => $baseUrl,
      'image' => $baseUrl . '/icons/profile-bw.jpg'
    ],
    [
      '@type' => 'WebPage',
      '@id' => $currentUrl . '#webpage',
      'url' => $currentUrl,
      'name' => $meta[$lang]['title'],
      'description' => $meta[$lang]['description'],
      'isPartOf' => ['@id' => $baseUrl . '#website'],
      'inLanguage' => $lang === 'hu' ? 'hu-HU' : 'en-US'
    ],
    [
      '@type' => 'WebSite',
      '@id' => $baseUrl . '#website',
      'url' => $baseUrl,
      'name' => 'Papp Zoltán Portfólió'
    ]
  ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang === 'hu' ? 'hu' : 'en'; ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($meta[$lang]['title'], ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($meta[$lang]['description'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="robots" content="index, follow, max-image-preview:large">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <link rel="alternate" hreflang="hu" href="<?php echo $baseUrl; ?>/skills-page.php">
  <link rel="alternate" hreflang="en" href="<?php echo $baseUrl; ?>/skills-page.php?lang=en">
  <link rel="alternate" hreflang="x-default" href="<?php echo $baseUrl; ?>/skills-page.php">

  <meta property="og:title" content="<?php echo htmlspecialchars($meta[$lang]['title'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($meta[$lang]['description'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image" content="<?php echo $baseUrl; ?>/icons/og.jpg">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:locale" content="<?php echo $lang === 'hu' ? 'hu_HU' : 'en_US'; ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($meta[$lang]['title'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($meta[$lang]['description'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="twitter:image" content="<?php echo $baseUrl; ?>/icons/og.jpg">

  <script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

  <link rel="stylesheet" href="Style.css">
</head>

<body>
  <canvas id="matrix"></canvas>

  <div class="language-switch">
    <a href="skills-page.php?lang=hu" class="<?php if ($lang === 'hu') echo 'active'; ?>">HUN</a> |
    <a href="skills-page.php?lang=en" class="<?php if ($lang === 'en') echo 'active'; ?>">ENG</a>
  </div>

  <div class="nav-container">
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <nav id="main-nav">
      <a href="<?php echo htmlspecialchars($homeUrl . '#rolam', ENT_QUOTES, 'UTF-8'); ?>"><?php echo ($lang === 'hu') ? 'Rólam' : 'About'; ?></a>
      <a href="<?php echo htmlspecialchars($homeUrl . '#szolgaltatasok', ENT_QUOTES, 'UTF-8'); ?>"><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></a>
      <a href="<?php echo htmlspecialchars($homeUrl . '#projektek', ENT_QUOTES, 'UTF-8'); ?>"><?php echo ($lang === 'hu') ? 'Projektek' : 'Projects'; ?></a>
      <a href="<?php echo htmlspecialchars($skillsPageUrl, ENT_QUOTES, 'UTF-8'); ?>" class="active"><?php echo $meta[$lang]['navSkills']; ?></a>
      <a href="<?php echo htmlspecialchars($homeUrl . '#kapcsolat', ENT_QUOTES, 'UTF-8'); ?>"><?php echo ($lang === 'hu') ? 'Kapcsolat' : 'Contact'; ?></a>
    </nav>
  </div>

  <div class="typewriter-container fade-in">
    <pre id="typewriter"></pre>
  </div>

  <section class="skills-page-hero">
    <div class="skills-page-card fade-in">
      <span class="section-chip">TECH STACK</span>
      <h1><?php echo $meta[$lang]['heroTitle']; ?></h1>
      <p><?php echo $meta[$lang]['heroText']; ?></p>
      <div class="hero-actions">
        <a href="<?php echo htmlspecialchars($homeUrl . '#kapcsolat', ENT_QUOTES, 'UTF-8'); ?>" class="cta-button"><?php echo $meta[$lang]['primaryCta']; ?></a>
        <a href="<?php echo htmlspecialchars($homeUrl . '#projektek', ENT_QUOTES, 'UTF-8'); ?>" class="cta-button"><?php echo $meta[$lang]['secondaryCta']; ?></a>
      </div>
    </div>
  </section>

  <?php
  if ($lang === 'hu') {
    include 'skills.php';
  } else {
    include 'skills_eng.php';
  }
  ?>

  <section class="skills-page-cta">
    <div class="skills-page-card fade-in">
      <h2><?php echo $meta[$lang]['footerTitle']; ?></h2>
      <p><?php echo $meta[$lang]['footerText']; ?></p>
      <div class="hero-actions">
        <a href="<?php echo htmlspecialchars($homeUrl . '#kapcsolat', ENT_QUOTES, 'UTF-8'); ?>" class="cta-button"><?php echo $meta[$lang]['primaryCta']; ?></a>
        <a href="<?php echo htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8'); ?>" class="cta-button"><?php echo $meta[$lang]['backHome']; ?></a>
      </div>
    </div>
  </section>

  <script>
    const typewriterLines = <?php
                            if ($lang === 'hu') {
                              $lines_hu = [
                                ["> Stack betöltése...", "> Webes rendszerek készen", "> Automatizálás aktív", "> IT háttér online", " Nézd meg részletesen, mivel dolgozom 👇"],
                                ["> Technológiák inicializálása...", "> Projektekhez használt eszközök listázva", "> Rendszer stabil ✅", " Itt a részletes szakmai háttér"]
                              ];
                              echo json_encode($lines_hu[array_rand($lines_hu)]);
                            } else {
                              $lines_en = [
                                ["> Loading stack...", "> Web systems ready", "> Automation active", "> IT background online", " Take a closer look at the tools I use 👇"],
                                ["> Initializing technologies...", "> Project toolkit listed", "> System stable ✅", " Here is the detailed technical background"]
                              ];
                              echo json_encode($lines_en[array_rand($lines_en)]);
                            }
                            ?>;

    const preloaderLines = [];
  </script>
  <script src="script.js"></script>
</body>

</html>
