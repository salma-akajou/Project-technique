import './bootstrap';
import 'preline';
import { createIcons, icons } from 'lucide';
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.axios = axios;

// --- Admin Component ---
Alpine.data('adminComponent', () => ({
    search: '',
    categorie_id: 'all',
    filmsTable: '',
    isOpen: false,
    editMode: false,
    filmId: null,
    film: { titre: '', directeur: '', description: '' },
    imagePreview: null,

    init() {
        this.$watch('search', () => this.fetchFilms());
        this.$watch('categorie_id', () => this.fetchFilms());
        this.initIcons();
    },

    initIcons() {
        this.$nextTick(() => createIcons({ icons }));
    },

    fetchFilms(page = 1) {
        axios.get('/admin/films', {
            params: {
                search: this.search,
                categorie_id: this.categorie_id === 'all' ? '' : this.categorie_id,
                page
            },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => {
            this.filmsTable = res.data;
            this.initIcons();
            this.$nextTick(() => window.HSStaticMethods?.autoInit());
        });
    },

    openModal(id = null) {
        this.editMode = !!id;
        this.filmId = id;
        this.imagePreview = null;

        if (id) {
            axios.get(`/admin/films/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(({ data }) => {
                    this.film = {
                        titre: data.film.titre || '',
                        directeur: data.film.directeur || '',
                        description: data.film.description || ''
                    };
                    if (data.film.image) this.imagePreview = `/storage/${data.film.image}`;
                    this.updateHSSelect(data.categories);
                });
        } else {
            this.film = { titre: '', directeur: '', description: '' };
            this.updateHSSelect([]);
        }

        this.isOpen = true;
        this.$nextTick(() => window.HSStaticMethods?.autoInit());
    },

    closeModal() { this.isOpen = false; },

    updateHSSelect(values) {
        this.$nextTick(() => {
            const select = this.$refs.categoriesSelect;
            if (select && window.HSSelect) {
                const instance = HSSelect.getInstance(select);
                if (instance) instance.setValue(values.map(v => v.toString()));
                else setTimeout(() => HSSelect.getInstance(select)?.setValue(values.map(v => v.toString())), 100);
            }
        });
    }
}));

Alpine.start();

createIcons({ icons });