const table = document.getElementById('films-table');

document.getElementById('search')?.addEventListener('input', (e) => {
    fetch(`/films?search=${e.target.value}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.text())
        .then(html => table.innerHTML = html);
});

document.getElementById('filmForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const form = e.target;

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(res => res.text())
        .then(html => {
            table.innerHTML = html;
            if (typeof HSOverlay !== 'undefined') {
                HSOverlay.close('#hs-slide-down-animation-modal');
            }
            form.reset();
            document.getElementById('success-msg').innerText = form.dataset.success;
        });
});