import { baseLogic } from './baseComponent.js';

const filmService = {
    async getAll(params) {
        return axios.get('/admin/films', {
            params,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
    },

    async getOne(id) {
        return axios.get(`/admin/films/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
    },

    async delete(id) {
        return axios.delete(`/admin/films/${id}`);
    }
};


export default () => ({
    ...baseLogic(filmService),
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
        this.reinitUI();
    },

    async fetchFilms(page = 1) {
        await this.performFetch(
            () => filmService.getAll({
                search: this.search,
                categorie_id: this.categorie_id === 'all' ? '' : this.categorie_id,
                page
            }),
            (res) => {
                this.filmsTable = res.data;
                this.reinitUI();
            }
        );
    },

    async openModal(id = null) {
        this.editMode = !!id;
        this.filmId = id;
        this.imagePreview = null;

        if (id) {
            await this.performFetch(
                () => filmService.getOne(id),
                ({ data }) => {
                    this.film = {
                        titre: data.film.titre || '',
                        directeur: data.film.directeur || '',
                        description: data.film.description || ''
                    };
                    if (data.film.image) this.imagePreview = `/storage/${data.film.image}`;
                    this.updateHSSelect(data.categories);
                }
            );
        } else {
            this.film = { titre: '', directeur: '', description: '' };
            this.updateHSSelect([]);
        }

        this.isOpen = true;
        this.reinitUI();
    },

    closeModal() {
        this.isOpen = false;
    },

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
});
