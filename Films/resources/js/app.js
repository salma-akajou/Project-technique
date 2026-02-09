import './bootstrap';
import 'preline';
import { HSStaticMethods } from 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';

window.HSStaticMethods = HSStaticMethods;
window.axios = axios;
window.createIcons = createIcons;
window.icons = icons;

document.addEventListener('click', (e) => {
    const menu = e.target.closest('[data-user-menu]');
    const anyMenu = document.querySelector('[data-user-menu]');
    const dropdown = anyMenu?.querySelector('[data-user-menu-dropdown]');
    const icon = anyMenu?.querySelector('[data-user-menu-icon]');

    if (!anyMenu || !dropdown) return;

    const isButton = e.target.closest('[data-user-menu-button]');

    if (isButton) {
        e.preventDefault();
        const isHidden = dropdown.classList.contains('hidden');
        dropdown.classList.toggle('hidden', !isHidden);
        if (icon) icon.classList.toggle('rotate-180', isHidden);
        return;
    }

    if (!menu) {
        dropdown.classList.add('hidden');
        if (icon) icon.classList.remove('rotate-180');
    }
});

// --- Admin Component ---
import initAdmin from './admin';
initAdmin();

// Initialize Preline
HSStaticMethods.autoInit();

createIcons({ icons });