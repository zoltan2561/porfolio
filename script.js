if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isMobile = window.innerWidth <= 600;

const canvas = document.getElementById('matrix');
if (canvas && !prefersReducedMotion && !isMobile) {
  const ctx = canvas.getContext('2d');
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;

  const letters = '01';
  const fontSize = 14;
  const columns = canvas.width / fontSize;
  const drops = [];

  for (let x = 0; x < columns; x++) drops[x] = 1;

  function draw() {
    ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#0F0';
    ctx.font = fontSize + 'px monospace';

    for (let i = 0; i < drops.length; i++) {
      const text = letters.charAt(Math.floor(Math.random() * letters.length));
      ctx.fillText(text, i * fontSize, drops[i] * fontSize);
      if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
        drops[i] = 0;
      }
      drops[i]++;
    }
  }

  setInterval(draw, 45);
} else if (canvas) {
  canvas.style.display = 'none';
}

function toggleMenu() {
  const nav = document.getElementById('main-nav');
  nav.classList.toggle('active');
}

window.toggleMenu = toggleMenu;

document.querySelectorAll('#main-nav a').forEach((link) => {
  link.addEventListener('click', () => {
    document.getElementById('main-nav').classList.remove('active');
  });
});

window.addEventListener('scroll', () => {
  if (window.innerWidth <= 600) {
    document.getElementById('main-nav').classList.remove('active');
  }
});

document.addEventListener('click', (event) => {
  const nav = document.getElementById('main-nav');
  const hamburger = document.querySelector('.hamburger');
  if (nav && hamburger && !nav.contains(event.target) && !hamburger.contains(event.target)) {
    nav.classList.remove('active');
  }
});

const faders = document.querySelectorAll('.fade-in');

function checkFadeIn() {
  const triggerBottom = window.innerHeight * 0.9;
  faders.forEach((el) => {
    const top = el.getBoundingClientRect().top;
    if (top < triggerBottom) {
      el.classList.add('visible');
    }
  });
}

window.addEventListener('scroll', checkFadeIn);
window.addEventListener('load', checkFadeIn);

setTimeout(() => {
  const success = document.querySelector('.form-success');
  const error = document.querySelector('.form-error');
  if (success) success.style.display = 'none';
  if (error) error.style.display = 'none';
}, 5000);

let lineIndex = 0;
let charIndex = 0;
const speed = 20;
const typewriterEl = document.getElementById('typewriter');

function typeLine() {
  if (!typewriterEl) return;
  if (lineIndex < typewriterLines.length) {
    const currentLine = typewriterLines[lineIndex];
    if (charIndex < currentLine.length) {
      typewriterEl.textContent += currentLine.charAt(charIndex);
      charIndex++;
      setTimeout(typeLine, speed);
    } else {
      typewriterEl.textContent += '\n';
      lineIndex++;
      charIndex = 0;
      setTimeout(typeLine, 350);
    }
  }
}

let preloadIndex = 0;
let preloadChar = 0;
const preloaderEl = document.getElementById('preloader-text');
const preloaderWrap = document.getElementById('preloader');

function startTypewriterOnly() {
  if (preloaderWrap) preloaderWrap.style.display = 'none';
  typeLine();
}

function typePreloader() {
  if (!preloaderEl || !preloaderWrap) {
    typeLine();
    return;
  }

  if (preloadIndex < preloaderLines.length) {
    const line = preloaderLines[preloadIndex];
    if (preloadChar < line.length) {
      preloaderEl.textContent += line.charAt(preloadChar);
      preloadChar++;
      setTimeout(typePreloader, 40);
    } else {
      preloaderEl.textContent += '\n';
      preloadIndex++;
      preloadChar = 0;
      setTimeout(typePreloader, 250);
    }
  } else {
    setTimeout(() => {
      preloaderWrap.style.display = 'none';
      window.scrollTo(0, 0);
      typeLine();
    }, 700);
  }
}

function hasSeenPreloader() {
  try {
    return localStorage.getItem('pz_preloader_seen') === '1';
  } catch (error) {
    return false;
  }
}

function markPreloaderSeen() {
  try {
    localStorage.setItem('pz_preloader_seen', '1');
  } catch (error) {
    // no-op (private mode / blocked storage)
  }
}

window.addEventListener('load', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const shouldSkipPreloader =
    urlParams.has('success') ||
    urlParams.has('error') ||
    prefersReducedMotion ||
    hasSeenPreloader();

  if (shouldSkipPreloader) {
    startTypewriterOnly();
  } else {
    markPreloaderSeen();
    typePreloader();
  }
});
