document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('filmModal');


    document.getElementById('openModal')?.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    document.getElementById('closeModal')?.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('films-table');

    searchInput?.addEventListener('keyup', () => {
        const query = searchInput.value;

        fetch(`/films?search=${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.text()) 
            .then(data => {
                tableBody.innerHTML = data; 
            });
    });
});
