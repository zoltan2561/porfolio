<?php
 include_once 'counter_daily.php'; 

$lang = 'hu';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['hu', 'en'])) {
    $lang = $_GET['lang'];
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <!-- Head-ben -->
<meta name="description" content="Papp Zoltán IT szakember – webfejlesztés, programozás, hálózat és IT támogatás. Segítek cégednek vagy projektednek a digitális világban.">
<meta property="og:title" content="Papp Zoltán | IT Portfólió">
<meta property="og:description" content="Több mint 10 év IT tapasztalattal vállalok webes és technikai megoldásokat.">
<meta property="og:image" content="https://pzoli.com/icons/profile-bw.jpg">
<meta property="og:type" content="website">
<meta property="og:url" content="https://pzoli.com">
<meta name="keywords" content="IT, webfejlesztés, Zoltán, PHP, hálózat, informatikus, programozó">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papp Zoltán IT specialista</title>
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
  <img src="icons/profile-bw.jpg" alt="Profilkép">
  <?php if ($lang === 'hu'): ?>
    <h1>Üdvözöllek a Weboldalamon</h1>
    <p>A nevem Papp Zoltán, IT specialista. Több mint 10 éve foglalkozom számítógépes rendszerekkel, szoftverfejlesztéssel, weboldalakkal, valamint hardveres és hálózati megoldásokkal. Célom, hogy ügyfeleimnek teljes körű és hatékony IT támogatást nyújtsak.</p>
    <a href="#kapcsolat" class="cta-button">Lépj kapcsolatba velem</a>
    <a href="#technologiak" class="cta-button">💻 Technológiai ismereteim</a>
  <?php else: ?>
    <h1>Welcome to My Website</h1>
    <p>My name is Zoltán Papp, an IT specialist with over 10 years of experience in computer systems, software development, websites, and hardware/network solutions. My goal is to provide clients with comprehensive and effective IT support.</p>
    <a href="#kapcsolat" class="cta-button">Contact me</a>
    <a href="#technologiak" class="cta-button">💻 My tech stack</a>
  <?php endif; ?>
</div>


<section id="szolgaltatasok">
  <h2><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></h2>
  <div class="services">

    <div class="service">
<<<<<<< HEAD
      <h3>💻 <?php echo ($lang === 'hu') ? 'Weboldalak és fejlesztés' : 'Websites & Development'; ?></h3>
      <p>
        <?php echo ($lang === 'hu') 
          ? 'Egyedi bemutatkozó weboldalak, névjegy oldalak és kisvállalkozásoknak készült webshopok – profi online jelenlét, ami ügyfeleket és bevételt hoz.'
          : 'Custom business card websites, personal portfolio pages, and small business e-shops – a professional online presence that attracts customers and generates revenue.'; ?>
      </p>
=======
      <h3>🛠️ <?php echo ($lang === 'hu') ? 'Számítógépes szerviz' : 'Computer Repair'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Hardver hibák javítása, gépépítés, tisztítás,  optimalizálás.' : 'Hardware troubleshooting, PC building, cleaning,  optimization.'; ?></p>
>>>>>>> 64a0221124cb72de7fea5ba369b03060d8d8b59d
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
<<<<<<< HEAD
      <h3>📱 <?php echo ($lang === 'hu') ? 'Mobil szerviz' : 'Mobile Service'; ?></h3>
      <p>
        <?php echo ($lang === 'hu') 
          ? 'Kijelző- és akkumulátorcsere, szoftverfrissítés és optimalizálás, tárhely felszabadítás – hogy a telefonod újra olyan legyen, mint új korában.'
          : 'Screen and battery replacement, software updates and optimization, storage cleanup – making your phone feel brand new.'; ?>
      </p>
    </div>
=======
  <h3>📣 <?php echo ($lang === 'hu') ? 'Online jelenlét & kampánykezelés' : 'Online Presence & Campaigns'; ?></h3>
  <p>
    <?php echo ($lang === 'hu') 
      ? 'Google Analytics, Facebook / Insta hirdetések, webes statisztika és célzott kampányok kezelése.' 
      : 'Google Analytics, Facebook / Insta ads, web stats and targeted campaign management.'; ?>
  </p>
</div>
>>>>>>> 64a0221124cb72de7fea5ba369b03060d8d8b59d

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
<p><?php echo ($lang === 'hu') ? 'Gyorsétterem weboldal, webshop funkciók, online fizetés, felhasználóprofil.' : 'Fast-food restaurant website, webshop features, online payment, user profile.'; ?></p>      <a href="https://gyroscity.eu" target="_blank"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
    </div>
    <div class="project">
      <h3>💈 ZCutzBarber</h3>
      <p><?php echo ($lang === 'hu') ? 'Fodrász weboldal időpontfoglalással és galériával.' : 'Barbershop website with booking and gallery.'; ?></p>
      <a href="https://zcutzbarber.com" target="_blank"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
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
<<<<<<< HEAD
    <p>📧 <strong>E-mail:</strong> <a href="mailto:melo@pzoli.com">melo@pZoli.com</a></p>
    <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/papp-zoltán-41a7a4172/" target="_blank">linkedin.com/in/zoltan</a></p>
    <p>📷 <strong>Instagram:</strong> <a href="https://www.instagram.com/zoltan.ppp/#" target="_blank">@zoltan</a></p>
    <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/ztech20" target="_blank">facebook.com/zoltan</a></p>
=======
    <p>📧 <strong>E-mail:</strong> <a href="mailto:pappzoltan6969@gmail.com">pappzoltan6969@gmail.com</a></p>
    <p>📱 <strong><?php echo ($lang === 'hu') ? 'Telefon:' : 'Phone:'; ?></strong> <a href="tel:+36201234567">+36 20 468 3837</a></p>
    <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/papp-zoltán-41a7a4172/" target="_blank">linkedin.com/in/zoltan</a></p>
    <p>📷 <strong>Instagram:</strong> <a href="https://www.instagram.com/zoltan.ppp/" target="_blank">@zoltan.ppp</a></p>
    <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/ztech20" target="_blank">facebook.com/ztech20</a></p>


>>>>>>> 64a0221124cb72de7fea5ba369b03060d8d8b59d
    <?php if (isset($_GET['success'])): ?>
      <p class="form-success"><?php echo ($lang === 'hu') ? '✅ Köszönöm! Az üzeneted megérkezett.' : '✅ Thank you! Your message has been received.'; ?></p>
    <?php elseif (isset($_GET['error'])): ?>
      <p class="form-error"><?php echo ($lang === 'hu') ? '❌ Hiba történt az üzenetküldés során. Próbáld újra!' : '❌ Error sending message. Please try again!'; ?></p>
    <?php endif; ?>
  </div>

  <form class="contact-form" method="POST" action="send.php">
  <h3><?php echo ($lang === 'hu') ? '📨 Lépj kapcsolatba velem' : '📨 Get in Touch'; ?></h3>

  <!-- Nyelv visszaadás redirecthez -->
  <input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang, ENT_QUOTES); ?>">

  <!-- Honeypot (rejtsd el CSS-sel) -->
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
      ["> 📡 Kapcsolat indítása...", "> Hálózati modul betöltve", "> Portfólió aktív ✅", "> Interfész megnyitása...", " Helló, látogató! Örülök, hogy benéztél 🙌"],
      ["> 🔎 Diagnosztika...", "> Nincsenek hibák", "> Védelmi protokoll aktív", "> Betöltés 100% ✔️", " Jó böngészést, érezd otthon magad 🌐"],
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
  ["> 🤖 Helló, látogató!", "  Hozzáférés engedélyezve ✅", "➡️ Csatlakozás folyamatban..."],
  ["> 🔎 Rendszerellenőrzés...", "  Nincsenek hibák", "➡️ Betöltés 100% ✅"],
  ["> 📡 Kapcsolat létrehozva", "  Biztonságos csatorna aktív", "➡️ Weboldal betöltése folyamatban..."],
  ["> 🔐 Hitelesítés sikeres", "  Felhasználói szint: Látogató", "➡️ Engedélyezett hozzáférés ✔️"]
];

$lines_en = [
  ["> 👋 Welcome!", "  Glad you're here 😊", "➡️ Entering... 🟢"],
  ["> 🤖 Hello, user!", "  Access granted ✅", "➡️ Connection in progress..."],
  ["> 🔎 System check...", "  All clear", "➡️ Load 100% ✅"],
  ["> 📡 Connection established", "  Secure channel active", "➡️ Website loading..."],
  ["> 🔐 Authentication successful", "  User level: Visitor", "➡️ Access granted ✔️"]
];



echo json_encode($lang === 'hu'
    ? $lines_hu[array_rand($lines_hu)]
    : $lines_en[array_rand($lines_en)]
);
?>;




</script>
<script src="script.js">
</script>


</body>
</html>  
