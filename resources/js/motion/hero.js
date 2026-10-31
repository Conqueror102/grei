import gsap from 'gsap';

export function mountHeroMotion({ desktop }) {
  const scope = gsap.context(() => {
    const intro = gsap.timeline({ defaults: { ease: 'power3.out' } });
    intro.from('.site-header', { opacity: 0, y: -8, duration: .8 })
      .from('.title-line', { yPercent: 115, rotation: 2, duration: 1.15, stagger: .1 }, .12)
      .from('.hero-photo', { scale: 1.09, duration: 1.8 }, 0)
      .from(['.hero-description', '.hero-actions'], { opacity: 0, y: 12, duration: .85, stagger: .12 }, .65)
      .from('.metal-portal', { opacity: 0, rotationY: -18, y: 12, duration: 1.1 }, .7);

    if (desktop) {
      gsap.to('.hero-media', {
        '--frame-inset': '0%', ease: 'none',
        scrollTrigger: { trigger: '.hero', start: 'top -20%', end: 'bottom top', scrub: .7 },
      });
      gsap.to('.hero-photo', {
        scale: 1.025, ease: 'none',
        scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: .8 },
      });
      gsap.to('.hero-title', {
        y: -32, ease: 'none',
        scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: .8 },
      });
    }

  });
  return () => scope.revert();
}
