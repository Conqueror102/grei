# GREI design direction

Approved visual: `work/approved-hero.png`, generated and selected in this conversation.

## Decisions

- Display: Unbounded Regular. Supporting type: Manrope.
- Icons: Phosphor Regular, importing only the SVGs that are used.
- Stone & Forest palette: ivory #F5F1E8, stone #E5DDD0, charcoal #252824, forest #3E5147, brass #A58152.
- Distinctive, spatial and surprising, with precise small details and clear usability.
- Floating sculpted navigation, asymmetric architectural image contour, oversized typography, and one small metal portal ornament.
- Photography retains natural independent colour, credible materials, and real-world lighting. No overall green/beige palette tint.
- Generated concept imagery is marketing artwork and must not represent an actual bookable apartment or real property listing.
- Responsive hover, press, icon, pointer and scroll interactions. No custom cursor or forced scroll lock for storytelling.

## Component ownership

The home page composes the layout, header, hero, introduction, footer and enquiry dialog. Styling is divided by component. Browser interaction and motion are separate modules. Laravel models/actions will own future business operations; Livewire components will own future reactive application behaviour.

## Intentional adaptations

- Actual locally served Unbounded/Manrope replace the approximate typography in the raster concept.
- The photograph and metal ornament were recreated separately from the approved reference for real responsive composition and independent movement.
- A separate mobile composition and shorter laptop-height composition preserve readability and access to actions.
- The opening image contour preserves the approved headline/photo overlap, with tangent circular joins and height-aware framing.
- Navigation opens the relevant supporting service section for this milestone; listing and portfolio routes are not fabricated.
