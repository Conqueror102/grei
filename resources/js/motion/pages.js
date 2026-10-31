import gsap from 'gsap';

export function mountPageMotion(){
  const scope=gsap.context(()=>{
    const heading=document.querySelector('.page-shell h1');
    if(heading)gsap.from(heading,{clipPath:'inset(0 0 100% 0)',duration:1,ease:'power3.out'});
    document.querySelectorAll('.page-cutout').forEach(art=>{
      gsap.fromTo(art,{rotation:-6,y:25},{rotation:4,y:-25,ease:'none',scrollTrigger:{trigger:art.closest('section')||art,start:'top bottom',end:'bottom top',scrub:1}});
    });
  });
  return()=>scope.revert();
}
