import arrowUpRight from '@phosphor-icons/core/assets/regular/arrow-up-right.svg?raw';
import arrowDown from '@phosphor-icons/core/assets/regular/arrow-down.svg?raw';
import list from '@phosphor-icons/core/assets/regular/list.svg?raw';
import close from '@phosphor-icons/core/assets/regular/x.svg?raw';
import copy from '@phosphor-icons/core/assets/regular/copy.svg?raw';
import sun from '@phosphor-icons/core/assets/regular/sun.svg?raw';
import squaresFour from '@phosphor-icons/core/assets/regular/squares-four.svg?raw';
import wifiHigh from '@phosphor-icons/core/assets/regular/wifi-high.svg?raw';
import cookingPot from '@phosphor-icons/core/assets/regular/cooking-pot.svg?raw';
import bed from '@phosphor-icons/core/assets/regular/bed.svg?raw';
import asterisk from '@phosphor-icons/core/assets/regular/asterisk.svg?raw';
import plus from '@phosphor-icons/core/assets/regular/plus.svg?raw';
import arrowUp from '@phosphor-icons/core/assets/regular/arrow-up.svg?raw';

const icons = { 'arrow-up-right': arrowUpRight, 'arrow-down': arrowDown, 'arrow-up': arrowUp, list, x: close, copy, sun, 'squares-four': squaresFour, 'wifi-high': wifiHigh, 'cooking-pot': cookingPot, bed, asterisk, plus };

export function mountIcons(root) {
  root.querySelectorAll('[data-icon]').forEach(element => {
    const svg = icons[element.dataset.icon];
    if (svg) {
      element.innerHTML = svg;
      element.querySelector('svg').setAttribute('aria-hidden', 'true');
      element.querySelector('svg').setAttribute('focusable', 'false');
    }
  });
}
