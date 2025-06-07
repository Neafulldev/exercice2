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
    function renderProfessionals(categorieId, specialiteId) {
        const params = new URLSearchParams();
        if (categorieId) params.append('categorie', categorieId);
        if (specialiteId) params.append('specialite', specialiteId);

        fetch(`/professionnels?${params.toString()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                resultDiv.innerHTML = html;
            })
            .catch(() => {
                resultDiv.innerHTML = '<p>Error loading professionals.</p>';
            });
    }

    // Events listeners on select
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

    renderProfessionals(categorieSelect.value, specialiteSelect.value);
});
