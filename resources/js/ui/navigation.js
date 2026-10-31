export function mountNavigation() {
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const toggle = document.querySelector('.mobile-menu-toggle');
  const menu = document.querySelector('#mobile-navigation');
  const closeMenu = () => {
    if (!menu) return;
    menu.hidden = true;
    toggle?.setAttribute('aria-expanded', 'false');
    toggle?.setAttribute('aria-label', 'Open navigation');
  };

  toggle?.addEventListener('click', () => {
    const open = menu.hidden;
    menu.hidden = !open;
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
  }, options);

  document.addEventListener('click', event => {
    if (!event.target.closest('.site-header')) closeMenu();
    const anchor = event.target.closest('a[href^="#"]');
    if (!anchor) return;
    const target = document.getElementById(anchor.hash.slice(1));
    if (!target) return;
    event.preventDefault();
    closeMenu();
    document.dispatchEvent(new CustomEvent('grei:scroll-to', { detail: { target } }));
    history.replaceState(null, '', anchor.hash);
  }, options);

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && menu && !menu.hidden) {
      closeMenu();
      toggle.focus();
    }
  }, options);

  document.querySelectorAll('.process-steps details').forEach(service => {
    service.addEventListener('toggle', () => {
      if (service.open) {
        document.querySelectorAll('.process-steps details').forEach(other => { if (other !== service) other.open = false; });
      }
      document.dispatchEvent(new Event('grei:layout-change'));
    }, options);
  });

  return () => abort.abort();
}
