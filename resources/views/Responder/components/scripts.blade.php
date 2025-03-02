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
<script src="{{ asset('js/RequestScript.js') }}"></script>
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

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize the map
        var map = L.map('map', {
            center: [10.6742, 122.9575],
            zoom: 20,
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

        // Add a marker for La Salle Bacolod
        L.marker([10.6742, 122.9575]).addTo(map)
            .bindPopup("<b>La Salle Bacolod</b><br>University of St. La Salle.")
            .openPopup();

        // Highlight the campus area (approximate boundary)
        var campusBoundary = [
            [10.6735, 122.9565],
            [10.6750, 122.9565],
            [10.6750, 122.9585],
            [10.6735, 122.9585]
        ];

        L.polygon(campusBoundary, {
            color: "green",
            fillColor: "#32CD32",
            fillOpacity: 0.3
        }).addTo(map).bindPopup("USLS Campus Area");
    });
</script> --}}
