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
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

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

<script src="{{ asset('js/RequestScript.js') }}"></script>