import gsap from 'gsap';

export function mountMicroInteractions({ desktop }) {
  if (!desktop || !matchMedia('(pointer: fine)').matches) return () => {};
  const abort = new AbortController();
  const options = { signal: abort.signal };
  const scope = gsap.context(() => {
    // The wrapper follows the pointer; its image keeps its independent scroll
    // transform, so the two effects never fight over the same properties.
    [['.world-heading', '.world-object'], ['.design-heading', '.design-object']].forEach(([stageSelector, objectSelector]) => {
      const region = document.querySelector(stageSelector);
      const object = document.querySelector(objectSelector);
      if (!region || !object) return;
      gsap.set(object, { transformPerspective: 900 });
      const turn = gsap.quickTo(object, 'rotationY', { duration:.9, ease:'power3.out' });
      const lift = gsap.quickTo(object, 'y', { duration:.9, ease:'power3.out' });
      region.addEventListener('pointermove', event => {
        const rect = region.getBoundingClientRect();
        turn(((event.clientX - rect.left) / rect.width - .5) * 14);
        lift(((event.clientY - rect.top) / rect.height - .5) * -12);
      }, options);
      region.addEventListener('pointerleave', () => { turn(0); lift(0); }, options);
    });
    document.querySelectorAll('.magnetic').forEach(element => {
      const x = gsap.quickTo(element, 'x', { duration: .45, ease: 'power3.out' });
      const y = gsap.quickTo(element, 'y', { duration: .45, ease: 'power3.out' });
      element.addEventListener('pointermove', event => {
        const bounds = element.getBoundingClientRect();
        x((event.clientX - bounds.left - bounds.width / 2) * .18);
        y((event.clientY - bounds.top - bounds.height / 2) * .18);
      }, options);
      element.addEventListener('pointerleave', () => { x(0); y(0); }, options);
    });
    const sculpture = document.querySelector('.metal-portal');
    const stage = document.querySelector('.hero-scene');
    if (sculpture && stage) {
      const rotateX = gsap.quickTo(sculpture, 'rotationX', { duration: 1.1, ease: 'power3.out' });
      const rotateY = gsap.quickTo(sculpture, 'rotationY', { duration: 1.1, ease: 'power3.out' });
      stage.addEventListener('pointermove', event => {
        const bounds = stage.getBoundingClientRect();
        rotateY(((event.clientX - bounds.left) / bounds.width - .5) * 22);
        rotateX(((event.clientY - bounds.top) / bounds.height - .5) * -10);
      }, options);
      stage.addEventListener('pointerleave', () => { rotateX(0); rotateY(0); }, options);
    }
  });
  return () => { abort.abort(); scope.revert(); };
}
