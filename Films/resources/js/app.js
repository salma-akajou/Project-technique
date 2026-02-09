import './bootstrap';
import 'preline';
import { HSStaticMethods } from 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import initAdmin from './admin';

window.HSStaticMethods = HSStaticMethods;
window.axios = axios;
window.createIcons = createIcons;
window.icons = icons;

// --- Admin ---
initAdmin();

// Initialize Preline
HSStaticMethods.autoInit();

createIcons({ icons });