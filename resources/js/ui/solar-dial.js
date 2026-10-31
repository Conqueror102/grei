const PHASES = {
  dawn: {
    cx: 140,
    cy: 280,
    kelvin: '3400 K',
    altitude: '14° E',
    acoustic: 'Dawn Stillness · 18 dB',
    poetry: '"Pale silver light filters through high clerestory windows, quietly awakening raw stone and unbleached linen."',
    needleAngle: 45
  },
  zenith: {
    cx: 400,
    cy: 50,
    kelvin: '5500 K',
    altitude: '78° S',
    acoustic: 'Radiant Clarity · 32 dB',
    poetry: '"High vertical clarity. Razor-sharp geometric shadows cut across the limestone courtyard and water surface."',
    needleAngle: 0
  },
  golden: {
    cx: 640,
    cy: 180,
    kelvin: '2700 K',
    altitude: '18° SW',
    acoustic: 'Golden Stillness · 22 dB',
    poetry: '"Low-angled golden light floods across raw travertine edges, casting long dramatic amber shadows."',
    needleAngle: 225
  },
  twilight: {
    cx: 730,
    cy: 340,
    kelvin: '2100 K',
    altitude: '-6° Horizon',
    acoustic: 'Deep Sanctuary · 14 dB',
    poetry: '"Warm candlelight and aged brass sconces illuminate intimate corners. The city dissolves into restorative quiet."',
    needleAngle: 180
  }
};

export function mountSolarDial() {
  const stage = document.getElementById('solar-stage');
  const sunOrb = document.getElementById('solar-sun-orb');
  const sunPulse = document.getElementById('solar-sun-pulse');
  const kelvinEl = document.getElementById('telemetry-kelvin');
  const altEl = document.getElementById('telemetry-altitude');
  const acousticEl = document.getElementById('telemetry-acoustic');
  const poetryEl = document.getElementById('telemetry-poetry');
  const buttons = document.querySelectorAll('.solar-time-btn');
  const needle = document.querySelector('.solar-meridian-badge .meridian-needle');

  if (!stage || !buttons.length) return () => {};

  const setPhase = (phaseKey) => {
    const data = PHASES[phaseKey] || PHASES.golden;

    stage.dataset.solarPhase = phaseKey;

    if (sunOrb) {
      sunOrb.setAttribute('cx', String(data.cx));
      sunOrb.setAttribute('cy', String(data.cy));
    }
    if (sunPulse) {
      sunPulse.setAttribute('cx', String(data.cx));
      sunPulse.setAttribute('cy', String(data.cy));
    }

    if (kelvinEl) kelvinEl.textContent = data.kelvin;
    if (altEl) altEl.textContent = data.altitude;
    if (acousticEl) acousticEl.textContent = data.acoustic;
    if (poetryEl) poetryEl.textContent = data.poetry;

    if (needle) {
      needle.style.transform = `rotate(${data.needleAngle}deg)`;
    }

    buttons.forEach(btn => {
      const active = btn.dataset.phase === phaseKey;
      btn.classList.toggle('is-active', active);
      btn.setAttribute('aria-pressed', active ? 'true' : 'false');
    });
  };

  const handlers = [];
  buttons.forEach(btn => {
    const clickHandler = () => setPhase(btn.dataset.phase);
    btn.addEventListener('click', clickHandler);
    handlers.push(() => btn.removeEventListener('click', clickHandler));
  });

  // Mousemove subtle parallax on the sculpture when inside the stage
  const onMouseMove = (e) => {
    const rect = stage.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width - 0.5;
    const y = (e.clientY - rect.top) / rect.height - 0.5;
    const sculpture = document.getElementById('solar-sculpture');
    if (sculpture) {
      sculpture.style.transform = `translate(${x * 16}px, ${y * 12}px) rotate(${x * 2}deg)`;
    }
  };

  stage.addEventListener('mousemove', onMouseMove);
  handlers.push(() => stage.removeEventListener('mousemove', onMouseMove));

  // Initialize with golden hour
  setPhase('golden');

  return () => handlers.forEach(h => h());
}
