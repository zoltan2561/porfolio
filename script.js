if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isMobile = window.matchMedia('(max-width: 600px)').matches;
const currentLang = document.documentElement.lang === 'hu' ? 'hu' : 'en';

function setupMatrix() {
  const canvas = document.getElementById('matrix');
  if (!canvas || prefersReducedMotion) {
    if (canvas) {
      canvas.style.display = 'none';
    }
    return;
  }

  const ctx = canvas.getContext('2d');
  if (!ctx) {
    return;
  }

  const letters = '01';
  const fontSize = isMobile ? 18 : 14;
  let columns = 0;
  let drops = [];
  let animationFrameId = null;
  let lastFrameTime = 0;
  let lastScrollY = window.scrollY;
  let lastScrollTime = performance.now();
  let scrollBoost = 0;
  let targetScrollBoost = 0;

  function resizeCanvas() {
    const previousDrops = drops;
    const previousColumns = columns;

    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;
    columns = Math.max(1, Math.floor(canvas.width / fontSize));

    if (!previousDrops.length) {
      drops = new Array(columns).fill(1);
      return;
    }

    if (columns === previousColumns) {
      drops = previousDrops.slice(0, columns);
      return;
    }

    // Preserve existing rain positions when mobile browser chrome changes viewport size.
    drops = Array.from({ length: columns }, (_, index) => {
      const mappedIndex = Math.floor((index / Math.max(1, columns - 1)) * Math.max(0, previousColumns - 1));
      return previousDrops[mappedIndex] ?? 1;
    });
  }

  function getScrollDepth() {
    const maxScroll = Math.max(1, document.documentElement.scrollHeight - window.innerHeight);
    return window.scrollY / maxScroll;
  }

  function draw() {
    const scrollDepth = getScrollDepth();
    const trailAlpha = isMobile ? 0.09 : 0.055;
    const dynamicTrail = Math.min(0.03, scrollBoost * 0.007 + scrollDepth * 0.012);

    ctx.fillStyle = `rgba(0, 0, 0, ${trailAlpha + dynamicTrail})`;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = scrollDepth > 0.5 ? '#66ffe0' : '#0F0';
    ctx.font = `${fontSize}px monospace`;

    const speedMultiplier = 1 + scrollBoost * 0.55 + scrollDepth * 0.25;

    for (let index = 0; index < drops.length; index += 1) {
      const text = letters.charAt(Math.floor(Math.random() * letters.length));
      ctx.fillText(text, index * fontSize, drops[index] * fontSize);

      if (drops[index] * fontSize > canvas.height && Math.random() > 0.975 - Math.min(0.04, scrollBoost * 0.02)) {
        drops[index] = 0;
      }

      drops[index] += speedMultiplier;
    }
  }

  function animate(timestamp) {
    if (document.hidden) {
      animationFrameId = null;
      return;
    }

    if (!lastFrameTime) {
      lastFrameTime = timestamp;
    }

    scrollBoost += (targetScrollBoost - scrollBoost) * 0.08;
    targetScrollBoost *= 0.94;

    const frameDelay = (isMobile ? 58 : 42) / (1 + scrollBoost * 0.3);
    if (timestamp - lastFrameTime >= frameDelay) {
      draw();
      lastFrameTime = timestamp;
    }

    animationFrameId = window.requestAnimationFrame(animate);
  }

  function startMatrix() {
    if (animationFrameId) {
      return;
    }

    animationFrameId = window.requestAnimationFrame(animate);
  }

  function stopMatrix() {
    if (!animationFrameId) {
      return;
    }

    window.cancelAnimationFrame(animationFrameId);
    animationFrameId = null;
    lastFrameTime = 0;
  }

  window.addEventListener('scroll', () => {
    const now = performance.now();
    const deltaY = Math.abs(window.scrollY - lastScrollY);
    const deltaTime = Math.max(16, now - lastScrollTime);
    const velocity = deltaY / deltaTime;

    targetScrollBoost = Math.min(3.2, velocity * 2.2 + 0.15);
    lastScrollY = window.scrollY;
    lastScrollTime = now;
  }, { passive: true });

  resizeCanvas();
  startMatrix();

  window.addEventListener('resize', resizeCanvas);
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      stopMatrix();
    } else {
      startMatrix();
    }
  });
}

function setupMenu() {
  const nav = document.getElementById('main-nav');
  const hamburger = document.querySelector('.hamburger');

  if (!nav || !hamburger) {
    return;
  }

  function toggleMenu() {
    nav.classList.toggle('active');
  }

  function closeMenu() {
    nav.classList.remove('active');
  }

  window.toggleMenu = toggleMenu;

  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeMenu);
  });

  window.addEventListener('scroll', () => {
    if (window.innerWidth <= 600) {
      closeMenu();
    }
  });

  document.addEventListener('click', (event) => {
    if (!nav.contains(event.target) && !hamburger.contains(event.target)) {
      closeMenu();
    }
  });
}

function setupFadeIns() {
  const faders = document.querySelectorAll('.fade-in');
  if (!faders.length) {
    return;
  }

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries, activeObserver) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          entry.target.classList.add('visible');
          activeObserver.unobserve(entry.target);
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
    );

    faders.forEach((element) => observer.observe(element));
    return;
  }

  const revealOnScroll = () => {
    const triggerBottom = window.innerHeight * 0.9;

    faders.forEach((element) => {
      const top = element.getBoundingClientRect().top;
      if (top < triggerBottom) {
        element.classList.add('visible');
      }
    });
  };

  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll, { once: true });
  revealOnScroll();
}

