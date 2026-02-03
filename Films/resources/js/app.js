import './bootstrap';
import 'preline';
import { HSStaticMethods } from 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import Alpine from 'alpinejs';

window.HSStaticMethods = HSStaticMethods;
window.Alpine = Alpine;
window.axios = axios;
window.createIcons = createIcons;
window.icons = icons;

// --- Admin Component ---
import adminComponent from './admin';
Alpine.data('adminComponent', adminComponent);

Alpine.start();

// Initialize Preline
HSStaticMethods.autoInit();

createIcons({ icons });