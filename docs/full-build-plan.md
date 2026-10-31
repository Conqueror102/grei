# GREI full-site goal

User objective: build all previously scoped pages and features, with a richer homepage. Preserve the approved header/hero, Unbounded/Manrope, Phosphor, Stone & Forest palette, natural photography and spatial cutout illustrations. Laravel/PHP and Livewire remain the application stack.

## Acceptance checklist

- [ ] A running Laravel application with database migrations and repeatable setup.
- [ ] Homepage adds a useful service chooser, practical brand/value content, FAQ and routes into every service; retains the existing approved visual direction.
- [ ] Property index with location, property type, sale/rental/investment category, price and bedroom filters, URL state, pagination and empty/reset states.
- [ ] Dedicated property detail pages with high-resolution gallery, specifications, amenities, optional video and contextual enquiry.
- [ ] Furnished-stay index and individual stay pages with amenities, guest capacity, rate presentation, date validation and availability checking against admin-managed blocked dates.
- [ ] Stay booking handoff goes directly to configured WhatsApp with the chosen apartment, dates and guests. A missing number has a truthful useful fallback.
- [ ] Interior-design landing, filterable project portfolio, individual projects, residential/commercial/styling services and design consultation form.
- [ ] About and contact pages, privacy/terms content editable before launch, accessible navigation and honest empty/error states.
- [ ] Enquiries persist server-side with validation, rate limits, duplicate-submit protection and clear success/failure feedback.
- [ ] Authenticated, authorised admin dashboard for properties, stays, project portfolio, media, amenities, availability, enquiries and brand/contact settings including WhatsApp.
- [ ] Private-by-default draft/publish workflows and secure file upload handling.
- [ ] Future retail extension point (data/navigation modules), without a premature public shop or checkout.
- [ ] Responsive browser checks for full user journeys and server-side tests for search, publication rules, auth/authorisation, enquiries, settings and stay date availability.
- [ ] Build, migration/setup documentation and requirement-by-requirement completion audit.

## Current authoritative starting point

At goal start, the repository contains the homepage Blade/CSS/JS view layer and a Vite preview adapter. `vendor/` contains only an interrupted download, not an installed framework. There is no composer.json, artisan, application bootstrap, application database or admin implementation. The existing frontend interactions are an illustrative prototype.

## Working order

1. Establish the Laravel runtime and durable domain models while preserving the current view layer.
2. Implement public service routes, listings/details, consultation/contact and richer homepage navigation/content.
3. Implement authenticated admin operations and connect configuration/media/availability/enquiries.
4. Verify real server behaviour, browser journeys and responsive design; fix issues and audit the full checklist.

Actual brand inventory, real completed project content and the business WhatsApp number have not been supplied. Any seeded demonstration records must be explicitly labelled as such and removable without becoming production claims. Do not fabricate testimonials, business statistics or real availability.
