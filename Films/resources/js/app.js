import './bootstrap';
import 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.axios = axios;
window.createIcons = createIcons;
window.icons = icons;

// --- Admin Component ---
import adminComponent from './admin';
Alpine.data('adminComponent', adminComponent);

Alpine.start();

createIcons({ icons });