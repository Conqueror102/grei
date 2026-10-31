# GREI header and hero — design QA

Date: 2026-10-30. Scope: correction of the user-reported header and hero fidelity regressions.

## Source and current evidence

- Approved source: `work/approved-hero.png` (1505 × 1045).
- Preview: http://127.0.0.1:4173/.
- Current desktop: `work/qa/desktop-geometry.png`.
- Source/implementation comparison: `work/qa/geometry-comparison.png`.
- Header and image-corner close-up: `work/qa/curves-detail.png`.
- Wide desktop: `work/qa/wide-geometry.png` (1835 × 883 CSS viewport).
- Laptop: `work/qa/laptop-geometry.png` (1280 × 720 CSS viewport).
- Mobile: `work/qa/mobile-geometry-top.png` (390 × 844 CSS viewport).

Desktop comparison uses the top 1045 pixels of a full-page browser screenshot, with the source cropped by the native scrollbar width to 1490 pixels. Both frames have identical dimensions with no scaling. The combined comparison and close-up were opened and inspected. State: home route at page top, entrance completed, menu/dialog closed.

## Regressions corrected

The earlier pass incorrectly accepted excess blank space between the headline and photo. The user's review superseded that assessment.

1. **P2 — Header left end and arrow cradle were imprecise.** Replaced approximate/double clipping with one contour: true 32px semicircular left end and a 40px concave arc concentric with the 32px-radius contact button. Fixed a shared CSS rule overriding the button size; browser reports exactly 64 × 64. Removed pointer translation from this geometrically seated control; icon hover remains.
2. **P2 — Photo upper-left corner had a visible join.** Removed overlapping border-radius and clipping rules. The corner is now one true quarter-circle with tangent top/side joins. Browser-computed clipping and the enlarged screenshot confirm the contour renders.
3. **P2 — Headline stopped too far from the photo.** Restored the 12% contour inset and enlarged short-screen typography so the first line reaches into the photograph as in the approved source.
4. **P2 — Crop and hero content did not fit shorter desktop windows.** Removed permanent photo overzoom and vertical scroll translation. Rebalanced scene height, text spacing, actions and ornament for viewports up to 980px high. At 1835 × 883, the photo ends at 815.3px, ornament at 799.9px and baseline at 875px, all within the viewport.
5. **P2 — Shared text-link style exposed desktop About on mobile.** Increased component selector specificity. Confirmed hidden at 320px while mobile navigation remains available.

## Visual findings

- Actual local Unbounded Regular / Manrope and Phosphor icons are retained.
- Stone & Forest palette and natural untinted photography are retained.
- Headline width, image silhouette, navigation and detached arrow now follow the selected source composition.
- Smaller optical differences remain between generated mock lettering and real font metrics; the separately recreated photo and metal ornament also differ slightly in furniture/framing and angle.
- No unresolved P0/P1/P2 findings observed in the corrected header/hero views.

## Verification

- Browser checks at 1505 × 1045, 1835 × 883, 1280 × 720, 390 × 844 and 320 × 740.
- No horizontal document overflow in the checked views.
- Header contact opens the enquiry dialog and restores focus on closing.
- Mobile menu opens/closes after the geometry changes.
- Final browser warning/error logs: empty.
- Source checks and production build passed after the final changes.
- Previous service-navigation, message preparation, clipboard, dialog and focus tests remain recorded in the earlier task history; their business logic was not changed in this correction.

## Limits

This verifies the local frontend preview. PHP/Laravel bootstrap, Livewire server lifecycle, inventory, persistence and admin settings have not been verified. No actual WhatsApp recipient is configured. Physical Safari/iOS and Android testing remains for release validation. Reduced-motion and pointer effects are implemented but were not separately emulated in this correction.

final result: passed

## Homepage expansion — 2026-10-30

The remaining homepage presentation is implemented and browser-checked. See `docs/homepage-build.md` for section/component ownership, interaction checks, responsive evidence and application boundaries.

Eight new locally saved assets support the composition: five photographs and three transparent spatial illustrations. The cutaway house, key ring and chair/material assemblage were inspected with actual alpha transparency and placed freely within the layout. The original approved header/hero composition remains intact.

Verified category filtering, collection selection, contextual detail/enquiry handoffs, gallery thumbnails, invalid/valid stay dates and guest counts, design consultation context, process accordions and modal focus restoration. Browser checks covered desktop, laptop, tablet, 390px and 320px layouts. Final DOM checks showed all images loaded, 42 rendered icon instances and no horizontal overflow. Browser warning/error logs were empty. Source checks (12 JavaScript modules / 12 Blade views) and the Vite production build passed.

Evidence includes `work/qa/homepage-desktop-full.png`, `homepage-mobile-full.png`, `about-mobile.png`, `design-mobile.png` and `design-desktop.png`. A later attempt to recapture the desktop render after source formatting was unavailable in the preview tool; the existing visual captures and final DOM/console checks remain the verification evidence. The formatting and footer trademark-symbol removal do not alter the captured design-section geometry.

The new content remains explicitly identified as illustrative collection/project studies. No real inventory, reservation confirmation, server-side persistence or complete Laravel runtime is claimed.

homepage frontend result: passed
