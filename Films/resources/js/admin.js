import axios from 'axios';
import { createIcons, icons } from 'lucide';

const searchInput = document.getElementById('searchInput');
const categorySelect = document.getElementById('categorySelect');
const tableContainer = document.getElementById('tableContainer');

function fetchFilms() {
    const search = searchInput.value;
    const categorie_id = categorySelect.value;

    axios.get('/admin/films', {
        params: { search, categorie_id },
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(response => {
            const tableWrapper = document.getElementById('filmsTableWrapper');
            if (tableWrapper) {
                tableWrapper.innerHTML = response.data;
            }
            createIcons({ icons });
        })
        .catch(error => console.error(error));
}

if (searchInput) searchInput.addEventListener('input', fetchFilms);
if (categorySelect) categorySelect.addEventListener('change', fetchFilms);


const modal = document.getElementById('filmModal');
const backdrop = document.getElementById('modalBackdrop');
const modalContent = document.getElementById('modalContent');
const form = document.getElementById('filmForm');

window.openModal = function (mode = 'create', filmId = null) {
    form.reset();
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');

    const addTitle = form.getAttribute('data-add-title');
    const editTitle = form.getAttribute('data-edit-title');
    const storeUrl = form.getAttribute('data-store-url');

    document.getElementById('modalTitle').innerText = addTitle;
    form.action = storeUrl;

    if (mode === 'edit' && filmId) {
        document.getElementById('modalTitle').innerText = editTitle;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        form.action = `/admin/films/${filmId}`;

        axios.get(`/admin/films/${filmId}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => {
                const film = response.data.film;
                const filmCategories = response.data.categories;

                document.getElementById('titre').value = film.titre;
                document.getElementById('directeur').value = film.directeur;
                document.getElementById('description').value = film.description;

                if (film.image) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = `/storage/${film.image}`;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                }

                document.querySelectorAll('#filmForm input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = filmCategories.includes(parseInt(checkbox.value));
                });
            })
            .catch(error => console.error(error));
    }

    modal.classList.remove('hidden');
    backdrop.classList.remove('hidden');

    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        modalContent.classList.remove('opacity-0', 'scale-95');
        modalContent.classList.add('opacity-100', 'scale-100');
    }, 10);
};

window.editFilm = function (id) {
    window.openModal('edit', id);
};

window.closeModal = function () {
    backdrop.classList.add('opacity-0');
    modalContent.classList.remove('opacity-100', 'scale-100');
    modalContent.classList.add('opacity-0', 'scale-95');

    setTimeout(() => {
        modal.classList.add('hidden');
        backdrop.classList.add('hidden');
    }, 200);
};


document.addEventListener('click', function (e) {
    const link = e.target.closest('#filmsTableWrapper nav a');
    if (link) {
        e.preventDefault();
        const url = new URL(link.href);
        const search = searchInput.value;
        const categorie_id = categorySelect.value;
        const page = url.searchParams.get('page');

        axios.get('/admin/films', {
            params: { search, categorie_id, page },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => {
                const tableWrapper = document.getElementById('filmsTableWrapper');
                if (tableWrapper) {
                    tableWrapper.innerHTML = response.data;
                }
                createIcons({ icons });
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
            .catch(error => console.error(error));
    }
});

const imageInput = document.getElementById('image');
if (imageInput) {
    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
}

createIcons({ icons });
