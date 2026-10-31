export function mountEnquiry() {
  const dialog = document.querySelector('#enquiry-dialog');
  if (!dialog) return () => {};
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const form = dialog.querySelector('#enquiry-form');
  const result = dialog.querySelector('#enquiry-result');
  const preview = dialog.querySelector('#enquiry-preview');
  const status = dialog.querySelector('.enquiry-status');
  const service = form.elements.service;
  const rawNumber = document.body.dataset.whatsappNumber || '';
  const number = rawNumber.replace(/[\s+()-]/g, '');
  const hasWhatsApp = /^[1-9]\d{7,14}$/.test(number);
  let lastTrigger = null;
  let message = '';

  if (hasWhatsApp) {
    form.querySelector('[data-submit-label]').textContent = 'Continue on WhatsApp';
    form.querySelector('[data-enquiry-note]').textContent = 'Opens WhatsApp with your details. GREI will confirm availability and next steps.';
  }

  function openEnquiry(trigger, selectedService, draft) {
    lastTrigger = trigger;
    if (selectedService) service.value = selectedService;
    if (draft) form.elements.message.value = draft;
    form.hidden = false;
    result.hidden = true;
    status.textContent = '';
    document.querySelector('#mobile-navigation')?.setAttribute('hidden', '');
    document.querySelector('.mobile-menu-toggle')?.setAttribute('aria-expanded', 'false');
    document.querySelector('.mobile-menu-toggle')?.setAttribute('aria-label', 'Open navigation');
    dialog.showModal();
    document.dispatchEvent(new CustomEvent('grei:dialog', { detail: { open: true } }));
    form.elements.name.focus({ preventScroll: true });
  }

  document.addEventListener('click', event => {
    const trigger = event.target.closest('[data-enquiry]');
    if (trigger) openEnquiry(trigger, trigger.dataset.enquiry);
  }, options);
  document.addEventListener('grei:enquire', event => {
    openEnquiry(event.detail.trigger, event.detail.service, event.detail.message);
  }, options);

  dialog.querySelector('.dialog-close').addEventListener('click', () => dialog.close(), options);
  dialog.addEventListener('click', event => {
    if (event.target !== dialog) return;
    const rect = dialog.getBoundingClientRect();
    if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) dialog.close();
  }, options);
  dialog.addEventListener('close', () => {
    document.dispatchEvent(new CustomEvent('grei:dialog', { detail: { open: false } }));
    const returnTarget = lastTrigger?.getClientRects().length ? lastTrigger : document.querySelector('.mobile-menu-toggle');
    returnTarget?.focus({ preventScroll: true });
  }, options);

  form.addEventListener('submit', event => {
    event.preventDefault();
    if (!form.reportValidity()) return;
    const labels = { property: 'finding a property', stay: 'booking a stay', design: 'designing a space' };
    message = `Hello GREI, my name is ${form.elements.name.value.trim()}.\n\nI’m interested in ${labels[service.value]}.\n\n${form.elements.message.value.trim()}`;
    if (hasWhatsApp) {
      window.open(`https://wa.me/${number}?text=${encodeURIComponent(message)}`, '_blank', 'noopener,noreferrer');
      status.textContent = 'Your enquiry is ready in WhatsApp. GREI will confirm availability and next steps.';
    } else {
      form.hidden = true;
      result.hidden = false;
      preview.textContent = message;
      dialog.querySelector('#copy-enquiry').focus();
    }
  }, options);

  dialog.querySelector('#copy-enquiry').addEventListener('click', async () => {
    try {
      await navigator.clipboard.writeText(message);
      status.textContent = 'Enquiry copied. You can now share it with GREI.';
    } catch {
      status.textContent = 'Select the enquiry text above and copy it to share with GREI.';
      const selection = window.getSelection();
      const range = document.createRange();
      range.selectNodeContents(preview);
      selection.removeAllRanges();
      selection.addRange(range);
    }
  }, options);

  dialog.querySelector('.edit-enquiry').addEventListener('click', () => {
    form.hidden = false;
    result.hidden = true;
    status.textContent = '';
    form.elements.message.focus();
  }, options);

  return () => { if (dialog.open) dialog.close(); abort.abort(); };
}
