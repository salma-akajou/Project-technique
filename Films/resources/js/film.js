document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('filmModal');
    const form = document.getElementById('filmForm');
    const table = document.getElementById('films-table');
    const search = document.getElementById('search');
    const msg = document.getElementById('success-msg');

    // 1. Modale
    document.getElementById('openModal')?.addEventListener('click', () => modal.style.display = 'block');
    document.getElementById('closeModal')?.addEventListener('click', () => modal.style.display = 'none');

    // 2. Recherche AJAX
    search?.addEventListener('input', () => {
        fetch(`/films?search=${search.value}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.text())
            .then(html => table.innerHTML = html);
    });

    // 3. Formulaire AJAX
    form?.addEventListener('submit', e => {
        e.preventDefault();
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.text())
            .then(html => {
                table.innerHTML = html;
                modal.style.display = 'none';
                form.reset();
                msg.innerText = form.dataset.success; 
            });
    });
});
