<?php
include_once 'counter_daily.php';

$lang = 'hu';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['hu', 'en'], true)) {
  $lang = $_GET['lang'];
}

$baseUrl = 'https://pzoli.com';
$currentUrl = $baseUrl . ($lang === 'en' ? '/?lang=en' : '/');
$canonicalUrl = $baseUrl . '/';

$meta = [
  'hu' => [
    'title' => 'Papp Zoltán – Webfejlesztő és IT szakember vállalkozásoknak',
    
    'description' => 'Weboldalak, webshopok, foglalási rendszerek, automatizálás és megbízható technikai háttér egy kézből. Fő fókuszban a vállalkozásoknak épített webes megoldások, kiegészítve gyakorlati IT és hardveres támogatással.',
    
    'heroTitle' => 'Webes megoldások vállalkozásoknak, stabil technikai háttérrel',
    
    'heroText' => 'Főként vállalkozásoknak készítek weboldalakat, webshopokat, foglalási rendszereket és egyedi fejlesztéseket, amik nemcsak jól néznek ki, hanem üzletileg is működnek. Emellett hardveres és általános IT feladatokban is tudok segíteni, ha egy projekt mögé megbízható technikai háttér kell.',
    
    'videoTitle' => 'Pár másodperc arról, hogyan dolgozom',
    
    'videoText' => 'Egy rövid betekintés a munkámba, ahol az ötletből valódi, használható megoldás lesz.',
    
    'primaryCta' => '📩 Beszéljünk a projektedről',
    'secondaryCta' => '💻 Technológiák, amiket ismerek',
    'tertiaryCta' => '🚀 Nézd meg a munkáim'
  ],

  'en' => [
  'title' => 'Papp Zoltán – Web Developer and IT Specialist for Businesses',
  
  'description' => 'Websites, webshops, booking systems, automation, and reliable technical support from one place. My main focus is building web solutions for businesses, backed by practical IT and hardware expertise when needed.',
  
  'heroTitle' => 'Web solutions for businesses, backed by reliable technical support',
  
  'heroText' => 'I mainly build websites, webshops, booking systems, and custom web solutions for businesses that need more than just a nice design. I also help with hardware and general IT tasks when a project needs dependable technical support behind it.',
  
  'videoTitle' => 'A quick look at how I work',
  
  'videoText' => 'A short look into my work, where ideas turn into real and usable solutions.',
  
  'primaryCta' => '📩 Let\'s talk about your project',
  'secondaryCta' => '💻 Technologies I know',
  'tertiaryCta' => '🚀 See my work'
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
      'image' => $baseUrl . '/icons/profile-bw.jpg',
      'jobTitle' => 'IT specialista',
      'sameAs' => [
        'https://linkedin.com/in/papp-zoltán-41a7a4172/',
        'https://www.instagram.com/zoltan.ppp/',
        'https://facebook.com/ztech20'
      ]
    ],
    [
      '@type' => 'ProfessionalService',
      '@id' => $baseUrl . '#service',
      'name' => 'Papp Zoltán IT szolgáltatások',
      'url' => $baseUrl,
      'provider' => ['@id' => $baseUrl . '#person'],
      'areaServed' => 'HU',
      'serviceType' => [
        'PHP és Laravel fejlesztés',
        'SQL adatbázis tervezés',
        'JavaScript alapú webes fejlesztés',
        'Linux és DevOps támogatás'
      ]
    ],
    [
      '@type' => 'WebSite',
      '@id' => $baseUrl . '#website',
      'url' => $baseUrl,
      'name' => 'Papp Zoltán Portfólió',
      'inLanguage' => ['hu-HU', 'en-US']
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
  <link rel="alternate" hreflang="hu" href="<?php echo $baseUrl; ?>/">
  <link rel="alternate" hreflang="en" href="<?php echo $baseUrl; ?>/?lang=en">
  <link rel="alternate" hreflang="x-default" href="<?php echo $baseUrl; ?>/">

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

  <div id="preloader">
    <pre id="preloader-text"></pre>
  </div>

  <canvas id="matrix"></canvas>

  <div class="language-switch">
    <a href="?lang=hu" class="<?php if ($lang === 'hu') echo 'active'; ?>">HUN</a> |
    <a href="?lang=en" class="<?php if ($lang === 'en') echo 'active'; ?>">ENG</a>
  </div>


  <div class="nav-container">
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <nav id="main-nav">
      <a href="#rolam"><?php echo ($lang === 'hu') ? 'Rólam' : 'About'; ?></a>
      <a href="#szolgaltatasok"><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></a>
      <a href="#projektek"><?php echo ($lang === 'hu') ? 'Projektek' : 'Projects'; ?></a>
      <a href="#technologiak"><?php echo ($lang === 'hu') ? 'Technológiák' : 'Tech Stack'; ?></a>
      <a href="#kapcsolat"><?php echo ($lang === 'hu') ? 'Kapcsolat' : 'Contact'; ?></a>
    </nav>

  </div>
  <div class="typewriter-container fade-in">
    <pre id="typewriter"></pre>
  </div>

  <div class="foreground" id="rolam">
    <img src="icons/profile-bw.jpg" alt="<?php echo ($lang === 'hu') ? 'Papp Zoltán profilkép' : 'Profile photo of Zoltán Papp'; ?>" loading="lazy" width="150" height="150">
    <h1><?php echo $meta[$lang]['heroTitle']; ?></h1>
    <p><?php echo $meta[$lang]['heroText']; ?></p>
    <div class="hero-video-placeholder fade-in" aria-label="Intro video placeholder">
      <span class="video-chip"><?php echo ($lang === 'hu') ? 'SHOWREEL' : 'SHOWREEL'; ?></span>
      <h3><?php echo $meta[$lang]['videoTitle']; ?></h3>
      <video id="intro-video" controls preload="metadata" class="hero-video" playsinline muted poster="icons/og.jpg">
        <source src="promo.mp4" type="video/mp4">
        <?php echo ($lang === 'hu') ? 'A böngésződ nem támogatja a videó lejátszást.' : 'Your browser does not support video playback.'; ?>
      </video>
      <p class="video-status" id="video-status"><?php echo ($lang === 'hu') ? 'Ha a videó nem indul el, a lejátszás gombbal manuálisan is elindíthatod.' : 'If the video does not start, you can launch it manually with the play button.'; ?></p>
      <p><?php echo $meta[$lang]['videoText']; ?></p>
    </div>
    <div class="hero-actions">
      <a href="#kapcsolat" class="cta-button"><?php echo $meta[$lang]['primaryCta']; ?></a>
      <a href="#technologiak" class="cta-button"><?php echo $meta[$lang]['secondaryCta']; ?></a>
      <a href="#projektek" class="cta-button"><?php echo $meta[$lang]['tertiaryCta']; ?></a>
    </div>
  </div>


  <section id="szolgaltatasok">
    <h2><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></h2>
    <p class="section-lead"><?php echo ($lang === 'hu') ? 'A fő fókuszom a vállalkozásoknak készített webes megoldásokon van, de ha kell, a mögöttes technikai és hardveres oldalt is átlátom és összerakom.' : 'My main focus is building web solutions for businesses, while also covering the technical and hardware side when a project needs it.'; ?></p>
    <div class="services">

      <div class="service">
        <h3>💻 <?php echo ($lang === 'hu') ? 'Weboldalak, programok és automatizálás' : 'Websites, Software & Automation'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Ha kell egy modern weboldal, online foglalás vagy valami, ami levesz adminisztrációt a válladról, ebben tudok segíteni. A cél mindig az, hogy egyszerűbb és gördülékenyebb legyen a működésed.'
            : 'If you need a modern website, online booking, or something that removes repetitive admin work from your day, I can help. The goal is always to make your business easier to run.'; ?>
        </p>
      </div>


      <div class="service">
        <h3>🛠️ <?php echo ($lang === 'hu') ? 'Hardveres támogatás' : 'Hardware Support'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Ha egy gépet bővíteni, rendbe tenni vagy stabilabbá tenni kell, abban is tudok segíteni. Ez jó kiegészítés akkor is, ha a webes projekt mellé a teljes technikai környezetet is össze kell rakni.'
            : 'If a machine needs upgrading, troubleshooting, or long-term stabilization, I can help there too. This is especially useful when a web project also needs the surrounding technical environment to be sorted out.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🌐 <?php echo ($lang === 'hu') ? 'Hálózat és technikai háttér' : 'Network & Technical Infrastructure'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Ha egy vállalkozásnál a webes rendszer mellé stabil hálózat, jobb Wi-Fi vagy rendezettebb technikai háttér kell, ebben is tudok gyakorlati segítséget adni.'
            : 'If a business needs stable networking, better Wi-Fi, or a cleaner technical setup behind its web systems, I can help with that in a practical way.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>📱 <?php echo ($lang === 'hu') ? 'Eszközök és napi IT támogatás' : 'Devices & Day-to-Day IT Support'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Ha a napi működésedhez használt eszközök, szoftverek vagy beállítások körül van elakadás, segítek gyorsan használható állapotba hozni őket.'
            : 'If the devices, software, or settings behind your daily work are causing friction, I can help get them back into a fast and usable state.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>💽 <?php echo ($lang === 'hu') ? 'Szoftver beállítás' : 'Software Setup'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Programok telepítése, beállítása és rendberakása úgy, hogy ne neked kelljen vele órákig szenvedni. Olyan gépet kapsz vissza, ami tényleg használatra kész.'
            : 'Software installation and setup done properly, so you do not have to waste hours figuring everything out. You get a machine back that is actually ready to use.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>💾 <?php echo ($lang === 'hu') ? 'Biztonsági mentés és adatvédelem' : 'Backup & Data Security'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Mentés, helyreállítás, jelszókezelés és alap biztonsági higiénia. Az adat akkor érték, ha vissza is lehet hozni, amikor tényleg szükség van rá.'
            : 'Backups, recovery plans, password management, and practical security hygiene. Data only has real value if it can be restored when it matters.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🛒 <?php echo ($lang === 'hu') ? 'Eszközvásárlási tanácsadás' : 'Device Purchase Consulting'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Segítek jól vásárolni, nem csak sokat költeni. Igény, keret és használat alapján ajánlok eszközt, és a beüzemelésben is ott vagyok.'
            : 'I help you buy well, not just spend more. Recommendations are based on needs, budget, and actual use, with setup support included if needed.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🔐 <?php echo ($lang === 'hu') ? 'Technikai tanácsadás' : 'Technical Consulting'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Ha azt kell eldönteni, milyen rendszerre, fejlesztésre vagy technikai háttérre van valóban szükséged, segítek tisztán látni és jó irányba indulni.'
            : 'If you need to decide what kind of system, development work, or technical setup actually makes sense, I can help you choose a clear and practical direction.'; ?>
        </p>
      </div>

    </div>
  </section>

  <section id="projektek">
    <h2><?php echo ($lang === 'hu') ? 'Projektek' : 'Projects'; ?></h2>
    <p class="section-lead"><?php echo ($lang === 'hu') ? 'Néhány példa arra, hogyan lesz a technikából valódi üzleti eszköz.' : 'A few examples of how technology becomes a real business tool.'; ?></p>
    <div class="projects">
      <div class="project">
        <h3>🌯 GyrosCity</h3>
        <p><?php echo ($lang === 'hu') ? 'Éttermi weboldal rendelési és online fizetési folyamattal, gyors kiszolgálásra és egyszerű konverzióra hangolva.' : 'Restaurant website with ordering and online payment flow, designed for smooth conversions and quick customer action.'; ?></p> <a href="https://gyroscity.eu" target="_blank" rel="noopener noreferrer"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
      </div>
      <div class="project">
        <h3>💈 ZCutzBarber</h3>
        <p><?php echo ($lang === 'hu') ? 'Barber brandre szabott oldal online foglalással, erős vizuális jelenléttel és gördülékeny ügyfélúttal.' : 'Brand-focused barbershop site with online booking, strong visuals, and a smoother customer journey.'; ?></p>
        <a href="https://zcutzbarber.com" target="_blank" rel="noopener noreferrer"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
      </div>
      <div class="project">
        <h3>🧰 <?php echo ($lang === 'hu') ? 'Hardveres megoldások' : 'Hardware Solutions'; ?></h3>
        <p><?php echo ($lang === 'hu') ? 'Személyre szabott gépépítések, bővítések, diagnosztika és üzembiztos működésre hangolt hardveres támogatás.' : 'Custom PC builds, upgrades, diagnostics, and hardware support focused on stable long-term performance.'; ?></p>
      </div>
      <div class="project">
        <h3>🧠 <?php echo ($lang === 'hu') ? 'Informatikai támogatás' : 'IT Support'; ?></h3>
        <p><?php echo ($lang === 'hu') ? 'Napi működést támogató IT háttér, hibakezelés, rendszerkarbantartás és átlátható technikai támogatás magán- és üzleti oldalon.' : 'Reliable day-to-day IT support, troubleshooting, maintenance, and clear technical guidance for both private and business clients.'; ?></p>
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

  <section id="kapcsolat">

    <h2><?php echo ($lang === 'hu') ? 'Kapcsolat' : 'Contact'; ?></h2>
    <p class="contact-lead"><?php echo ($lang === 'hu') ? 'Ha van egy ötleted, elakadásod vagy kinőtt rendszered, írj nyugodtan. Átnézem, megmondom mi lehet a jó irány, és közösen kitaláljuk a következő lépést.' : 'If you have an idea, a blocker, or a system you have outgrown, feel free to reach out. I will review it, suggest a good direction, and we can figure out the next step together.'; ?></p>
    <div class="contact-info">
      <p>📧 <strong>E-mail:</strong>
        <a href="mailto:m&#101;&#108;&#111;&#64;&#112;&#122;&#111;&#108;&#105;&#46;&#99;&#111;&#109;">
          m&#101;&#108;&#111;&#64;&#112;&#90;&#111;&#108;&#105;&#46;&#99;&#111;&#109;
        </a>
      </p>

      <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/papp-zoltán-41a7a4172/" target="_blank" rel="noopener noreferrer"><?php echo ($lang === 'hu') ? 'LinkedIn profil megnyitása' : 'Open LinkedIn profile'; ?></a></p>
      <p>📷 <strong>Instagram:</strong> <a href="https://www.instagram.com/zoltan.ppp/" target="_blank" rel="noopener noreferrer">@zoltan.ppp</a></p>
      <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/ztech20" target="_blank" rel="noopener noreferrer">facebook.com/ztech20</a></p>
      <?php if (isset($_GET['success'])): ?>
        <p class="form-success"><?php echo ($lang === 'hu') ? '✅ Köszönöm! Az üzeneted megérkezett.' : '✅ Thank you! Your message has been received.'; ?></p>
      <?php elseif (isset($_GET['error'])): ?>
        <p class="form-error"><?php echo ($lang === 'hu') ? '❌ Hiba történt az üzenetküldés során. Próbáld újra!' : '❌ Error sending message. Please try again!'; ?></p>
      <?php endif; ?>
    </div>

    <form class="contact-form" method="POST" action="send.php">
      <h3><?php echo ($lang === 'hu') ? '📨 Írd meg, miben segíthetek' : '📨 Tell me what you need'; ?></h3>

      <input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang, ENT_QUOTES); ?>">
      <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

      <input type="text" name="name" placeholder="<?php echo ($lang === 'hu') ? 'Név' : 'Name'; ?>" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <textarea name="message" rows="5" placeholder="<?php echo ($lang === 'hu') ? 'Üzenet...' : 'Message...'; ?>" required></textarea>
      <button type="submit"><?php echo ($lang === 'hu') ? '📩 Küldés' : '📩 Send'; ?></button>
    </form>

  </section>

  <script>
    const typewriterLines = <?php

                            if ($lang === 'hu') {
                              $lines_hu = [
                                ["> Rendszer inicializálása...", "> Üzleti megoldások betöltése...", "> Technológiák aktiválva...", "> Állapot: Készen a közös munkára ✅", " Helló, ez itt az én digitális műhelyem 👋"],
                                ["> 📡 Kapcsolat indítása...", "> Portfólió modul betöltve", "> Rendszerek online ✅", "> Interfész megnyitása...", " Nézz körül, itt valódi megoldások készülnek 🙌"],
                                ["> 🔎 Diagnosztika...", "> Nincsenek kritikus hibák", "> Fejlesztői környezet aktív", "> Betöltés 100% ✔️", " Üdv, indulhatunk 🌐"],
                                ["> 🗂️ Adatok előkészítése...", "> Profil betöltve", "> Projektmód aktiválva ✅", " Jó helyen jársz, ha profi rendszert akarsz 🚀"]
                              ];
                              echo json_encode($lines_hu[array_rand($lines_hu)]);
                            } else {
                              $lines_en = [
                                ["> Initializing system...", "> Loading business-ready solutions...", "> Tech stack activated...", "> Status: Ready to build ✅", " Welcome to my digital workshop 👋"],
                                ["> 📡 Starting connection...", "> Portfolio module online", "> Systems ready ✅", "> Interface unlocked...", " Take a look around, this is where ideas become products 🙌"],
                                ["> 🔎 Running diagnostics...", "> No critical errors found", "> Dev environment active", "> Load 100% ✔️", " Ready when you are 🌐"],
                                ["> 🗂️ Preparing data...", "> Profile loaded", "> Project mode enabled ✅", " You are in the right place for clean and powerful solutions 🚀"]
                              ];
                              echo json_encode($lines_en[array_rand($lines_en)]);
                            }


                            ?>;

    const preloaderLines = <?php

                            $lines_hu = [
                              ["> 👋 Üdvözöllek!", "  Jó, hogy itt vagy 😊", "➡️ Digitális műhely indítása... 🟢"],
                              ["> 🤖 Helló!", "  Rendszerek előkészítése folyamatban 🙌", "➡️ Csatlakozás..."],
                              ["> 🌟 Portfólió indítása", "  Megoldások betöltése ✨", "➡️ Kezdünk..."],
                              ["> 🎉 Minden készen áll", "  Mehet a következő projekt 😎", "➡️ Belépés... 🚀"]
                            ];

                            $lines_en = [
                              ["> 👋 Welcome!", "  Glad you're here 😊", "➡️ Starting the digital workshop... 🟢"],
                              ["> 🤖 Hello!", "  Preparing systems and tools 🙌", "➡️ Connecting..."],
                              ["> 🌟 Portfolio booting", "  Loading solutions ✨", "➡️ Starting up..."],
                              ["> 🎉 Everything is ready", "  Time to build something great 😎", "➡️ Entering... 🚀"]
                            ];

                            echo json_encode(
                              $lang === 'hu'
                                ? $lines_hu[array_rand($lines_hu)]
                                : $lines_en[array_rand($lines_en)]
                            );
                            ?>;
  </script>
  <script src="script.js"></script>


</body>

</html>
