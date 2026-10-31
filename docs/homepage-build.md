# Homepage implementation

The existing approved header and hero are retained. The homepage now develops the three GREI services as distinct visual chapters.

## Composition

1. **Point of view:** oversized editorial statement with a photographic word-window. A transparent cutaway house sits freely beside the brand introduction, with scroll rotation and a separate subtle pointer response. Three typographic paths lead into the services.
2. **Property:** an architectural image paired with a numbered selection index rather than a repeated card grid. Category filters select illustrative collection studies. Explore opens a reusable detail dialog and contextual property enquiry.
3. **Stays:** a forest-coloured chapter with floating metal keys, an immersive room photograph and a smaller bedroom print. The date/guest planner overlaps the image. Native date validation prevents past check-in dates and check-out before check-in. The selected dates carry into WhatsApp when configured, or into the local enquiry preparation flow.
4. **Design:** a large transparent chair/material assemblage leads into two differently proportioned project images. Independent image parallax and staggered placement give the gallery depth. Each concept opens a design detail and consultation enquiry.
5. **Process:** a stone-coloured conversational section with three native details accordions. Only one process step opens at a time.
6. **Closing:** an enlarged metal portal, conversation action, service navigation and an oversized GREI wordmark.

## Component boundaries

- Views: `introduction`, `property-collection`, `stays`, `design-studio`, `design-process`, `footer`, `space-dialog`.
- Interaction: `ui/collection.js`, `ui/spaces.js`, `ui/stay-planner.js`, existing `ui/enquiry.js` and `ui/navigation.js`.
- Data: `data/spaces.js` contains clearly identified illustrative content. Replace it with published Laravel records when real inventory/projects are supplied.
- Motion: `motion/chapters.js`, with illustration pointer response in `motion/micro-interactions.js`.
- Each UI module returns cleanup; listeners, media contexts and tweens are disposed on Livewire navigation. Server lifecycle remains to be verified in a complete Laravel app.

## Artwork

Five photographs and three transparent spatial illustrations were generated with the built-in image-generation tool. Transparency was checked from actual alpha metadata and the illustrations were visually inspected against ivory. Natural material colours are independent of the website palette. Originals live in `work/section-assets/`; final WebP assets in `public/assets/`.

The exact final paths and prompt sets are in `homepage-image-prompts.md` and `homepage-illustration-prompts.md`. All visible collection/project studies are distinguished from actual listings or completed commissions.

## Verification

- Local browser checks at 1505 × 1045, 1280 × 720, 820 × 1180, 390 × 844 and 320 × 740.
- Property category filter changed visible entries and featured photograph correctly; detail/enquiry preserved the selected context.
- Stay planner rejected check-out before check-in; valid dates and three guests carried into the enquiry.
- Gallery thumbnail selection changed the main image and pressed state.
- Residential design enquiry carried the correct project and service.
- Process accordion switched from the first to second step.
- Detail-to-enquiry transitions kept input focus in the new dialog and returned focus to the original page trigger on closing.
- Desktop and mobile full-page renders inspected, including separate mobile story/design crops.
- Corrected initial cutout height distortion, mobile keys overlapping the heading, joined property name words, and modal close-control sizing/scroll access.
- No broken image sources or horizontal document overflow in the checked layouts.
- Source checks and production build passed.

Evidence: `work/qa/homepage-desktop-full.png`, `homepage-mobile-full.png`, `about-mobile.png`, `design-mobile.png`, `homepage-desktop-overview.png`, plus final desktop section captures.

## Application work remaining

This is the homepage frontend. Real listing records, full multi-field search, property media/video uploads, live availability, admin settings, server-side consultation handling and dedicated service pages need the Laravel application and business content. No actual booking or message was transmitted during testing. A WhatsApp handoff should be verified with the configured business number. Physical Safari/iOS and Android testing remains for release validation.
