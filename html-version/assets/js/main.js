// Godai — JS de interface (header scroll + nav mobile + accordion)
(function () {
  const header = document.getElementById('siteHeader');
  if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 12);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  const toggle = document.getElementById('navToggle');
  const mobile = document.getElementById('navMobile');
  if (toggle && mobile) {
    toggle.addEventListener('click', () => {
      const open = mobile.hasAttribute('hidden');
      if (open) {
        mobile.removeAttribute('hidden');
        toggle.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
      } else {
        mobile.setAttribute('hidden', '');
        toggle.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // FAQ accordion
  document.querySelectorAll('.accordion-q').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.accordion-item');
      if (!item) return;
      const isOpen = item.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  });
})();
