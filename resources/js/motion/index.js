import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import { mountHeroMotion } from './hero.js';
import { mountMicroInteractions } from './micro-interactions.js';
import { mountChapterMotion } from './chapters.js';
import { mountPageMotion } from './pages.js';

gsap.registerPlugin(ScrollTrigger);

export function mountMotion() {
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const media = gsap.matchMedia();
  let lenis;
  let ticker;

  const stop = media.add({ desktop: '(min-width: 961px)', motion: '(prefers-reduced-motion: no-preference)' }, context => {
    const { desktop, motion } = context.conditions;
    if (!motion || document.querySelector('.admin-shell,.auth-page')) return;
    if (desktop) {
      lenis = new Lenis({ lerp: .1, smoothWheel: true, anchors: false });
      lenis.on('scroll', ScrollTrigger.update);
      ticker = time => lenis.raf(time * 1000);
      gsap.ticker.add(ticker);
    }
    const heroCleanup = document.querySelector('.hero-scene') ? mountHeroMotion({ desktop }) : () => {};
    const microCleanup = mountMicroInteractions({ desktop });
    const chapterCleanup = document.querySelector('.world-section') ? mountChapterMotion({ desktop }) : () => {};
    const pageCleanup = mountPageMotion();
    return () => {
      pageCleanup();
      chapterCleanup();
      heroCleanup();
      microCleanup();
      if (ticker) gsap.ticker.remove(ticker);
      lenis?.destroy();
      lenis = null;
      ticker = null;
    };
  });

  document.addEventListener('grei:scroll-to', event => {
    const target = event.detail.target;
    if (lenis) lenis.scrollTo(target, { offset: -28, duration: 1.15 });
    else target.scrollIntoView({ behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth', block: 'start' });
  }, options);
  document.addEventListener('grei:dialog', () => {
    if (document.querySelector('dialog[open]')) lenis?.stop();
    else lenis?.start();
  }, options);
  document.addEventListener('grei:layout-change', () => ScrollTrigger.refresh(), options);

  document.fonts.ready.then(() => { if (!abort.signal.aborted) ScrollTrigger.refresh(); });
  const images = [...document.images].map(image => image.decode?.().catch(() => {}));
  Promise.all(images).then(() => { if (!abort.signal.aborted) ScrollTrigger.refresh(); });

  return () => { abort.abort(); stop.revert(); };
}
