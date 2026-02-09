function debounce(fn, wait) {
    let t;
    return (...args) => {
        window.clearTimeout(t);
        t = window.setTimeout(() => fn(...args), wait);
    };
}

export default function initAdmin() {
    const root = document.querySelector('[data-admin-root]');
    if (!root) return;

    const state = {
        search: '',
        categorie_id: 'all',
        page: 1,
        editMode: false,
        filmId: null,
        imagePreview: null
    };

    const el = {
        filmsTableWrapper: document.getElementById('filmsTableWrapper'),
        searchInput: document.getElementById('adminSearchInput'),
        categorySelect: document.getElementById('indexCategorySelect'),
        addButton: document.getElementById('adminAddFilmBtn'),
        modal: document.getElementById('filmModal'),
        modalBackdrop: document.getElementById('filmModalBackdrop'),
        modalTitle: document.getElementById('filmModalTitle'),
        modalCloseButtons: document.querySelectorAll('[data-modal-close]'),
        modalForm: document.getElementById('filmForm'),
        methodInputContainer: document.getElementById('filmFormMethodContainer'),
        inputTitre: document.getElementById('filmTitre'),
        inputDirecteur: document.getElementById('filmDirecteur'),
        inputDescription: document.getElementById('filmDescription'),
        categoriesSelect: document.getElementById('categories-select'),
        imageInput: document.getElementById('filmImageInput'),
        imagePreviewWrapper: document.getElementById('filmImagePreviewWrapper'),
        imagePreview: document.getElementById('filmImagePreview')
    };

    const initIcons = () => {
        window.createIcons?.({ icons: window.icons });
    };

    const autoInitUI = () => {
        window.HSStaticMethods?.autoInit();
        initIcons();
    };

    const setModalOpen = (open) => {
        const hiddenClass = 'hidden';
        if (!el.modal || !el.modalBackdrop) return;
        el.modal.classList.toggle(hiddenClass, !open);
        el.modalBackdrop.classList.toggle(hiddenClass, !open);
        if (open) autoInitUI();
    };

    
    const setImagePreview = (url) => {
        state.imagePreview = url;
        if (!el.imagePreviewWrapper || !el.imagePreview) return;
        if (url) {
            el.imagePreview.src = url;
            el.imagePreviewWrapper.classList.remove('hidden');
        } else {
            el.imagePreview.src = '';
            el.imagePreviewWrapper.classList.add('hidden');
        }
    };

    const updateHSSelect = (values) => {
        if (!el.categoriesSelect || !window.HSSelect) return;
        const ids = (values || []).map(v => v.toString());
        const instance = window.HSSelect.getInstance(el.categoriesSelect);
        if (instance) instance.setValue(ids);
        else window.setTimeout(() => window.HSSelect.getInstance(el.categoriesSelect)?.setValue(ids), 100);
    };

    const fillForm = ({ titre = '', directeur = '', description = '' }) => {
        if (el.inputTitre) el.inputTitre.value = titre;
        if (el.inputDirecteur) el.inputDirecteur.value = directeur;
        if (el.inputDescription) el.inputDescription.value = description;
    };

    const setEditMode = (editMode) => {
        state.editMode = editMode;

        if (el.modalTitle) {
            const addTitle = el.modalTitle.getAttribute('data-title-add') || '';
            const editTitle = el.modalTitle.getAttribute('data-title-edit') || '';
            el.modalTitle.textContent = editMode ? editTitle : addTitle;
        }

        if (el.modalForm) {
            const storeUrl = el.modalForm.getAttribute('data-store-url') || '';
            const updateUrlTemplate = el.modalForm.getAttribute('data-update-url-template') || '';
            el.modalForm.action = editMode
                ? updateUrlTemplate.replace(':id', String(state.filmId))
                : storeUrl;
        }

        if (el.methodInputContainer) {
            el.methodInputContainer.innerHTML = editMode
                ? '<input type="hidden" name="_method" value="PUT">'
                : '';
        }
    };

    const fetchFilms = async (page = 1) => {
        state.page = page;
        const categorieValue = state.categorie_id === 'all' ? '' : state.categorie_id;

        const res = await window.axios.get('/admin/films', {
            params: {
                search: state.search,
                categorie_id: categorieValue,
                page
            },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (el.filmsTableWrapper) {
            el.filmsTableWrapper.innerHTML = res.data;
        }

        autoInitUI();
    };

    const openModal = async (id = null) => {
        state.filmId = id;
        setImagePreview(null);
        setEditMode(Boolean(id));

        if (id) {
            const { data } = await window.axios.get(`/admin/films/${id}/edit`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            fillForm({
                titre: data?.film?.titre || '',
                directeur: data?.film?.directeur || '',
                description: data?.film?.description || ''
            });

            if (data?.film?.image) setImagePreview(`/storage/${data.film.image}`);
            updateHSSelect(data?.categories || []);
        } else {
            fillForm({ titre: '', directeur: '', description: '' });
            updateHSSelect([]);
        }

        setModalOpen(true);
    };

    const closeModal = () => setModalOpen(false);

    const onClick = (e) => {
        const editBtn = e.target.closest('[data-action="edit-film"]');
        if (editBtn) {
            e.preventDefault();
            const id = editBtn.getAttribute('data-film-id');
            if (id) openModal(Number(id));
            return;
        }

        const deleteSubmit = e.target.closest('form[data-confirm-message] button[type="submit"], form[data-confirm-message] input[type="submit"]');
        if (deleteSubmit) {
            const form = deleteSubmit.closest('form[data-confirm-message]');
            if (!form) return;
            const message = form.getAttribute('data-confirm-message') || 'Are you sure?';
            if (!window.confirm(message)) {
                e.preventDefault();
            }
            return;
        }

        const pageLink = e.target.closest('[data-action="paginate"]');
        if (pageLink) {
            e.preventDefault();
            const page = pageLink.getAttribute('data-page');
            if (page) fetchFilms(Number(page));
            return;
        }

        const modalClose = e.target.closest('[data-modal-close]');
        if (modalClose) {
            e.preventDefault();
            closeModal();
            return;
        }
    };

    const onKeyDown = (e) => {
        if (e.key === 'Escape') closeModal();
    };

    const bind = () => {
        root.addEventListener('click', onClick);
        document.addEventListener('keydown', onKeyDown);

        if (el.addButton) el.addButton.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });

        if (el.searchInput) {
            const handler = debounce(() => {
                state.search = el.searchInput.value || '';
                fetchFilms(1);
            }, 300);

            el.searchInput.addEventListener('input', handler);
        }

        if (el.categorySelect) {
            el.categorySelect.addEventListener('change', () => {
                state.categorie_id = el.categorySelect.value || 'all';
                fetchFilms(1);
            });
        }

        if (el.modal) {
            el.modal.addEventListener('click', (e) => {
                if (e.target === el.modal) closeModal();
            });
        }

        if (el.imageInput) {
            el.imageInput.addEventListener('change', () => {
                const file = el.imageInput.files?.[0];
                setImagePreview(file ? URL.createObjectURL(file) : null);
            });
        }
    };

    bind();
    autoInitUI();
}
