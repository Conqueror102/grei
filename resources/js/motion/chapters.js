import gsap from 'gsap';

export function mountChapterMotion({ desktop }) {
  const scope = gsap.context(() => {
    gsap.fromTo('[data-read-word]', { opacity:.22 }, {
      opacity:1, stagger:.15, ease:'none',
      scrollTrigger:{ trigger:'.world-statement',start:'top 82%',end:'bottom 48%',scrub:.6 }
    });
    gsap.fromTo('.world-window', { width:'0em' }, {
      width: matchMedia('(max-width:600px)').matches ? '1.35em' : '1.9em', ease:'power2.out',
      scrollTrigger:{ trigger:'.world-statement',start:'top 85%',end:'bottom 65%',scrub:1 }
    });
    gsap.fromTo('.world-object img', { rotation:-12,y:35 }, {
      rotation:3,y:-15,ease:'none',
      scrollTrigger:{ trigger:'.world-object',start:'top bottom',end:'bottom top',scrub:1 }
    });
    gsap.fromTo('.collection-feature', { clipPath:'inset(0% 14% 0% 0%)' }, {
      clipPath:'inset(0% 0% 0% 0%)',ease:'none',
      scrollTrigger:{ trigger:'.collection-stage',start:'top 88%',end:'top 35%',scrub:.8 }
    });
    gsap.fromTo('.stay-keys', { rotation:-12,y:25 }, {
      rotation:18,y:-35,ease:'none',
      scrollTrigger:{ trigger:'.stay-heading',start:'top bottom',end:'bottom top',scrub:1 }
    });
    gsap.fromTo('.stay-landscape', { scale:1.1 }, {
      scale:1,ease:'none',
      scrollTrigger:{ trigger:'.stay-canvas',start:'top bottom',end:'bottom top',scrub:1 }
    });
    gsap.fromTo('.stay-inset', { rotation:8,y:25 }, {
      rotation:-3,y:-20,ease:'none',
      scrollTrigger:{ trigger:'.stay-canvas',start:'top bottom',end:'bottom top',scrub:1 }
    });
    gsap.fromTo('.design-object img', { rotation:5,y:35 }, {
      rotation:-6,y:-25,ease:'none',
      scrollTrigger:{ trigger:'.design-heading',start:'top bottom',end:'bottom top',scrub:1 }
    });
    document.querySelectorAll('.project-image').forEach(project => {
      gsap.fromTo(project.querySelector('img'), { scale:1.13,yPercent:-4 }, {
        yPercent:4,ease:'none',scrollTrigger:{ trigger:project,start:'top bottom',end:'bottom top',scrub:.8 }
      });
    });
    if (desktop) {
      gsap.fromTo('.design-project-secondary', { y:80 }, {
        y:-30,ease:'none',scrollTrigger:{ trigger:'.design-gallery',start:'top bottom',end:'bottom top',scrub:1 }
      });
    }
    gsap.fromTo('.footer-portal', { rotation:17,y:60 }, {
      rotation:-5,y:-10,ease:'none',scrollTrigger:{ trigger:'.grei-footer',start:'top bottom',end:'bottom bottom',scrub:1 }
    });
  });
  return () => scope.revert();
}