function setupFlashMessages() {
  const success = document.querySelector('.form-success');
  const error = document.querySelector('.form-error');

  if (!success && !error) {
    return;
  }

  window.setTimeout(() => {
    if (success) {
      success.style.display = 'none';
    }

    if (error) {
      error.style.display = 'none';
    }
  }, 5000);
}

function setupTypewriter() {
  const typewriterEl = document.getElementById('typewriter');
  const preloaderEl = document.getElementById('preloader-text');
  const preloaderWrap = document.getElementById('preloader');

  const typedLines = typeof typewriterLines !== 'undefined' && Array.isArray(typewriterLines) ? typewriterLines : [];
  const preloadLines = typeof preloaderLines !== 'undefined' && Array.isArray(preloaderLines) ? preloaderLines : [];

  let lineIndex = 0;
  let charIndex = 0;
  let preloadIndex = 0;
  let preloadChar = 0;
  let typewriterStarted = false;

  function typeLine() {
    if (!typewriterEl || lineIndex >= typedLines.length) {
      return;
    }

    const currentLine = typedLines[lineIndex];

    if (charIndex < currentLine.length) {
      typewriterEl.textContent += currentLine.charAt(charIndex);
      charIndex += 1;
      window.setTimeout(typeLine, 20);
      return;
    }

    typewriterEl.textContent += '\n';
    lineIndex += 1;
    charIndex = 0;
    window.setTimeout(typeLine, 350);
  }

  function startTypewriter() {
    if (typewriterStarted) {
      return;
    }

    typewriterStarted = true;

    if (preloaderWrap) {
      preloaderWrap.style.display = 'none';
    }

    if (typewriterEl) {
      typewriterEl.textContent = '';
    }

    typeLine();
  }

  function typePreloader() {
    if (!preloaderEl || !preloaderWrap || !preloadLines.length) {
      startTypewriter();
      return;
    }

    if (preloadIndex < preloadLines.length) {
      const line = preloadLines[preloadIndex];

      if (preloadChar < line.length) {
        preloaderEl.textContent += line.charAt(preloadChar);
        preloadChar += 1;
        window.setTimeout(typePreloader, 40);
        return;
      }

      preloaderEl.textContent += '\n';
      preloadIndex += 1;
      preloadChar = 0;
      window.setTimeout(typePreloader, 250);
      return;
    }

    window.setTimeout(() => {
      if (preloaderWrap) {
        preloaderWrap.style.display = 'none';
      }
      window.scrollTo(0, 0);
      startTypewriter();
    }, 700);
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
      // ignore storage issues
    }
  }

  window.addEventListener(
    'load',
    () => {
      const urlParams = new URLSearchParams(window.location.search);
      const shouldSkipPreloader =
        urlParams.has('success') ||
        urlParams.has('error') ||
        prefersReducedMotion ||
        hasSeenPreloader();

      if (shouldSkipPreloader) {
        startTypewriter();
        return;
      }

      markPreloaderSeen();
      typePreloader();
    },
    { once: true }
  );
}

function setupHeroVideo() {
  const introVideo = document.getElementById('intro-video');
  const status = document.getElementById('video-status');
  const wrapper = introVideo ? introVideo.closest('.hero-video-placeholder') : null;

  if (!introVideo || !status || !wrapper) {
    return;
  }

  let autoplayAttempted = false;

  function setStatus(message, kind = 'info') {
    status.textContent = message;
    status.dataset.state = kind;
  }

  async function tryAutoplay() {
    if (autoplayAttempted || prefersReducedMotion || isMobile) {
      return;
    }

    autoplayAttempted = true;

    try {
      introVideo.muted = true;
      await introVideo.play();
      wrapper.classList.add('is-playing');
      setStatus(
        currentLang === 'hu'
          ? 'A videó némítva elindult. Hangot a lejátszóban tudsz adni.'
          : 'The video started muted. You can enable sound in the player.',
        'success'
      );
    } catch (error) {
      setStatus(
        currentLang === 'hu'
          ? 'A videó készen áll, indíthatod kézzel is.'
          : 'The video is ready, you can start it manually.',
        'info'
      );
    }
  }

  introVideo.setAttribute('playsinline', '');
  introVideo.setAttribute('muted', '');

  introVideo.addEventListener('loadeddata', () => {
    wrapper.classList.add('is-ready');
    setStatus(
      currentLang === 'hu'
        ? 'A videó betöltve, indítható.'
        : 'Video loaded and ready to play.',
      'success'
    );
  });

  introVideo.addEventListener('play', () => {
    wrapper.classList.add('is-playing');
  });

  introVideo.addEventListener('pause', () => {
    wrapper.classList.remove('is-playing');
  });

  introVideo.addEventListener('error', () => {
    wrapper.classList.add('is-error');
    setStatus(
      currentLang === 'hu'
        ? 'A videó most nem tölthető be. Ellenőrizd a promo.mp4 fájlt.'
        : 'The video could not be loaded right now. Please check the promo.mp4 file.',
      'error'
    );
  });

  if ('IntersectionObserver' in window) {
    const videoObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          tryAutoplay();
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.45 }
    );

    videoObserver.observe(introVideo);
  } else {
    tryAutoplay();
  }
}

setupMatrix();
setupMenu();
setupFadeIns();
setupFlashMessages();
setupTypewriter();
setupHeroVideo();
