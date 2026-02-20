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
    'title' => 'Papp Zoltán | Webfejlesztés, Laravel, SQL, Linux & DevOps',
    'description' => 'Papp Zoltán IT specialista: üzleti weboldalak, Laravel/PHP fejlesztés, SQL alapú rendszerek, automatizálás, Linux és DevOps támogatás.',
    'heroTitle' => 'Webfejlesztés és IT megoldások, üzleti fókuszban',
    'heroText' => 'Papp Zoltán vagyok. PHP/Laravel, SQL és JavaScript alapokon építek gyors, stabil webes rendszereket. Linux és DevOps szemlélettel segítek, hogy a digitális működésed megbízhatóbb és hatékonyabb legyen.',
    'videoTitle' => '🎬 Rövid bemutatkozó videó (hamarosan)',
    'videoText' => 'Ide fog bekerülni a promo videóm. A fájlt elég a projekt gyökerébe feltölteni promo.mp4 néven.',
    'primaryCta' => '📩 Kérek ajánlatot',
    'secondaryCta' => '💻 Tech stackem',
    'tertiaryCta' => 'Munkáim »'
  ],
  'en' => [
    'title' => 'Zoltán Papp | Web Development, Laravel, SQL, Linux & DevOps',
    'description' => 'Zoltán Papp IT specialist: business websites, Laravel/PHP development, SQL-based systems, automation, Linux and DevOps support.',
    'heroTitle' => 'Business-focused Web Development & IT Solutions',
    'heroText' => 'I am Zoltán Papp. I build fast, stable web systems with PHP/Laravel, SQL and JavaScript. With a Linux + DevOps mindset, I help make your digital operations more reliable and efficient.',
    'videoTitle' => '🎬 Short Intro Video (coming soon)',
    'videoText' => 'My promo video will appear here. Just upload it to the project root as promo.mp4.',
    'primaryCta' => '📩 Request a quote',
    'secondaryCta' => '💻 My tech stack',
    'tertiaryCta' => 'My Works »'
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
      <a href="#technologiak"><?php echo ($lang === 'hu') ? 'Tech Stackem' : 'My Tech Stack'; ?></a>
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
    <div class="hero-video-placeholder" aria-label="Intro video placeholder">
      <h3><?php echo $meta[$lang]['videoTitle']; ?></h3>
      <video controls preload="metadata" class="hero-video">
        <source src="promo.mp4" type="video/mp4">
        <?php echo ($lang === 'hu') ? 'A böngésződ nem támogatja a videó lejátszást.' : 'Your browser does not support video playback.'; ?>
      </video>
      <p><?php echo $meta[$lang]['videoText']; ?></p>
    </div>
    <a href="#kapcsolat" class="cta-button"><?php echo $meta[$lang]['primaryCta']; ?></a>
    <a href="#technologiak" class="cta-button"><?php echo $meta[$lang]['secondaryCta']; ?></a>
    <a href="#projektek" class="cta-button"><?php echo $meta[$lang]['tertiaryCta']; ?></a>
  </div>


  <section id="szolgaltatasok">
    <h2><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></h2>
    <div class="services">

      <div class="service">
        <h3>💻 <?php echo ($lang === 'hu') ? 'Weboldalak, programok és automatizálás' : 'Websites, Software & Automation'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Webfejlesztés, egyedi programok és automatizálási megoldások: olyan rendszerek, amelyek kiváltják a manuális, időigényes feladatokat. Legyen szó bemutatkozó weboldalról, webshopról vagy belső céges alkalmazásról – mindig a hatékonyságot és a profi online jelenlétet helyezem előtérbe.'
            : 'Web development, custom software, and automation solutions: systems designed to replace manual, time-consuming tasks. From portfolio websites and e-shops to internal business applications – I always prioritize efficiency and a professional online presence.'; ?>
        </p>
      </div>


      <div class="service">
        <h3>🛠️ <?php echo ($lang === 'hu') ? 'Számítógép szerviz' : 'Computer Repair'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Laptopok és asztali gépek javítása, újratelepítés, gyorsítás, tisztítás és  optimalizálás – hogy eszközeid újra gyorsan és megbízhatóan működjenek.'
            : 'Laptop and desktop repair, reinstallations, SSD upgrades, cleaning and  optimization – so your devices run fast and reliably again.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🌐 <?php echo ($lang === 'hu') ? 'Hálózatépítés' : 'Networking'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Gyors és stabil internet bárhol: Wi-Fi és LAN hálózat kiépítés, router konfigurálás, hibajavítás, okosotthon eszközök beállítása.'
            : 'Fast and stable internet anywhere: Wi-Fi and LAN setup, router configuration, troubleshooting, and smart home device integration.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>📱 <?php echo ($lang === 'hu') ? 'Mobil szerviz' : 'Mobile Service'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Kijelző- és akkumulátorcsere, szoftverfrissítés és optimalizálás, tárhely felszabadítás – hogy a telefonod újra olyan legyen, mint új korában.'
            : 'Screen and battery replacement, software updates and optimization, storage cleanup – making your phone feel brand new.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>💽 <?php echo ($lang === 'hu') ? 'Szoftver beállítás' : 'Software Setup'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Windows és programok telepítése, frissítése, vírusvédelem és optimalizálás – teljes körű szoftveres támogatás, hogy időt és idegeskedést spórolj.'
            : 'Installation and configuration of Windows and software, updates, antivirus protection and optimization – saving you time and frustration.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>💾 <?php echo ($lang === 'hu') ? 'Biztonsági mentés és adatvédelem' : 'Backup & Data Security'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Megbízható biztonsági mentési rendszerek (felhő, NAS, külső HDD), vírusvédelem és jelszókezelés – hogy adataid mindig biztonságban legyenek.'
            : 'Reliable backup systems (cloud, NAS, external drives), antivirus and password management – keeping your data safe at all times.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🛒 <?php echo ($lang === 'hu') ? 'Eszközvásárlási tanácsadás' : 'Device Purchase Consulting'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Keret és igény alapján javaslat PC/laptop/telefon/NAS eszközökre, ár-érték arányra optimalizálva – beszerzésben és beüzemelésben is segítek, hogy biztosan jó döntést hozz.'
            : 'Recommendations for PCs/laptops/phones/NAS based on your budget and needs, optimized for value – I also help with procurement and setup so you make the right choice.'; ?>
        </p>
      </div>

      <div class="service">
        <h3>🔐 <?php echo ($lang === 'hu') ? 'IT tanácsadás' : 'IT Consulting'; ?></h3>
        <p>
          <?php echo ($lang === 'hu')
            ? 'Személyre szabott IT megoldások cégeknek és magánszemélyeknek: kiberbiztonság, rendszertervezés, költséghatékony digitális fejlesztések.'
            : 'Tailored IT solutions for individuals and businesses: cybersecurity, infrastructure planning, and cost-effective digital transformation.'; ?>
        </p>
      </div>

    </div>
  </section>

  <section id="projektek">
    <h2><?php echo ($lang === 'hu') ? 'Projektek' : 'Projects'; ?></h2>
    <div class="projects">
      <div class="project">
        <h3>🌯 GyrosCity</h3>
        <p><?php echo ($lang === 'hu') ? 'Gyorsétterem weboldal, webshop funkciók, online fizetés,és még rengeteg extra' : 'Fast-food restaurant website, webshop features, online payment,and lot of extra'; ?></p> <a href="https://gyroscity.eu" target="_blank" rel="noopener noreferrer"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
      </div>
      <div class="project">
        <h3>💈 ZCutzBarber</h3>
        <p><?php echo ($lang === 'hu') ? 'Fodrász weboldal időpontfoglalással és galériával.' : 'Barbershop website with booking and gallery.'; ?></p>
        <a href="https://zcutzbarber.com" target="_blank" rel="noopener noreferrer"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
      </div>
      <div class="project">
        <h3>🧰 <?php echo ($lang === 'hu') ? 'Hardveres megoldások' : 'Hardware Solutions'; ?></h3>
        <p><?php echo ($lang === 'hu') ? 'Számtalan sikeres hardveres fejlesztés és javítás (pl. gépépítés, diagnosztika, tuning).' : 'Various successful hardware builds and repairs (e.g. PC building, diagnostics, tuning).'; ?></p>
      </div>
      <div class="project">
        <h3>🧠 <?php echo ($lang === 'hu') ? 'Informatikai támogatás' : 'IT Support'; ?></h3>
        <p><?php echo ($lang === 'hu') ? 'Komplex rendszerek telepítése, konfigurálása és karbantartása magán- és céges ügyfeleknek.' : 'Installation, configuration and maintenance of complex systems for private and corporate clients.'; ?></p>
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
    <div class="contact-info">
      <p>📧 <strong>E-mail:</strong>
        <a href="mailto:m&#101;&#108;&#111;&#64;&#112;&#122;&#111;&#108;&#105;&#46;&#99;&#111;&#109;">
          m&#101;&#108;&#111;&#64;&#112;&#90;&#111;&#108;&#105;&#46;&#99;&#111;&#109;
        </a>
      </p>

      <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/papp-zoltán-41a7a4172/" target="_blank" rel="noopener noreferrer">linkedin.com/in/zoltan</a></p>
      <p>📷 <strong>Instagram:</strong> <a href="https://www.instagram.com/zoltan.ppp/#" target="_blank" rel="noopener noreferrer">@zoltan</a></p>
      <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/ztech20" target="_blank" rel="noopener noreferrer">facebook.com/zoltan</a></p>
      <?php if (isset($_GET['success'])): ?>
        <p class="form-success"><?php echo ($lang === 'hu') ? '✅ Köszönöm! Az üzeneted megérkezett.' : '✅ Thank you! Your message has been received.'; ?></p>
      <?php elseif (isset($_GET['error'])): ?>
        <p class="form-error"><?php echo ($lang === 'hu') ? '❌ Hiba történt az üzenetküldés során. Próbáld újra!' : '❌ Error sending message. Please try again!'; ?></p>
      <?php endif; ?>
    </div>

    <form class="contact-form" method="POST" action="send.php">
      <h3><?php echo ($lang === 'hu') ? '📨 Lépj kapcsolatba velem' : '📨 Get in Touch'; ?></h3>

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
                                ["> Rendszer inicializálása...", "> Biztonságos kapcsolat létrehozása...", "> Technológiák betöltése...", "> Állapot: Készen áll ✅", " Üdvözöllek a weboldalamon 👋"],
                                ["> 📡 Kapcsolat indítása...", "> Hálózati modul betöltve", "> Portfólió aktív ✅", "> Interfész megnyitása...", " Helló, látogató! 🙌"],
                                ["> 🔎 Diagnosztika...", "> Nincsenek hibák", "> Védelmi protokoll aktív", "> Betöltés 100% ✔️", " Üdv az oldalamon 🌐"],
                                ["> 🗂️ Adatok előkészítése...", "> Profil betöltve", "> Portfólió online ✅", " Köszöntelek az oldalamon 🙋‍♂️"]
                              ];
                              echo json_encode($lines_hu[array_rand($lines_hu)]);
                            } else {
                              $lines_en = [
                                ["> Initializing system...", "> Establishing secure connection...", "> Loading tech stack...", "> Status: Ready ✅", " Welcome to my site 👋"],
                                ["> 📡 Starting connection...", "> Network module online", "> Portfolio active ✅", "> Interface unlocked...", " Hello, visitor! Glad to have you here 🙌"],
                                ["> 🔎 Running diagnostics...", "> No errors found", "> Security protocol enabled", "> Load 100% ✔️", " Enjoy browsing and feel at home 🌐"],
                                ["> 🗂️ Preparing data...", "> Profile loaded", "> Portfolio online ✅", " Greetings and welcome to my portfolio 🙋‍♂️"]
                              ];
                              echo json_encode($lines_en[array_rand($lines_en)]);
                            }


                            ?>;

    const preloaderLines = <?php

                            $lines_hu = [
                              ["> 👋 Üdvözöllek!", "  Jó, hogy itt vagy 😊", "➡️ Indítás... 🟢"],
                              ["> 🤖 Helló, látogató!", "  Örülök, hogy benéztél 🙌", "➡️ Csatlakozás folyamatban..."],
                              ["> 🌟 Helló!", "  Örülök, hogy benéztél ✨", "➡️ Betöltés megkezdve..."],
                              ["> 🎉 Helló, látogató!", " Üdvözöllek 😎", "➡️ Indulunk! 🚀"]
                            ];

                            $lines_en = [
                              ["> 👋 Welcome!", "  Glad you're here 😊", "➡️ Starting... 🟢"],
                              ["> 🤖 Hello, visitor!", "  Great to have you 🙌", "➡️ Connecting..."],
                              ["> 🌟 Hello!", "  Happy to see you here ✨", "➡️ Loading started..."],
                              ["> 🎉 Hey visitor!", "  Welcome! 😎", "➡️ Let's go! 🚀"]
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
