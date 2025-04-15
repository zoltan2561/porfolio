<?php
// index.php – Személyes IT portfólió (PHP alapú)
?><!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT Portfólió - Matrix Style</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>

  <canvas id="matrix"></canvas>

  <div class="nav-container">
    <div class="hamburger" onclick="toggleMenu()">☰</div>
    <nav id="main-nav">
      <a href="#rolam">Rólam</a>
      <a href="#szolgaltatasok">Szolgáltatások</a>
      <a href="#projektek">Projektek</a>
      <a href="#technologiak">Tech Stackem</a>
      <a href="#kapcsolat">Kapcsolat</a>
    </nav>
  </div>


  <div class="foreground" id="rolam">
    <img src="icons/profile-bw.jpg" alt="Profilkép">
    <h1>Üdvözöllek a Weboldalamon</h1>
    <p>A nevem Papp Zoltán, IT specialista. Több mint 10 éve foglalkozom számítógépes rendszerekkel, szoftverfejlesztéssel, weboldalakkal, valamint hardveres és hálózati megoldásokkal. Célom, hogy ügyfeleimnek teljes körű és hatékony IT támogatást nyújtsak.</p>
    <a href="#kapcsolat" class="cta-button">Lépj kapcsolatba velem</a>
    <a href="#technologiak" class="cta-button">💻 Nézd meg a technikai tudásom</a>

  </div>


  <section id="szolgaltatasok">
    <h2>Szolgáltatások</h2>
    <div class="services">
      <div class="service">
        <h3>🛠️ Számítógépes szerviz</h3>
        <p>Hardver hibák javítása, gépépítés, tisztítás, hűtés optimalizálás.</p>
      </div>
      <div class="service">
        <h3>💽 Szoftver telepítés</h3>
        <p>Windows, Linux, driverek, antivírus, programbeállítások.</p>
      </div>
      <div class="service">
        <h3>🌐 Hálózatépítés</h3>
        <p>Wi-Fi és LAN hálózat, router konfiguráció, hibakeresés.</p>
      </div>
      <div class="service">
        <h3>💾 Adatmentés</h3>
        <p>Mentés sérült HDD-ről, USB kulcsokról, backup rendszerek.</p>
      </div>
      <div class="service">
        <h3>💻 Programozás</h3>
        <p>Weboldalak, webshopok, PHP, Java, Python alkalmazások.</p>
      </div>
      <div class="service">
        <h3>🔐 IT tanácsadás</h3>
        <p>Konzultáció, kiberbiztonság, infrastruktúra tervezés cégeknek.</p>
      </div>
    </div>
  </section>


  <section id="projektek">
    <h2>Projektek</h2>
    <div class="projects">
      <div class="project">
        <h3>🌯 GyrosCity</h3>
        <p>GyrosCity.eu – Gyorsétterem weboldal, rendelési funkcióval.</p>
        <a href="https://gyroscity.eu" target="_blank">Weboldal megtekintése</a>
      </div>
      <div class="project">
        <h3>💈 ZCutzBarber</h3>
        <p>Zcutzbarber.com – Fodrász weboldal időpontfoglalással és galériával.</p>
        <a href="https://zcutzbarber.com" target="_blank">Weboldal megtekintése</a>
      </div>
      <div class="project">
        <h3>🧰 Hardveres megoldások</h3>
        <p>Számtalan sikeres hardveres fejlesztés és javítás (pl. gépépítés, diagnosztika, tuning).</p>
      </div>
      <div class="project">
        <h3>🧠 Informatikai támogatás</h3>
        <p>Komplex rendszerek telepítése, konfigurálása és karbantartása magán- és céges ügyfeleknek.</p>
      </div>
    </div>
    </section>


    <?php include 'skills.php'; ?>




  <section id="kapcsolat">
    <h2>Kapcsolat</h2>
    <div class="contact-info">
      <p>📧 <strong>E-mail:</strong> <a href="mailto:zoltan@example.com">zoltan@example.com</a></p>
      <p>📱 <strong>Telefon:</strong> <a href="tel:+36201234567">+36 20 123 4567</a></p>
      <p>💼 <strong>LinkedIn:</strong> <a href="https://linkedin.com/in/zoltan" target="_blank">linkedin.com/in/zoltan</a></p>
      <p>📷 <strong>Instagram:</strong> <a href="https://instagram.com/zoltan" target="_blank">@zoltan</a></p>
      <p>📘 <strong>Facebook:</strong> <a href="https://facebook.com/zoltan" target="_blank">facebook.com/zoltan</a></p>
      <?php if (isset($_GET['success'])): ?>
  <p class="form-success">✅ Köszönöm! Az üzeneted megérkezett.</p>
<?php elseif (isset($_GET['error'])): ?>
  <p class="form-error">❌ Hiba történt az üzenetküldés során. Próbáld újra!</p>
<?php endif; ?>

    </div>


    <form class="contact-form" method="POST" action="send.php">

      <h3>📨 Lépj kapcsolatba velem</h3>
      <input type="text" name="name" placeholder="Név" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <textarea name="message" rows="5" placeholder="Üzenet..." required></textarea>
      <button type="submit">📩 Küldés</button>
    </form>
  </section>

  <script src="script.js"></script>
</body>
</html>  