// Mobile menu toggle
const toggle = document.querySelector('.nav-toggle');
const menu = document.getElementById('menu');
if (toggle && menu) {
  toggle.addEventListener('click', () => {
    const open = menu.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
  });
}

// Show/hide password toggle (adds an eye button to every password field)
const EYE = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>';
const EYE_OFF = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18"/><path d="M10.6 5.1A10 10 0 0 1 12 5c6.5 0 10 7 10 7a17 17 0 0 1-3.2 4.2M6.6 6.6A17 17 0 0 0 2 12s3.5 7 10 7a10 10 0 0 0 4.4-1"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>';
document.querySelectorAll('input[type="password"]').forEach(input => {
  const wrap = document.createElement('div');
  wrap.className = 'pw';
  input.parentNode.insertBefore(wrap, input);
  wrap.appendChild(input);
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'pw-toggle';
  btn.setAttribute('aria-label', 'Show password');
  btn.innerHTML = EYE;
  btn.addEventListener('click', () => {
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.innerHTML = show ? EYE_OFF : EYE;
    btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
  });
  wrap.appendChild(btn);
});

// Close the mobile menu after tapping a link
if (menu) menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  menu.classList.remove('open');
  if (toggle) toggle.setAttribute('aria-expanded', 'false');
}));

// Highlight the nav link of the section currently on screen
const spyLinks = [...document.querySelectorAll('.menu a[href*="#"]')];
if (spyLinks.length && document.getElementById('home')) {
  const byId = new Map(spyLinks.map(a => [a.getAttribute('href').split('#')[1], a]));
  const io = new IntersectionObserver(entries => entries.forEach(en => {
    if (!en.isIntersecting) return;
    spyLinks.forEach(a => { a.classList.remove('active'); a.removeAttribute('aria-current'); });
    const link = byId.get(en.target.id);
    if (link) { link.classList.add('active'); link.setAttribute('aria-current', 'true'); }
  }), { rootMargin: '-45% 0px -50% 0px' });
  byId.forEach((_, id) => { const s = document.getElementById(id); if (s) io.observe(s); });
}

// Light / dark theme toggle (choice is remembered in the browser)
const themeBtn = document.querySelector('.theme-toggle');
function syncThemeLabel() {
  if (!themeBtn) return;
  const light = document.documentElement.dataset.theme === 'light';
  themeBtn.setAttribute('aria-label', light ? 'Switch to dark theme' : 'Switch to light theme');
}
if (themeBtn) {
  syncThemeLabel();
  themeBtn.addEventListener('click', () => {
    const next = document.documentElement.dataset.theme === 'light' ? 'dark' : 'light';
    document.documentElement.dataset.theme = next;
    try { localStorage.setItem('theme', next); } catch (e) {}
    syncThemeLabel();
  });
}

// Hide the bottom fade when an About box is scrolled to the end
document.querySelectorAll('.scroll-box').forEach(box => {
  const wrap = box.parentElement;
  const check = () => wrap.classList.toggle('end', box.scrollTop + box.clientHeight >= box.scrollHeight - 4);
  box.addEventListener('scroll', check, { passive: true });
  check();
});

// Project modal
const pm = document.getElementById('project-modal');
if (pm) {
  const $ = id => document.getElementById(id);
  document.querySelectorAll('.thumb').forEach(btn => btn.addEventListener('click', () => {
    $('pm-img').src = btn.dataset.img;
    $('pm-img').alt = btn.dataset.title + ' screenshot';
    $('pm-title').textContent = btn.dataset.title;
    $('pm-desc').textContent = btn.dataset.desc;
    pm.showModal();
  }));
  pm.querySelector('.pm-close').addEventListener('click', () => pm.close());
  pm.addEventListener('click', e => { if (e.target === pm) pm.close(); });
}

// ---- Animations ----
const calm = matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!calm) {
  // Scroll reveal, with a small stagger between neighbouring cards
  const targets = document.querySelectorAll('section h2, section .lead, .subhead, .card, .scroll-wrap');
  const ro = new IntersectionObserver(entries => entries.forEach(en => {
    if (en.isIntersecting) { en.target.classList.add('in'); ro.unobserve(en.target); }
  }), { threshold: .12 });
  targets.forEach(el => {
    if (el.closest('#home, dialog')) return;
    el.classList.add('reveal');
    el.style.transitionDelay = ([...el.parentElement.children].indexOf(el) % 3) * 90 + 'ms';
    ro.observe(el);
  });

  // Mouse parallax in the hero
  const hero = document.querySelector('.hero');
  if (hero && matchMedia('(hover: hover)').matches) {
    hero.addEventListener('mousemove', e => {
      const r = hero.getBoundingClientRect();
      hero.style.setProperty('--mx', ((e.clientX - r.left) / r.width - .5) * 2);
      hero.style.setProperty('--my', ((e.clientY - r.top) / r.height - .5) * 2);
    });
    hero.addEventListener('mouseleave', () => {
      hero.style.setProperty('--mx', 0);
      hero.style.setProperty('--my', 0);
    });
  }

  // Scroll progress bar
  const bar = document.createElement('div');
  bar.className = 'progress';
  bar.setAttribute('aria-hidden', 'true');
  document.body.prepend(bar);
  const setBar = () => {
    const max = document.documentElement.scrollHeight - innerHeight;
    bar.style.transform = 'scaleX(' + (max > 0 ? scrollY / max : 0) + ')';
  };
  addEventListener('scroll', setBar, { passive: true });
  setBar();
}