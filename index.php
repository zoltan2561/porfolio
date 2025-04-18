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
<meta name="description" content="Papp Zoltán IT Portfólió - Webfejlesztés, programozás, hálózatépítés és rendszertámogatás.">
<meta property="og:title" content="Papp Zoltán | IT Portfólió">
<meta property="og:description" content="Több mint 10 év IT tapasztalattal vállalok webes és technikai megoldásokat.">
<meta property="og:image" content="https://sajatdomain.hu/icons/profile-bw.jpg">
<meta property="og:type" content="website">
<meta property="og:url" content="https://sajatdomain.hu">
<meta name="description" content="Papp Zoltán IT szakember portfóliója – webfejlesztés, programozás, hálózat és IT tanácsadás.">
<meta name="keywords" content="IT, webfejlesztés, Zoltán, PHP, hálózat, informatikus, programozó">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papp Zoltán</title>
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
    <a href="#technologiak" class="cta-button">💻 Nézd meg a technikai tudásom</a>
  <?php else: ?>
    <h1>Welcome to My Website</h1>
    <p>My name is Zoltán Papp, an IT specialist with over 10 years of experience in computer systems, software development, websites, and hardware/network solutions. My goal is to provide clients with comprehensive and effective IT support.</p>
    <a href="#kapcsolat" class="cta-button">Contact me</a>
    <a href="#technologiak" class="cta-button">💻 Check out my tech stack</a>
  <?php endif; ?>
</div>



<section id="szolgaltatasok">
  <h2><?php echo ($lang === 'hu') ? 'Szolgáltatások' : 'Services'; ?></h2>
  <div class="services">
    <div class="service">
      <h3>🛠️ <?php echo ($lang === 'hu') ? 'Számítógépes szerviz' : 'Computer Repair'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Hardver hibák javítása, gépépítés, tisztítás,  optimalizálás.' : 'Hardware troubleshooting, PC building, cleaning,  optimization.'; ?></p>
    </div>
    <div class="service">
      <h3>💽 <?php echo ($lang === 'hu') ? 'Szoftver telepítés' : 'Software Installation'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Windows, Linux, driverek, antivírus, programbeállítások.' : 'Windows, Linux, drivers, antivirus, program setup.'; ?></p>
    </div>
    <div class="service">
      <h3>🌐 <?php echo ($lang === 'hu') ? 'Hálózatépítés' : 'Networking'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Wi-Fi és LAN hálózat, router konfiguráció, hibakeresés.' : 'Wi-Fi and LAN setup, router configuration, troubleshooting.'; ?></p>
    </div>
    <div class="service">
  <h3>📣 <?php echo ($lang === 'hu') ? 'Online jelenlét & kampánykezelés' : 'Online Presence & Campaigns'; ?></h3>
  <p>
    <?php echo ($lang === 'hu') 
      ? 'Google Analytics, Facebook / Insta hirdetések, webes statisztika és célzott kampányok kezelése.' 
      : 'Google Analytics, Facebook / Insta ads, web stats and targeted campaign management.'; ?>
  </p>
</div>

    <div class="service">
      <h3>💻 <?php echo ($lang === 'hu') ? 'Programozás' : 'Programming'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Weboldalak, webshopok, PHP, Java, Python alkalmazások.' : 'Websites, e-shops, PHP, Java, Python applications.'; ?></p>
    </div>
    <div class="service">
      <h3>🔐 <?php echo ($lang === 'hu') ? 'IT tanácsadás' : 'IT Consulting'; ?></h3>
      <p><?php echo ($lang === 'hu') ? 'Konzultáció, kiberbiztonság, infrastruktúra tervezés cégeknek.' : 'Consulting, cybersecurity, infrastructure planning for companies.'; ?></p>
    </div>
  </div>
</section>



