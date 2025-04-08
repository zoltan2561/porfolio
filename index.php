<?php
// index.php – Személyes IT portfólió (PHP alapú)
?><!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT Portfólió - Matrix Style</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
      font-family: 'Courier New', Courier, monospace;
      background: black;
      color: white;
    }

    canvas {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 0;
    }

    nav {
      position: fixed;
      top: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 1rem 0.5rem;
      z-index: 2;
    }

    nav a {
      color: #0f0;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
      font-size: 0.95rem;
    }

    nav a:hover {
      color: #00ffee;
    }

    .foreground {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, 0.5);
      padding-top: 80px;
      text-align: center;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .foreground img {
      width: 150px;
      height: auto;
      border-radius: 50%;
      filter: grayscale(100%);
      margin-bottom: 1rem;
    }

    .foreground h1 {
      font-size: 2rem;
      margin: 0;
    }

    .foreground p {
      font-size: 1rem;
      margin-top: 0.5rem;
    }

    .cv-button {
      margin-top: 1.5rem;
      padding: 0.8rem 1.5rem;
      font-size: 1rem;
      font-weight: bold;
      color: #0f0;
      background-color: transparent;
      border: 2px solid #0f0;
      border-radius: 5px;
      text-decoration: none;
      transition: all 0.3s;
    }

    .cv-button:hover {
      background-color: #0f0;
      color: black;
    }

    section {
      position: relative;
      z-index: 1;
      padding: 3rem 1rem;
      background-color: rgba(0, 0, 0, 0.85);
    }

    section h2 {
      color: #00ffee;
      text-align: center;
      margin-bottom: 2rem;
    }

    .services, .projects {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .service, .project {
      background-color: rgba(0, 0, 0, 0.6);
      border: 1px solid #0f0;
      border-radius: 10px;
      padding: 1rem;
      width: 280px;
      text-align: center;
    }

    .service img, .project img {
      width: 48px;
      height: 48px;
      margin-bottom: 0.5rem;
    }

    .service h3, .project h3 {
      color: #0f0;
      margin: 0.5rem 0;
    }

    .service p, .project p {
      font-size: 0.95rem;
    }

    .project a {
      display: inline-block;
      margin-top: 0.5rem;
      color: #00ffee;
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .foreground h1 {
        font-size: 1.6rem;
      }
      .foreground p {
        font-size: 0.95rem;
      }
      .cv-button {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
      }
      .service, .project {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <canvas id="matrix"></canvas>

  <nav>
    <a href="#rolam">Rólam</a>
    <a href="#szolgaltatasok">Szolgáltatások</a>
    <a href="#projektek">Projektek</a>
    <a href="#kapcsolat">Kapcsolat</a>
  </nav>

  <div class="foreground" id="rolam">
    <img src="profile-bw.jpg" alt="Profilkép">
    <h1>Üdvözöllek a Weboldalamon</h1>
    <p>A nevem Papp Zoltán, IT specialista – Minden, ami informatika!</p>
    <a href="cv/PappZoltan-CV.pdf" class="cv-button" download>Önéletrajz letöltése</a>
  </div>

  <section id="szolgaltatasok">
    <h2>Szolgáltatások</h2>
    <div class="services">
      <div class="service">
        <img src="icons/repair.png" alt="Szerviz ikon">
        <h3>Számítógépes szerviz</h3>
        <p>Hardver hibák javítása, gépépítés, tisztítás, hűtés optimalizálás.</p>
      </div>
      <div class="service">
        <img src="icons/software.png" alt="Szoftver ikon">
        <h3>Szoftver telepítés</h3>
        <p>Windows, Linux, driverek, antivírus, programbeállítások.</p>
      </div>
      <div class="service">
        <img src="icons/network.png" alt="Hálózat ikon">
        <h3>Hálózatépítés</h3>
        <p>Wi-Fi és LAN hálózat, router konfiguráció, hibakeresés.</p>
      </div>
      <div class="service">
        <img src="icons/data.png" alt="Adatmentés ikon">
        <h3>Adatmentés</h3>
        <p>Mentés sérült HDD-ről, USB kulcsokról, backup rendszerek.</p>
      </div>
      <div class="service">
        <img src="icons/code.png" alt="Fejlesztés ikon">
        <h3>Programozás</h3>
        <p>Weboldalak, webshopok, PHP, Java, Python alkalmazások.</p>
      </div>
      <div class="service">
        <img src="icons/security.png" alt="Biztonság ikon">
        <h3>IT tanácsadás</h3>
        <p>Konzultáció, kiberbiztonság, infrastruktúra tervezés cégeknek.</p>
      </div>
    </div>
  </section>

  <section id="projektek">
    <h2>Projektek</h2>
    <div class="projects">
      <div class="project">
        <img src="icons/web.png" alt="Webprojekt">
        <h3>GyrosCity</h3>
        <p>GyrosCity.eu – Gyorsétterem weboldal, rendelési funkcióval.</p>
        <a href="https://gyroscity.eu" target="_blank">Weboldal megtekintése</a>
      </div>
      <div class="project">
        <img src="icons/web.png" alt="Webprojekt">
        <h3>ZCutzBarber</h3>
        <p>Zcutzbarber.com – Fodrász weboldal időpontfoglalással és galériával.</p>
        <a href="https://zcutzbarber.com" target="_blank">Weboldal megtekintése</a>
      </div>
      <div class="project">
        <img src="icons/gear.png" alt="IT projekt">
        <h3>Hardveres megoldások</h3>
        <p>Számtalan sikeres hardveres fejlesztés és javítás (pl. gépépítés, diagnosztika, tuning).</p>
      </div>
      <div class="project">
        <img src="icons/tech.png" alt="IT projekt">
        <h3>Informatikai támogatás</h3>
        <p>Komplex rendszerek telepítése, konfigurálása és karbantartása magán- és céges ügyfeleknek.</p>
      </div>
    </div>
  </section>

  <script>
    // Matrix háttér animáció
    const canvas = document.getElementById("matrix");
    const ctx = canvas.getContext("2d");

    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;

    const letters = "01";
    const fontSize = 14;
    const columns = canvas.width / fontSize;
    const drops = [];

    for (let x = 0; x < columns; x++) drops[x] = 1;

    function draw() {
      ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      ctx.fillStyle = "#0F0";
      ctx.font = fontSize + "px monospace";
      for (let i = 0; i < drops.length; i++) {
        const text = letters.charAt(Math.floor(Math.random() * letters.length));
        ctx.fillText(text, i * fontSize, drops[i] * fontSize);
        if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
          drops[i] = 0;
        }
        drops[i]++;
      }
    }
    setInterval(draw, 33);
  </script>

</body>
</html>