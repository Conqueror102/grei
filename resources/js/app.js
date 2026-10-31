import { mountIcons } from './ui/icons.js';
import { mountNavigation } from './ui/navigation.js';
import { mountEnquiry } from './ui/enquiry.js';
import { mountMotion } from './motion/index.js';
import { mountCollection } from './ui/collection.js';
import { mountSpaces } from './ui/spaces.js';
import { mountStayPlanner } from './ui/stay-planner.js';
import { mountDetailGalleries } from './ui/detail-gallery.js';
import { mountShortlist } from './ui/shortlist.js';
import { mountSolarDial } from './ui/solar-dial.js';
import { mountSpatialCurator } from './ui/spatial-curator.js';

let dispose = () => {};

function mount() {
  dispose();
  mountIcons(document);
  const cleanups = [
    mountNavigation(),
    mountEnquiry(),
    mountCollection(),
    mountSpaces(),
    mountStayPlanner(),
    mountDetailGalleries(),
    mountShortlist(),
    mountSolarDial(),
    mountSpatialCurator(),
    mountMotion()
  ];
  dispose = () => cleanups.reverse().forEach(cleanup => cleanup?.());
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', mount, { once: true });
else mount();

// One stable pair of listeners. Every mount disposes the old page's effects.
const onNavigating = () => dispose();
document.addEventListener('livewire:navigating', onNavigating);
document.addEventListener('livewire:navigated', mount);
if (import.meta.hot) import.meta.hot.dispose(() => {
  dispose();
  document.removeEventListener('livewire:navigating', onNavigating);
  document.removeEventListener('livewire:navigated', mount);
});
