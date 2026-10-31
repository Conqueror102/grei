const STORAGE_KEY = 'grei_shortlist';

function getShortlist() {
  try {
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
  } catch {
    return [];
  }
}

function saveShortlist(items) {
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
  } catch {}
}

export function mountShortlist() {
  const pill = document.getElementById('shortlist-floating-pill');
  const badge = document.getElementById('shortlist-count-badge');
  const drawer = document.getElementById('shortlist-drawer');
  const closeBtn = document.getElementById('shortlist-close-btn');
  const clearBtn = document.getElementById('shortlist-clear-btn');
  const itemsContainer = document.getElementById('shortlist-items-container');
  const whatsappShare = document.getElementById('shortlist-share-whatsapp');

  const updateUI = () => {
    const list = getShortlist();
    const count = list.length;

    if (badge) badge.textContent = count;
    if (pill) pill.style.display = count > 0 ? 'flex' : 'none';

    // Update all save buttons on current page
    document.querySelectorAll('.listing-save-btn').forEach(btn => {
      const id = btn.dataset.spaceId;
      const isSaved = list.some(item => String(item.id) === String(id));
      btn.classList.toggle('is-saved', isSaved);
      btn.setAttribute('aria-pressed', isSaved ? 'true' : 'false');
      btn.title = isSaved ? 'Remove from shortlist' : 'Add to shortlist';
    });

    // Update WhatsApp link
    if (whatsappShare) {
      const rawNumber = document.body.dataset.whatsappNumber || '';
      const lines = list.map(i => `• ${i.title} (${i.location}) - ${i.price}`);
      const text = `Hello GREI, I am interested in these spaces from my shortlist:\n\n${lines.join('\n')}\n\nPlease share details and availability.`;
      const encoded = encodeURIComponent(text);
      if (rawNumber) {
        whatsappShare.href = `https://wa.me/${rawNumber}?text=${encoded}`;
      } else {
        whatsappShare.href = `https://wa.me/?text=${encoded}`;
      }
    }
  };

  const renderDrawer = () => {
    const list = getShortlist();
    if (!itemsContainer) return;

    if (list.length === 0) {
      itemsContainer.innerHTML = '<p class="detail-caption" style="grid-column: 1 / -1; padding: 20px 0;">Your shortlist is empty. Explore properties and stays to save your favorites.</p>';
      return;
    }

    itemsContainer.innerHTML = list.map(item => `
      <div class="shortlist-item-card" data-item-id="${item.id}">
        <img src="${item.cover}" alt="${item.title}" class="shortlist-item-thumb">
        <div class="shortlist-item-info">
          <h4><a href="${item.url}">${item.title}</a></h4>
          <span>${item.location} · ${item.price}</span>
        </div>
        <button type="button" class="shortlist-item-remove" data-remove-id="${item.id}" aria-label="Remove ${item.title}">
          <svg style="width:16px;height:16px;fill:currentColor;" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
        </button>
      </div>
    `).join('');

    itemsContainer.querySelectorAll('.shortlist-item-remove').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const removeId = btn.dataset.removeId;
        const current = getShortlist().filter(i => String(i.id) !== String(removeId));
        saveShortlist(current);
        updateUI();
        renderDrawer();
      });
    });
  };

  const onSaveClick = (e) => {
    const btn = e.target.closest('.listing-save-btn');
    if (!btn) return;
    e.preventDefault();
    e.stopPropagation();

    const data = {
      id: btn.dataset.spaceId,
      title: btn.dataset.spaceTitle,
      slug: btn.dataset.spaceSlug,
      kind: btn.dataset.spaceKind,
      price: btn.dataset.spacePrice,
      location: btn.dataset.spaceLocation,
      cover: btn.dataset.spaceCover,
      url: btn.dataset.spaceUrl,
    };

    let list = getShortlist();
    const exists = list.some(i => String(i.id) === String(data.id));

    if (exists) {
      list = list.filter(i => String(i.id) !== String(data.id));
    } else {
      list.push(data);
    }

    saveShortlist(list);
    updateUI();
    if (drawer && drawer.open) renderDrawer();
  };

  const openDrawer = () => {
    renderDrawer();
    drawer?.showModal();
  };

  const closeDrawer = () => {
    drawer?.close();
  };

  const clearList = () => {
    saveShortlist([]);
    updateUI();
    renderDrawer();
  };

  document.addEventListener('click', onSaveClick);
  pill?.addEventListener('click', openDrawer);
  closeBtn?.addEventListener('click', closeDrawer);
  clearBtn?.addEventListener('click', clearList);
  drawer?.addEventListener('click', (e) => {
    if (e.target === drawer) closeDrawer();
  });

  updateUI();

  return () => {
    document.removeEventListener('click', onSaveClick);
    pill?.removeEventListener('click', openDrawer);
    closeBtn?.removeEventListener('click', closeDrawer);
    clearBtn?.removeEventListener('click', clearList);
  };
}
