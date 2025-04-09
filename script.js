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


    function toggleMenu() {
      const nav = document.getElementById('main-nav');
      nav.classList.toggle('active');
    }
    
    // Menü bezárás linkre kattintás után
    document.querySelectorAll('#main-nav a').forEach(link => {
      link.addEventListener('click', () => {
        document.getElementById('main-nav').classList.remove('active');
      });
    });
    
    // Menü bezárása görgetéskor mobilon
    window.addEventListener('scroll', () => {
      if (window.innerWidth <= 600) {
        document.getElementById('main-nav').classList.remove('active');
      }
    });
    

document.addEventListener('click', (event) => {
  const nav = document.getElementById('main-nav');
  const hamburger = document.querySelector('.hamburger');
  if (!nav.contains(event.target) && !hamburger.contains(event.target)) {
    nav.classList.remove('active');
  }
});
  
// Scroll animációk
const faders = document.querySelectorAll('.fade-in');

function checkFadeIn() {
  const triggerBottom = window.innerHeight * 0.85;
  faders.forEach(el => {
    const top = el.getBoundingClientRect().top;
    if (top < triggerBottom) {
      el.classList.add('visible');
    }
  });
}
window.addEventListener('scroll', checkFadeIn);
window.addEventListener('load', checkFadeIn);




// Üzenet automatikus eltüntetése
setTimeout(() => {
  const success = document.querySelector('.form-success');
  const error = document.querySelector('.form-error');
  if (success) success.style.display = 'none';
  if (error) error.style.display = 'none';
}, 5000); // 5 másodperc
