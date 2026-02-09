function debounce(fn, wait = 300) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function isAdminPage() {
    return !!document.getElementById('admin-root');
}

function initIconsAndUI() {
    try {
        window.createIcons?.({ icons: window.icons });
    } catch (_) {
        // ignore
    }
    try {
        window.HSStaticMethods?.autoInit();
    } catch (_) {
        // ignore
    }
}

function getQueryParams() {
    const search = document.getElementById('adminSearch');
    const category = document.getElementById('indexCategorySelect');

    return {
        search: search?.value || '',
        categorie_id: !category || category.value === 'all' ? '' : category.value,
    };
}

function setHSSelectValues(selectEl, values) {
    if (!selectEl || !window.HSSelect) return;
    const strValues = (values || []).map(v => v.toString());
    const instance = window.HSSelect.getInstance(selectEl);
    if (instance) {
        instance.setValue(strValues);
        return;
    }
    setTimeout(() => {
        window.HSSelect.getInstance(selectEl)?.setValue(strValues);
    }, 100);
}

function openModal({ editMode, filmId } = { editMode: false, filmId: null }) {
    const modal = document.getElementById('filmModal');
    const backdrop = document.getElementById('filmModalBackdrop');
    const title = document.getElementById('filmModalTitle');
    const form = document.getElementById('filmForm');
    const method = document.getElementById('filmFormMethod');
    const titre = document.getElementById('filmTitre');
    const directeur = document.getElementById('filmDirecteur');
    const description = document.getElementById('filmDescription');
    const imageInput = document.getElementById('image');
    const previewWrapper = document.getElementById('filmImagePreviewWrapper');
    const previewImg = document.getElementById('filmImagePreview');
    const categoriesSelect = document.getElementById('categories-select');

    if (!modal || !backdrop || !form || !method) return;

    if (title) {
        title.textContent = editMode ? (title.dataset.titleEdit || title.textContent) : (title.dataset.titleAdd || title.textContent);
    }

    const storeAction = form.dataset.storeAction || form.getAttribute('action');
    form.action = editMode && filmId ? `/admin/films/${filmId}` : storeAction;
    method.value = editMode ? 'PUT' : 'POST';

    if (imageInput) imageInput.value = '';
    if (previewWrapper) previewWrapper.classList.add('hidden');
    if (previewImg) previewImg.src = '';

    if (!editMode) {
        if (titre) titre.value = '';
        if (directeur) directeur.value = '';
        if (description) description.value = '';
        setHSSelectValues(categoriesSelect, []);
    }

    modal.classList.remove('hidden');
    backdrop.classList.remove('hidden');
    initIconsAndUI();

    if (editMode && filmId) {
        window.axios
            .get(`/admin/films/${filmId}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(({ data }) => {
                if (titre) titre.value = data?.film?.titre || '';
                if (directeur) directeur.value = data?.film?.directeur || '';
                if (description) description.value = data?.film?.description || '';

                if (data?.film?.image && previewWrapper && previewImg) {
                    previewImg.src = `/storage/${data.film.image}`;
                    previewWrapper.classList.remove('hidden');
                }

                setHSSelectValues(categoriesSelect, data?.categories || []);
                initIconsAndUI();
            });
    }
}

function closeModal() {
    const modal = document.getElementById('filmModal');
    const backdrop = document.getElementById('filmModalBackdrop');
    modal?.classList.add('hidden');
    backdrop?.classList.add('hidden');
}

function fetchFilms(page = 1) {
    const wrapper = document.getElementById('filmsTableWrapper');
    if (!wrapper) return;

    const { search, categorie_id } = getQueryParams();

    window.axios
        .get('/admin/films', {
            params: { search, categorie_id, page },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => {
            wrapper.innerHTML = res.data;
            initIconsAndUI();
        });
}

function handleAdminRootClick(e) {
    const target = e.target;
    if (!(target instanceof Element)) return;

    const editBtn = target.closest('[data-action="edit"]');
    if (editBtn) {
        const id = editBtn.getAttribute('data-film-id');
        openModal({ editMode: true, filmId: id });
        return;
    }
}

function handleFilmsTableSubmit(e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    if (form.dataset.action !== 'delete') return;

    if (!confirm(form.getAttribute('data-confirm') || form.dataset.confirm || 'Confirmer la suppression ?')) {
        e.preventDefault();
    }
}

function handlePaginationClick(e) {
    const a = e.target instanceof Element ? e.target.closest('a') : null;
    if (!a) return;
    if (!a.closest('#filmsTableWrapper')) return;

    const href = a.getAttribute('href');
    if (!href) return;

    try {
        const url = new URL(href, window.location.origin);
        const page = url.searchParams.get('page');
        if (!page) return;
        e.preventDefault();
        fetchFilms(page);
    } catch (_) {
        // ignore
    }
}

export default function initAdmin() {
    if (!isAdminPage()) return;

    const openBtn = document.getElementById('btnOpenCreateFilmModal');
    const searchInput = document.getElementById('adminSearch');
    const categorySelect = document.getElementById('indexCategorySelect');
    const adminRoot = document.getElementById('admin-root');
    const modal = document.getElementById('filmModal');
    const backdrop = document.getElementById('filmModalBackdrop');
    const imageInput = document.getElementById('image');
    const previewWrapper = document.getElementById('filmImagePreviewWrapper');
    const previewImg = document.getElementById('filmImagePreview');

    openBtn?.addEventListener('click', () => openModal({ editMode: false, filmId: null }));

    const debouncedFetch = debounce(() => fetchFilms(1), 300);
    searchInput?.addEventListener('input', debouncedFetch);
    categorySelect?.addEventListener('change', () => fetchFilms(1));

    adminRoot?.addEventListener('click', handleAdminRootClick);
    document.addEventListener('click', handlePaginationClick);
    document.addEventListener('submit', handleFilmsTableSubmit, true);

    function handleModalClick(e) {
        const t = e.target;
        if (!(t instanceof Element)) return;

        if (t.closest('[data-action="close-modal"]')) {
            closeModal();
            return;
        }

        const overlay = t.closest('[data-action="modal-overlay"]');
        if (overlay && t === overlay) {
            closeModal();
        }
    }

    modal?.addEventListener('click', handleModalClick);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
    backdrop?.addEventListener('click', () => closeModal());

    imageInput?.addEventListener('change', (e) => {
        const file = e.target?.files?.[0];
        if (!previewWrapper || !previewImg) return;
        if (!file) {
            previewWrapper.classList.add('hidden');
            previewImg.src = '';
            return;
        }
        previewImg.src = URL.createObjectURL(file);
        previewWrapper.classList.remove('hidden');
    });

    initIconsAndUI();
}
