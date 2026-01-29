import './bootstrap';
import 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.axios = axios;

Alpine.start();

createIcons({ icons });