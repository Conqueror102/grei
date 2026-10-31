# GREI

The GREI homepage, built with reusable Laravel Blade components, local Unbounded/Manrope fonts, Phosphor SVG icons, GSAP, ScrollTrigger and Lenis. The approved **Open Frame** header/hero leads into an editorial brand story, interactive property collection, furnished-stay feature, interior-design gallery, design process and sculptural footer.

## Run the design preview

```powershell
npm install
npm run dev
```

Open `http://127.0.0.1:4173/`. The server runs only on the local machine.

```powershell
npm run check
npm run build
```

The preview assembles the actual Blade component files through a small Vite adapter. There is no React application or duplicate HTML mockup. Fonts and image assets are served locally.

## Laravel integration status

The selected folder originally contained only `vendor/`; it did not contain an application bootstrap, `artisan`, or `composer.json`. This implementation supplies the view layer and does not create or pretend to run a Laravel backend.

When the Laravel application is ready, retain these directories and merge their files into it:

- `resources/views/`: the page and eleven reusable components.
- `resources/css/`: design tokens and component styles.
- `resources/js/`: page lifecycle, UI behaviour, and independent motion modules.
- `public/assets/`: optimised generated assets.
- `config/grei.php`: central contact configuration.
- `routes/web.php`: the homepage route; merge with existing routes.

Keep the dependency entries from `package.json`. `vite.config.js` detects `bootstrap/app.php` and switches to the Laravel Vite plugin automatically. Blade's `@vite` directive then supplies the assets normally.

## Contact configuration

Set `GREI_WHATSAPP_NUMBER` in the Laravel application's `.env`, using international digits only, e.g. country code followed by the national number, without `+`, spaces, or punctuation. No real or invented number is bundled.

With a valid configured number, the form opens WhatsApp with a prefilled message. Without one, it prepares a message that the visitor can review, edit, and copy. No enquiry is transmitted or reservation confirmed by this prototype.

The central `grei.whatsapp_number` setting is the integration point for the future admin settings screen. An authenticated admin dashboard and database-backed settings have not been built. The stay planner opens WhatsApp directly when a valid number is configured; the local preview uses the review/copy enquiry path.

## Motion and accessibility

- Masked typography entrance and scroll-controlled image-contour expansion.
- Pointer-responsive metal ornament, gently magnetic circular controls, hover and press feedback.
- Transparent architectural house, keys and chair/material assemblage, composed into the page with separate scroll and pointer motion.
- Scroll-linked word emphasis, an expanding property image, layered stay photography and an asymmetric interior gallery.
- Touch layouts use a separate composition; pointer effects are restricted to fine pointers.
- System reduced-motion preferences disable GSAP scenes and smooth scrolling.
- Native links, details accordions, labels, required fields, modal focus management, Escape dismissal, and a skip link.
- Motion and UI modules clean up on Livewire navigation. Full PHP/Livewire integration still requires verification inside the completed Laravel application.

## Scope

This milestone implements the complete homepage presentation and its local interactions: collection category filters and selection, property/project detail dialogs, stay gallery, validated date/guest enquiry preparation, design consultation enquiries and process accordions.

The collection and portfolio imagery are explicitly labelled concept studies. They do not represent real available properties or completed commissions. Full inventory search (location, type, price and bedrooms), live availability, dedicated catalogue/portfolio routes, booking management, authentication and the admin dashboard remain separate application work.

All eight new photographic and transparent illustration assets are local, optimised WebP files. Exact asset paths and the built-in image-generation prompts are saved in `docs/homepage-image-prompts.md` and `docs/homepage-illustration-prompts.md`.

See `docs/design-direction.md`, `docs/asset-provenance.md`, `docs/homepage-build.md`, and `design-qa.md`.
