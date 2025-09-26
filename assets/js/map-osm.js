
let map = null;
let marker = null;
let circle = null;
let timeout = null;
let inputLokasi = null;
let mapInitialized = false;

function renderUlangMap(){

  if (!mapInitialized) {
            initMapOnce();   // jalanin sekali aja
            mapInitialized = true;
        } else {
            setTimeout(() => {
                map.invalidateSize(); // biar canvas nge-resize ulang
            }, 200);
        }
  
}

function initMapOnce() {
    
map = L.map('map').setView([0, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap'
    }).addTo(map);

    
   inputLokasi = document.getElementById('locationInput');

    inputLokasi.addEventListener('input', function(e) {
      const value = e.target.value.trim();
      if (timeout) clearTimeout(timeout);
      timeout = setTimeout(() => {
        if (value.length < 3) return;

        const coordPattern = /^-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?$/;
        if (coordPattern.test(value)) {
          const [lat, lon] = value.split(',').map(parseFloat);
          updateMap(lat, lon, `Koordinat: ${lat}, ${lon}`);
        } else {
          fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(value)}`)
            .then(res => res.json())
            .then(data => {
              if (data.length === 0) return alert('Lokasi tidak ditemukan!');
              const lat = parseFloat(data[0].lat);
              const lon = parseFloat(data[0].lon);
              updateMap(lat, lon, data[0].display_name);
            });
        }
      }, 600);
    });

}

    function updateMap(lat, lon, label) {

      $('#lat-checkpoint').val(lat);
      $('#long-checkpoint').val(lon);

      map.setView([lat, lon], 15);

      if (marker) map.removeLayer(marker);
      if (circle) map.removeLayer(circle);

      marker = L.marker([lat, lon], { draggable: true }).addTo(map).bindPopup(label).openPopup();
      circle = L.circle([lat, lon], {
        color: 'green',
        fillColor: '#00ff0055',
        fillOpacity: 0.4,
        radius: 100
      }).addTo(map);

      // Event saat marker dipindah
      marker.on('dragend', function(e) {
        const pos = marker.getLatLng();
        updatePositionInput(pos.lat, pos.lng);
        updateCircle(pos.lat, pos.lng);
      });
    }

    function updatePositionInput(lat, lon) {
      fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
        .then(res => res.json())
        .then(data => {
          if (data && data.display_name) {
            inputLokasi.value = data.display_name;
            marker.bindPopup(data.display_name).openPopup();
          } else {
            const coords = `${lat.toFixed(6)}, ${lon.toFixed(6)}`;
            inputLokasi.value = coords;
            marker.bindPopup(coords).openPopup();
          }
        })
        .catch(() => {
          const coords = `${lat.toFixed(6)}, ${lon.toFixed(6)}`;
          inputLokasi.value = coords;
          marker.bindPopup(coords).openPopup();
        });
    }

    function updateCircle(lat, lon) {
      if (circle) {
        circle.setLatLng([lat, lon]);
      }
    }

