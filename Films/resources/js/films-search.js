import axios from "axios";

const searchInput = document.getElementById("searchInput");
const categorieSelect = document.getElementById("categorieSelect");
const filmsContainer = document.getElementById("filmsContainer");

function fetchFilms() {
    const search = searchInput.value;
    const categorie_id = categorieSelect.value;

    axios.get("/", { params: { search, categorie_id }, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => {
            filmsContainer.innerHTML = response.data;
        })
        .catch(error => console.error(error));
}


searchInput.addEventListener("input", fetchFilms);


categorieSelect.addEventListener("change", fetchFilms);
