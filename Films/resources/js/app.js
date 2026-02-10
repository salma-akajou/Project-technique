import './bootstrap';
import 'preline';
import { HSStaticMethods } from 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import Alpine from 'alpinejs';

// --- Components ---
import filmManager from './components/filmManager';

window.HSStaticMethods = HSStaticMethods;
window.Alpine = Alpine;
window.axios = axios;
window.createIcons = createIcons;
window.icons = icons;

// --- Admin Component ---
Alpine.data('adminComponent', filmManager);

Alpine.start();

// Initialize Preline
HSStaticMethods.autoInit();

createIcons({ icons });