const dateValue = date => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;

export function mountStayPlanner() {
  const form = document.querySelector('.stay-planner');
  if (!form) return () => {};
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const checkin = form.elements.checkin;
  const checkout = form.elements.checkout;
  const today = dateValue(new Date());
  checkin.min = today;
  checkout.min = today;
  const updateMinimum = () => {
    const start = new Date(`${checkin.value || today}T12:00:00`);
    start.setDate(start.getDate() + 1);
    checkout.min = dateValue(start);
    checkout.setCustomValidity(checkout.value && checkout.value <= checkin.value ? 'Choose a check-out date after your check-in date.' : '');
  };
  checkin.addEventListener('change', updateMinimum, options);
  checkout.addEventListener('change', updateMinimum, options);
  form.addEventListener('submit', event => {
    event.preventDefault();
    updateMinimum();
    if (!form.reportValidity()) return;
    const format = value => new Date(`${value}T12:00:00`).toLocaleDateString('en-GB', { day:'numeric', month:'long', year:'numeric' });
    const message = `I’d like to book a furnished stay.\nCheck-in: ${format(checkin.value)}\nCheck-out: ${format(checkout.value)}\nGuests: ${form.elements.guests.value}\n\nPlease share suitable apartments, their amenities, rates and availability.`;
    const number = (document.body.dataset.whatsappNumber || '').replace(/[\s+()-]/g,'');
    if (/^[1-9]\d{7,14}$/.test(number)) {
      window.open(`https://wa.me/${number}?text=${encodeURIComponent(`Hello GREI,\n\n${message}`)}`, '_blank', 'noopener,noreferrer');
    } else {
      document.dispatchEvent(new CustomEvent('grei:enquire', { detail: { service:'stay', message, trigger:form.querySelector('button[type="submit"]') } }));
    }
  }, options);
  updateMinimum();
  return () => abort.abort();
}
