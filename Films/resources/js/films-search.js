import axios from "axios";
import { createIcons, icons } from 'lucide';

const searchInput = document.getElementById("searchInput");
const categorieSelect = document.getElementById("categorieSelect");
const filmsContainer = document.getElementById("filmsContainer");

function fetchFilms() {
    const search = searchInput.value;
    const categorie_id = categorieSelect.value;

    axios.get("/", { params: { search, categorie_id }, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => {
            filmsContainer.innerHTML = response.data;
            createIcons({ icons }); // Re-init icons for new content
        })
        .catch(error => console.error(error));
}


searchInput.addEventListener("input", fetchFilms);


categorieSelect.addEventListener("change", fetchFilms);
