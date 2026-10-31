export function mountDetailGalleries(){
  const abort=new AbortController();const options={signal:abort.signal};
  document.querySelectorAll('[data-detail-gallery]').forEach(gallery=>{
    const main=gallery.querySelector('[data-gallery-main]');
    const dialog=gallery.querySelector('dialog');
    const expand=gallery.querySelector('[data-gallery-expand]');
    gallery.addEventListener('click',event=>{
      const thumbnail=event.target.closest('[data-gallery-src]');
      if(!thumbnail)return;
      main.src=thumbnail.dataset.gallerySrc;main.alt=thumbnail.dataset.galleryAlt;
      dialog.querySelector('img').src=main.src;dialog.querySelector('img').alt=main.alt;
      gallery.querySelectorAll('[data-gallery-src]').forEach(button=>button.setAttribute('aria-pressed',String(button===thumbnail)));
    },options);
    expand?.addEventListener('click',()=>{dialog.showModal();document.dispatchEvent(new CustomEvent('grei:dialog',{detail:{open:true}}));},options);
    dialog?.querySelector('[data-gallery-close]')?.addEventListener('click',()=>dialog.close(),options);
    dialog?.addEventListener('close',()=>{document.dispatchEvent(new CustomEvent('grei:dialog',{detail:{open:false}}));expand?.focus({preventScroll:true});},options);
  });
  return()=>{document.querySelectorAll('.gallery-lightbox[open]').forEach(dialog=>dialog.close());abort.abort();};
}
