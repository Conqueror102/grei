import { spaces } from '../data/spaces.js';

export function mountCollection() {
  const root = document.querySelector('.collection-section');
  if (!root) return () => {};
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const entries = [...root.querySelectorAll('[data-property]')];
  const filters = [...root.querySelectorAll('[data-property-filter]')];
  const photo = root.querySelector('.collection-photo');
  const explore = root.querySelector('.collection-image-button');
  let version = 0;
  let selection = 'courtyard';

  async function select(entry) {
    selection = entry.dataset.property;
    const space = spaces[selection];
    const ticket = ++version;
    entries.forEach(item => {
      item.classList.toggle('is-selected', item === entry);
      item.setAttribute('aria-pressed', String(item === entry));
    });
    explore.dataset.openSpace = selection;
    explore.setAttribute('aria-label', `Explore ${space.title}`);
    root.querySelector('.collection-kind').textContent = space.kind;
    const visible = entries.filter(item => !item.hidden);
    root.querySelector('.collection-current').textContent = `${String(visible.indexOf(entry) + 1).padStart(2, '0')} — ${String(visible.length).padStart(2, '0')}`;
    if (photo.getAttribute('src') === space.images[0].src) return;
    photo.classList.add('is-switching');
    const image = new Image();
    image.src = space.images[0].src;
    await image.decode().catch(() => {});
    if (ticket !== version || abort.signal.aborted) return;
    photo.src = image.src;
    photo.alt = space.images[0].alt;
    photo.classList.remove('is-switching');
  }

  entries.forEach(entry => entry.addEventListener('click', () => select(entry), options));
  filters.forEach(filter => filter.addEventListener('click', () => {
    filters.forEach(item => item.setAttribute('aria-pressed', String(item === filter)));
    const category = filter.dataset.propertyFilter;
    entries.forEach(entry => { entry.hidden = category !== 'all' && !entry.dataset.categories.split(' ').includes(category); });
    const visible = entries.filter(entry => !entry.hidden);
    root.querySelector('.collection-count').textContent = `${String(visible.length).padStart(2, '0')} ${visible.length === 1 ? 'possibility' : 'possibilities'}`;
    select(visible.find(entry => entry.dataset.property === selection) || visible[0]);
    document.dispatchEvent(new Event('grei:layout-change'));
  }, options));

  return () => { ++version; abort.abort(); };
}
