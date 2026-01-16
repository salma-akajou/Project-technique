import axios from 'axios';
import { createIcons, icons } from 'lucide';

// --- Elements ---
const searchInput = document.getElementById('searchInput');
const categorySelect = document.getElementById('categorySelect');
const filmsTableWrapper = document.getElementById('filmsTableWrapper');
const filmForm = document.getElementById('filmForm');
const filmModal = document.getElementById('filmModal');
const modalBackdrop = document.getElementById('modalBackdrop');
const modalContent = document.getElementById('modalContent');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const imagePreview = document.getElementById('imagePreview');

// --- 1. AJAX Fetch ---
const fetchFilms = (page = 1) => {
    axios.get('/admin/films', {
        params: {
            search: searchInput.value,
            categorie_id: categorySelect.value,
            page
        },
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(res => {
        filmsTableWrapper.innerHTML = res.data;
        createIcons({ icons });
    });
};

if (searchInput) searchInput.addEventListener('input', () => fetchFilms());
if (categorySelect) categorySelect.addEventListener('change', () => fetchFilms());

document.addEventListener('click', e => {
    const link = e.target.closest('#filmsTableWrapper nav a');
    if (link) {
        e.preventDefault();
        fetchFilms(new URL(link.href).searchParams.get('page'));
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});

// --- 2. Modal Logic ---
window.openModal = (mode = 'create', id = null) => {
    filmForm.reset();
    document.getElementById('methodField').innerHTML = id ? '<input type="hidden" name="_method" value="PUT">' : '';
    imagePreviewContainer.classList.add('hidden');

    document.getElementById('modalTitle').innerText = id ? filmForm.dataset.editTitle : filmForm.dataset.addTitle;
    filmForm.action = id ? `/admin/films/${id}` : filmForm.dataset.storeUrl;

    if (id) {
        axios.get(`/admin/films/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(({ data }) => {
                document.getElementById('titre').value = data.film.titre;
                document.getElementById('directeur').value = data.film.directeur;
                document.getElementById('description').value = data.film.description;
                if (data.film.image) {
                    imagePreview.src = `/storage/${data.film.image}`;
                    imagePreviewContainer.classList.remove('hidden');
                }
                filmForm.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                    cb.checked = data.categories.includes(parseInt(cb.value));
                });
            });
    }

    filmModal.classList.remove('hidden');
    modalBackdrop.classList.remove('hidden');
    setTimeout(() => {
        modalBackdrop.classList.remove('opacity-0');
        modalContent.classList.add('opacity-100', 'scale-100');
    }, 10);
};

window.editFilm = (id) => openModal('edit', id);

window.closeModal = () => {
    modalBackdrop.classList.add('opacity-0');
    modalContent.classList.remove('opacity-100', 'scale-100');
    setTimeout(() => {
        filmModal.classList.add('hidden');
        modalBackdrop.classList.add('hidden');
    }, 200);
};

// --- 3. Image Preview ---
const imageInput = document.getElementById('image');
if (imageInput) {
    imageInput.addEventListener('change', function () {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
}

createIcons({ icons });
