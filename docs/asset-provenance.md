# Generated asset provenance

Mode: built-in Image Gen. Reference: the approved Open Frame hero image, copied to `work/approved-hero.png`. Both assets were inspected after generation. Natural colours were preserved; optimisation only resizes, trims transparent margins and encodes WebP.

## Architecture photograph

- Source: `work/hero-assets/courtyard-residence.png`.
- Consumed asset: `public/assets/courtyard-residence.webp`.
- No transparency, no text or interface baked into the asset.
- One generation, no correction.

Final prompt:

> Use case: photorealistic-natural. Asset type: original architecture photograph for the approved GREI hero implementation. Input image 1 is a reference layout only; extract and faithfully recreate ONLY the architectural photograph from the right side as a full rectangular photograph, filling the entire output. NO website interface, NO typography, NO icons, NO rounded edges or contour masks, NO metal sculpture, NO cream empty margin. Output requested approximately 1536 x 1280 pixels. Faithfully match the reference photographic scene: a luxurious tropical coastal villa indoor-outdoor lounge with cream textured upholstery and one rust cushion, low walnut coffee table on a natural jute rug, walnut sliding glass frames behind the sofa, a woven wooden lounge chair near center right, pale limestone terrace and white structural arches at right, naturally lush tropical vegetation, glimpse of blue sea and clear cyan sky beyond right, turquoise swimming pool across foreground. Camera positioned at the pool edge looking toward the lounge, realistic architectural editorial photography with corrected straight verticals, restrained natural daylight and tactile material imperfections, plausible furniture construction and architecture, depth and soft shadows. Composition: interior lounge occupies left half, white arch and ocean view right half, pool occupies lower quarter; focus around 60 percent across and 50 percent down. Frame enough room above and on both sides for later CSS cropping. Natural material colors, walnut wood, off-white plaster, true green foliage, realistic blue sky and pool. Do not grade the photo green, brown, or monochrome. Avoid CGI showroom render, overly smooth AI surfaces, dramatic golden filter, extra architecture, people, text, watermark. This is the precise approved architecture photograph reconstructed as a standalone asset, not a new concept.

## Metal portal

- Source: `work/hero-assets/metal-portal.png`.
- Consumed asset: `public/assets/metal-portal.webp`.
- True alpha in background and portal interior.
- One generation, no correction.

Final prompt:

> Use case: product-mockup. Asset type: isolated photographic decorative sculpture cutout for GREI website. Input image is REFERENCE ONLY. Generate ONLY the small brushed satin metal architectural portal sculpture visible at bottom left of the reference image. No webpage, UI, typography, photography, frame, or other objects. Subject: one thick flat brushed satin silver metal strip bent into an upside-down U architectural arch, vertical squared sides and smoothly rounded top, broad flat ribbon depth, three-quarter view looking slightly down; match the reference shape and camera angle. Physically plausible metal with restrained warm reflected highlights, subtle fine scratches. Elegant sophisticated understated product photograph. Truly transparent background with alpha, empty portal interior transparent too. Whole sculpture uncropped, centered with 12 percent empty margin, square 1024 composition. Small soft contact shadow permitted under the metal feet. Avoid chrome mirror finish, inflated tube or blob forms, gold paint, symbols, letters, fake transparency checkboard.

## Other assets

- Phosphor icons: the official `@phosphor-icons/core` package; thirteen imported SVG types.
- Fonts: the official Fontsource packages for Unbounded and Manrope; local Latin font files.
- Favicon: mechanical crop of the initial G in the approved concept.

## Homepage expansion

Mode: built-in image generation. All five photographs and three transparent illustrations were inspected, copied into the workspace and encoded as local WebP. Alpha was verified on each illustration and preserved during encoding. Originals remain in `work/section-assets/`.

| Final asset | Use |
| --- | --- |
| `public/assets/courtyard-exterior.webp` | Property collection / architectural concept |
| `public/assets/city-apartment.webp` | Property collection, word-window and furnished-stay gallery |
| `public/assets/slow-morning.webp` | Bedroom print and furnished-stay gallery |
| `public/assets/soft-geometry.webp` | Residential design concept |
| `public/assets/the-social-room.webp` | Commercial design concept |
| `public/assets/house-cutaway.webp` | Transparent architectural model in the brand story |
| `public/assets/stay-keys.webp` | Transparent metal/leather keys at the stays chapter boundary |
| `public/assets/design-assemblage.webp` | Transparent chair and floating materials in the design chapter |

Exact final prompts: `homepage-image-prompts.md` and `homepage-illustration-prompts.md`. These assets illustrate the website's design direction and are not evidence of real property inventory or completed GREI commissions.