<section id="projektek">
  <h2><?php echo ($lang === 'hu') ? 'Projektek' : 'Projects'; ?></h2>
  <div class="projects">
    <div class="project">
      <h3>🌯 GyrosCity</h3>
      <p><?php echo ($lang === 'hu') ? 'Gyorsétterem weboldal, rendelési funkcióval.' : 'Fast food restaurant website with ordering system.'; ?></p>
      <a href="https://gyroscity.eu" target="_blank"><?php echo ($lang === 'hu') ? 'Weboldal megtekintése' : 'View Website'; ?></a>
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
    <p>📧 <strong>E-mail:</strong> <a href="mailto:pappzoltan6969@gmail.com">pappzoltan6969@gmail.com</a></p>
    <p>📱 <strong><?php echo ($lang === 'hu') ? 'Telefon:' : 'Phone:'; ?></strong> <a href="tel:+36201234567">+36 20 468 3837</a></p>
    <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/papp-zoltán-41a7a4172/" target="_blank">linkedin.com/in/zoltan</a></p>
    <p>📷 <strong>Instagram:</strong> <a href="https://www.instagram.com/zoltan.ppp/" target="_blank">@zoltan.ppp</a></p>
    <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/ztech20" target="_blank">facebook.com/ztech20</a></p>


    <?php if (isset($_GET['success'])): ?>
      <p class="form-success"><?php echo ($lang === 'hu') ? '✅ Köszönöm! Az üzeneted megérkezett.' : '✅ Thank you! Your message has been received.'; ?></p>
    <?php elseif (isset($_GET['error'])): ?>
      <p class="form-error"><?php echo ($lang === 'hu') ? '❌ Hiba történt az üzenetküldés során. Próbáld újra!' : '❌ Error sending message. Please try again!'; ?></p>
    <?php endif; ?>
  </div>

  <form class="contact-form" method="POST" action="send.php">
    <h3><?php echo ($lang === 'hu') ? '📨 Lépj kapcsolatba velem' : '📨 Get in Touch'; ?></h3>
    <input type="text" name="name" placeholder="<?php echo ($lang === 'hu') ? 'Név' : 'Name'; ?>" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <textarea name="message" rows="5" placeholder="<?php echo ($lang === 'hu') ? 'Üzenet...' : 'Message...'; ?>" required></textarea>
    <button type="submit"><?php echo ($lang === 'hu') ? '📩 Küldés' : '📩 Send'; ?></button>
  </form>
</section>

<script>
const typewriterLines = <?php
  if ($lang === 'hu') {
    echo json_encode([
      "> Rendszer inicializálása...",
      "> Biztonságos kapcsolat létrehozása...",
      "> Technológiák betöltése...",
      "> Állapot: Készen áll ✅",
      " Üdvözöllek 👋 "
    ]);
  } else {
    echo json_encode([
      "> Initializing system...",
      "> Establishing secure connection...",
      "> Loading tech stack...",
      "> Status: Ready ✅",
       "Welcome 👋",
    ]);
  }
?>;

const preloaderLines = <?php

$lines_hu = [
  ["> 👋 Üdvözöllek!", "  Jó, hogy itt vagy 😊", "➡️ Indul a Mátrix... 🟢"],
  ["> 💡 Felhasználó észlelve", "  ZOLTÁN.PHP aktiválva", "➡️ Rendszerindítás 🔄"],
  ["> 🤖 Helló, látogató!", "  Hozzáférés engedélyezve ✅", "➡️ Csatlakozás folyamatban..."],
  ["> 🚀 Elindulunk...", "  Már csak pár másodperc!", "➡️ Mátrix interfész nyitása..."]
];

$lines_en = [
  ["> 👋 Welcome!", "  Glad you're here 😊", "➡️ Entering the Matrix... 🟢"],
  ["> 💡 Visitor detected", "  ZOLTAN.PHP activated", "➡️ System boot 🔄"],
  ["> 🤖 Hello, user!", "  Access granted ✅", "➡️ Connection in progress..."],
  ["> 🚀 Initiating launch...", "  Just a few seconds!", "➡️ Opening Matrix interface..."]
];

echo json_encode($lang === 'hu'
    ? $lines_hu[array_rand($lines_hu)]
    : $lines_en[array_rand($lines_en)]
);
?>;


</script>

  <script src="script.js"></script>
</body>
</html>  