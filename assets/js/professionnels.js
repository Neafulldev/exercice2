document.addEventListener('DOMContentLoaded', () => {

    const categorieSelect = document.getElementById('categorie');
    const specialiteSelect = document.getElementById('specialite');
    const resultDiv = document.getElementById('result');

    // Render specialites
    function renderSpecialites(categorieId) {
        if (!categorieId) {
            specialiteSelect.innerHTML = '<option value="">-- Sélectionnez une catégorie --</option>';
            specialiteSelect.disabled = true;
            return;
        }

        fetch(`/api/specialites?categorie=${categorieId}`)
            .then(response => response.json())
            .then(data => {
                specialiteSelect.innerHTML = '<option value="">-- Sélectionnez une spécialité --</option>';
                data.forEach(speciality => {
                    const option = document.createElement('option');
                    option.value = speciality.id;
                    option.textContent = speciality.libelle;
                    specialiteSelect.appendChild(option);
                });
                specialiteSelect.disabled = false;
            })
            .catch(() => {
                specialiteSelect.innerHTML = '<option value="">Error loading specialities</option>';
                specialiteSelect.disabled = true;
            });
    }

    // Render professionnels
    function renderProfessionals(categorieId, specialiteId, page = 1) {
        const params = new URLSearchParams();
        if (categorieId) params.append('categorie', categorieId);
        if (specialiteId) params.append('specialite', specialiteId);
        if (page) params.append('page', page);

        fetch(`/professionnels?${params.toString()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                resultDiv.innerHTML = html;
            })
            .catch(() => {
                resultDiv.innerHTML = '<p>Error loading professionals.</p>';
            });
    }

    // Events listeners
    categorieSelect.addEventListener('change', () => {
        const categorieId = categorieSelect.value;
        renderSpecialites(categorieId);

        specialiteSelect.value = '';
        renderProfessionals(categorieId, '');
    });

    specialiteSelect.addEventListener('change', () => {
        const categorieId = categorieSelect.value;
        const specialiteId = specialiteSelect.value;
        renderProfessionals(categorieId, specialiteId);
    });

    if (!categorieSelect.value) {
        specialiteSelect.disabled = true;
    } else {
        renderSpecialites(categorieSelect.value);
    }

    document.addEventListener('click', (event) => {
        if (event.target.matches('.pagination a')) {
            event.preventDefault();
            const url = new URL(event.target.href);
            const page = url.searchParams.get('page');
            const categorieId = categorieSelect.value;
            const specialiteId = specialiteSelect.value;
            renderProfessionals(categorieId, specialiteId, page);
        }
    });

    renderProfessionals(categorieSelect.value, specialiteSelect.value);
});
