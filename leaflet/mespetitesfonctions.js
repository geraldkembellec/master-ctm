function loadLeafletMap(){
		const lien = "https://www.pantheonsorbonne.fr/";
	    /* je centre la carte sur Paris coordonnées 48.8271, 2.3646 avec un zoom 15 */
		const map = L.map('map').setView([48.8271, 2.3646], 15);
		const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
	 	/* Je personnalise l'épingle avec une image en HTML, un lien et du texte */
		const marker = L.marker([48.8271, 2.3646]).addTo(map)
			.bindPopup('<img src="https://upload.wikimedia.org/wikipedia/fr/4/42/CentrePMF_Paris1.jpg" width="100%"><a href="https://www.pantheonsorbonne.fr/"><strong>Université PARIS 1</strong></a><br>Site PMF (Tolbiac).').openPopup();
	}


	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(`You clicked the map at ${e.latlng.toString()}`)
			.openOn(map);
	}

	map.on('click', onMapClick);
