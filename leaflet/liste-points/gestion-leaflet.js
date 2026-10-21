// 1. Initialisation de la carte
        const map = L.map('map');
// 2. Ajout du fond cartographique OpenStreetMap
        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }
        ).addTo(map);
// 3. Création d'un groupe de marqueurs
        const markers = L.featureGroup().addTo(map);
// 4. Lecture du fichier CSV
        Papa.parse('points.csv', {
            download: true,
            header: true,
            skipEmptyLines: true,
            complete: function(results) {
                let nombrePoints = 0;
// 5. Parcours de chaque ligne du CSV
                results.data.forEach(function(ligne) {
    // Extraction des coordonnées
                    const latitude = Number(ligne.latitude);
                    const longitude = Number(ligne.longitude);

    // Vérification des coordonnées
                    if (
                        !Number.isFinite(latitude) ||
                        !Number.isFinite(longitude) ||
                        latitude < -90 ||
                        latitude > 90 ||
                        longitude < -180 ||
                        longitude > 180 ||
                        ligne.nom.trim() === ''
                    ) {
                        console.warn(
                            'Ligne ignorée : coordonnées ou nom invalides',
                            ligne
                        );
                        return;
                    }

    // 6. Création du marqueur
                    const marker = L.marker([
                        latitude,
                        longitude
                    ]);

    // 7. Création de la fenêtre contextuelle
                    const contenuPopup = `
                        <strong>${escapeHTML(ligne.nom)}</strong><br>
                        Ville : ${escapeHTML(ligne.ville)}<br>
                        ${escapeHTML(ligne.description)}
                        <img src="${ligne.image}" width="100%">
                    `;
                    marker.bindPopup(contenuPopup);
    // 8. Ajout du marqueur à la carte
                    marker.addTo(markers);
                    nombrePoints++;
                });
    // 9. Ajustement automatique du cadrage
                if (nombrePoints > 0) {
                    map.fitBounds(markers.getBounds(), {
                        padding: [30, 30],
                        maxZoom: 15
                    });
                    document.getElementById('message').textContent =
                        nombrePoints + ' point(s) affiché(s).';
                } else {
                    map.setView([46.6, 2.5], 6);
                    document.getElementById('message').textContent =
                        'Aucun point valide à afficher.';
                }
                if (results.errors.length > 0) {
                    console.warn(
                        'Erreurs de lecture du CSV :',
                        results.errors
                    );
                }
            },
            error: function(error) {
                document.getElementById('message').textContent =
                    'Impossible de charger points.csv. Vérifiez le serveur et le chemin du fichier.';
                console.error(error);
            }
        });
        // Échappement HTML des données du CSV
        function escapeHTML(value) {
            return String(value ?? '').replace(/[&<>"']/g, function(caractere) {
                const correspondances = {
                    '&': '&amp;',
                    '"': '&quot;',
                    "'": '&#39;'
                };
                return correspondances[caractere];
            });
        }
