const ARCHETYPES = {
  monolith: {
    code: 'GREI-MONO-48',
    title: 'The Raw Monolith',
    materials: 'Honed Roman Travertine, Brushed Patina Brass, Muted Plaster',
    summary: '"A monolithic architectural composition centered on natural stone mass, raw brass orbit reflections, and acoustic quiet."',
    backdrop: 'radial-gradient(circle at 65% 35%, rgba(255,255,255,0.85) 0%, rgba(229,221,208,0.4) 100%)',
    monolithTransform: 'scale(1.06) translate(0, 0)',
    artifactsTransform: 'scale(0.92) translate(15px, 10px)'
  },
  sanctuary: {
    code: 'GREI-SANCT-72',
    title: 'The Tactile Sanctuary',
    materials: 'Smoked French Oak, Smoky Amber Glass, Washed Belgian Linen',
    summary: '"An unhurried residential sanctuary composed with smoked French oak, warm amber glass refractions, and tactile unbleached linen."',
    backdrop: 'radial-gradient(circle at 50% 50%, rgba(247,235,214,0.9) 0%, rgba(219,198,168,0.4) 100%)',
    monolithTransform: 'scale(0.92) translate(-10px, -15px)',
    artifactsTransform: 'scale(1.08) translate(-15px, -10px)'
  },
  salon: {
    code: 'GREI-SALON-91',
    title: 'The Nightfall Salon',
    materials: 'Blackened Forged Bronze, Deep Oxblood Velvet, Matte Lime Plaster',
    summary: '"An intimate after-dark salon featuring hand-forged patinated bronze, deep oxblood velvet, and acoustic shadow calm."',
    backdrop: 'radial-gradient(circle at 60% 40%, rgba(37,40,36,0.85) 0%, rgba(22,28,24,0.95) 100%)',
    monolithTransform: 'scale(0.98) translate(-5px, 0) brightness(0.8)',
    artifactsTransform: 'scale(1.02) translate(0, -5px) contrast(1.1)'
  }
};

export function mountSpatialCurator() {
  const workbench = document.getElementById('curator-workbench');
  const stage = document.getElementById('curator-stage');
  const backdrop = document.getElementById('curator-backdrop');
  const monolithLayer = document.getElementById('curator-monolith-layer');
  const artifactsLayer = document.getElementById('curator-artifacts-layer');
  const codeEl = document.getElementById('curator-blueprint-code');
  const summaryEl = document.getElementById('curator-summary-text');
  const whatsappBtn = document.getElementById('curator-whatsapp-btn');
  const archetypeBtns = document.querySelectorAll('.archetype-btn');
  const scaleBtns = document.querySelectorAll('.scale-btn');
  const needle = document.querySelector('.curator-blueprint-stamp .meridian-needle');

  if (!workbench || !stage) return () => {};

  let currentArchetype = 'monolith';
  let currentScale = 'Private Residence';

  const updateHandoff = () => {
    const arch = ARCHETYPES[currentArchetype];
    const text = `Hello GREI, I have curated a spatial direction using your interactive studio:\n\n• Archetype: ${arch.title} (${arch.code})\n• Scope: ${currentScale}\n• Material Language: ${arch.materials}\n\nI would like to explore this spatial brief for my project.`;
    const rawNumber = document.body.dataset.whatsappNumber || '';
    const encoded = encodeURIComponent(text);
    if (whatsappBtn) {
      whatsappBtn.href = rawNumber ? `https://wa.me/${rawNumber}?text=${encoded}` : `https://wa.me/?text=${encoded}`;
    }
  };

  const setArchetype = (key) => {
    currentArchetype = key;
    const arch = ARCHETYPES[key] || ARCHETYPES.monolith;

    stage.dataset.archetype = key;
    if (backdrop) backdrop.style.background = arch.backdrop;
    if (codeEl) codeEl.textContent = arch.code;
    if (summaryEl) summaryEl.textContent = arch.summary;

    if (monolithLayer) monolithLayer.style.transform = arch.monolithTransform;
    if (artifactsLayer) artifactsLayer.style.transform = arch.artifactsTransform;

    if (needle) {
      const angles = { monolith: 35, sanctuary: 140, salon: 280 };
      needle.style.transform = `rotate(${angles[key] || 0}deg)`;
    }

    archetypeBtns.forEach(b => {
      const active = b.dataset.archetype === key;
      b.classList.toggle('is-active', active);
      b.setAttribute('aria-checked', active ? 'true' : 'false');
    });

    updateHandoff();
  };

  const handlers = [];

  archetypeBtns.forEach(btn => {
    const h = () => setArchetype(btn.dataset.archetype);
    btn.addEventListener('click', h);
    handlers.push(() => btn.removeEventListener('click', h));
  });

  scaleBtns.forEach(btn => {
    const h = () => {
      scaleBtns.forEach(b => b.classList.remove('is-selected'));
      btn.classList.add('is-selected');
      currentScale = btn.dataset.scale;
      updateHandoff();
    };
    btn.addEventListener('click', h);
    handlers.push(() => btn.removeEventListener('click', h));
  });

  // Parallax interaction on the curator stage
  const onMouseMove = (e) => {
    const rect = stage.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width - 0.5;
    const y = (e.clientY - rect.top) / rect.height - 0.5;

    if (monolithLayer) {
      monolithLayer.style.transform = `${ARCHETYPES[currentArchetype].monolithTransform} translate(${x * 24}px, ${y * 18}px)`;
    }
    if (artifactsLayer) {
      artifactsLayer.style.transform = `${ARCHETYPES[currentArchetype].artifactsTransform} translate(${x * -20}px, ${y * -14}px)`;
    }
  };

  stage.addEventListener('mousemove', onMouseMove);
  handlers.push(() => stage.removeEventListener('mousemove', onMouseMove));

  setArchetype('monolith');

  return () => handlers.forEach(h => h());
}
