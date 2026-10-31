import { spaces } from '../data/spaces.js';

export function mountSpaces() {
  const dialog = document.querySelector('#space-dialog');
  if (!dialog) return () => {};
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const image = dialog.querySelector('.space-main-image');
  const thumbnails = dialog.querySelector('.space-thumbnails');
  let trigger;
  let current;

  const showImage = index => {
    image.src = current.images[index].src;
    image.alt = current.images[index].alt;
    thumbnails.querySelectorAll('button').forEach((button, i) => button.setAttribute('aria-pressed', String(index === i)));
  };

  document.addEventListener('click', event => {
    const button = event.target.closest('[data-open-space]');
    if (!button || !spaces[button.dataset.openSpace]) return;
    trigger = button;
    current = spaces[button.dataset.openSpace];
    dialog.querySelector('#space-title').textContent = current.title;
    dialog.querySelector('.space-category').textContent = current.category;
    dialog.querySelector('.space-description').textContent = current.description;
    dialog.querySelector('.space-feature-title').textContent = current.featureTitle || 'The point of view';
    dialog.querySelector('.space-features').replaceChildren(...current.features.map(text => {
      const item = document.createElement('li'); item.textContent = text; return item;
    }));
    thumbnails.replaceChildren(...current.images.map((item, index) => {
      const thumb = document.createElement('button');
      thumb.className = 'space-thumbnail'; thumb.type = 'button';
      thumb.dataset.galleryIndex = index;
      thumb.setAttribute('aria-label', `View ${index + 1}: ${item.alt}`);
      const img = document.createElement('img'); img.src = item.src; img.alt = '';
      thumb.append(img);
      return thumb;
    }));
    thumbnails.hidden = current.images.length < 2;
    showImage(0);
    dialog.showModal();
    dialog.scrollTop = 0;
    dialog.querySelector('.space-close').focus({ preventScroll: true });
    document.dispatchEvent(new CustomEvent('grei:dialog', { detail: { open: true } }));
  }, options);

  thumbnails.addEventListener('click', event => {
    const thumb = event.target.closest('[data-gallery-index]');
    if (thumb) showImage(Number(thumb.dataset.galleryIndex));
  }, options);

  dialog.querySelector('.space-close').addEventListener('click', () => dialog.close(), options);
  dialog.addEventListener('click', event => {
    if (event.target !== dialog) return;
    const rect = dialog.getBoundingClientRect();
    if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) dialog.close();
  }, options);
  dialog.addEventListener('close', () => {
    document.dispatchEvent(new CustomEvent('grei:dialog', { detail: { open: false } }));
    if (!document.querySelector('dialog[open]')) trigger?.focus({ preventScroll: true });
  }, options);
  dialog.querySelector('.space-enquire').addEventListener('click', () => {
    dialog.close();
    document.dispatchEvent(new CustomEvent('grei:enquire', { detail: { service: current.service, message: current.message, trigger } }));
  }, options);
  return () => { if (dialog.open) dialog.close(); abort.abort(); };
}
