<!-- Tabler Core -->
<!-- Libs JS -->
<script src="./dist/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
<script src="./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
<script src="./dist/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
<script src="./dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
<!-- Tabler Core -->
<script src="./dist/js/tabler.min.js?1692870487" defer></script>
<script src="./dist/js/demo.min.js?1692870487" defer></script>
{{-- Datatables --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Leaflet JS & CSS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- preview profile pic --}}
<script>
    document.querySelector("input[type='file']").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("previewImage").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
            // Define center coordinates
            var centerCoords = [10.67878697598803, 122.96234099560286];

            // Initialize the map
            var map = L.map('map', {
                center: centerCoords,
                zoom: 17.4,        // Set fractional zoom
                zoomSnap: 0.1,     // Allow fractional zoom levels
                zoomDelta: 0.1,    // Enable smooth zooming
                zoomControl: false,
                dragging: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                touchZoom: false,
                boxZoom: false,
                keyboard: false
            });

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add a marker at the center
        // L.marker(centerCoords).addTo(map)
        //     .bindPopup("<b>La Salle Bacolod</b><br>University of St. La Salle.")
        //     .openPopup();

            // Define custom boundary (traced area)
            var customBoundary = [
                [10.6797, 122.9610], // Point 1 la salle
                [10.6806, 122.9627], // Point 2 right corner
                [10.6797, 122.9635], // Point 2 right corner
                [10.6788, 122.9646], // Point 3
                [10.6783, 122.9649], // Point 3
                [10.6776, 122.9640], // Point 3
                [10.6765, 122.9627], // Point 4
                [10.6769, 122.9626], // Point 5
                [10.6775, 122.9618], // Point 6
                [10.6778, 122.9616], // Point 6
                [10.6779, 122.9611], // Point 6
                [10.6782, 122.9607], // Point 6 plus
                [10.6785, 122.9607], // Point 6 man
                [10.6790, 122.9609], // Point 6 creeck
                [10.6795, 122.9610]  // Closing point (same as first)
            ];

            // Add the custom border line (polyline for an open shape)
            L.polyline(customBoundary, {
                color: "green",   // Border color
                weight: 3,       // Border thickness
                dashArray: "10, 5" // Creates a dashed effect
            }).addTo(map).bindPopup("Custom Range Border");

            // Or use L.polygon() if you want a **closed area**
            L.polygon(customBoundary, {
                color: "green",
                fillColor: "#CCFFCC",
                fillOpacity: 0.2
            }).addTo(map).bindPopup("Custom Range Area");

            // Define multiple pin locations inside the range
            var pinLocations = [
                { lat: 10.6790, lng: 122.9622, title: "Pin 1" },
                { lat: 10.6792, lng: 122.9630, title: "Pin 2" },
                { lat: 10.6784, lng: 122.9638, title: "Pin 3" },
                { lat: 10.6778, lng: 122.9629, title: "Pin 4" },
                { lat: 10.6781, lng: 122.9615, title: "Pin 5" }
            ];

            // Define a custom red icon
            var redIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png', // Red marker image
                iconSize: [25, 41], // Size of the icon
                iconAnchor: [12, 41], // Anchor point of the icon
                popupAnchor: [1, -34] // Popup position
            });

            // Loop through each pin location and add a red marker
            pinLocations.forEach(function (location) {
                L.marker([location.lat, location.lng], { icon: redIcon }).addTo(map)
                    .bindPopup("<b>" + location.title + "</b><br>Inside the range.");
            });

        });



</script>
