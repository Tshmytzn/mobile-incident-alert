var map; // Declare map globally
var incidentData = null;

async function GetIncidents() {
    try {
        incidentData = await GetRequest("/get-incidents");

        if (!incidentData || !Array.isArray(incidentData.data)) {
            console.error("Invalid data structure:", incidentData);
            return;
        }

        DisplayData(incidentData);
    } catch (error) {
        console.error("Error fetching incidents:", error);
    }
}

setTimeout(() => {
    window.Echo.channel("alert-channel").listen("GetAlertEvent", (e) => {
        incidentData = e.data.original;
        DisplayData(incidentData);
    });
}, 200);

function DisplayData(incidentData) {
    if (map) {
        map.remove(); // Remove previous map instance
    }

    var centerCoords = [10.67878697598803, 122.96234099560286];

    // Initialize the map
    map = L.map("map", {
        center: centerCoords,
        zoom: 17.4,
        zoomSnap: 0.1,
        zoomDelta: 0.1,
        zoomControl: false,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        touchZoom: false,
        boxZoom: false,
        keyboard: false,
    });

    // Add OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
    }).addTo(map);

    // Define the custom boundary
    var customBoundary = [
        [10.6797, 122.961],
        [10.6806, 122.9627],
        [10.6797, 122.9635],
        [10.6788, 122.9646],
        [10.6783, 122.9649],
        [10.6776, 122.964],
        [10.6765, 122.9627],
        [10.6769, 122.9626],
        [10.6775, 122.9618],
        [10.6778, 122.9616],
        [10.6779, 122.9611],
        [10.6782, 122.9607],
        [10.6785, 122.9607],
        [10.679, 122.9609],
        [10.6795, 122.961],
    ];

    // Add the polygon border
    L.polygon(customBoundary, {
        color: "green",
        fillColor: "#CCFFCC",
        fillOpacity: 0.2,
    })
        .addTo(map)
        .bindPopup("Custom Range Area");
    // Process incident locations
    var pinLocations = incidentData.data.map((element, index) => ({
        lat: element.latitude,
        lng: element.longitude,
        name: element.name,
        role:element.role,
        address: element.address,
        phone_number: element.phone_number,
        emergency_contact_phone: element.emergency_contact_phone,
    }));
    // Define a red marker icon
    var redIcon = L.icon({
        iconUrl:
            "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
    });

    // Add markers
    pinLocations.forEach(function (location) {
        L.marker([location.lat, location.lng], { icon: redIcon })
            .addTo(map)
            .bindPopup("<b> Name: " + location.name + " (" + location.role +")"
                + "</b><br>Address: " + (location.address != null ? location.address : '')
                + "<br>Number: " + (location.phone_number!= null ? location.phone_number : '')
                + "<br>Emergency Contact: " + (location.emergency_contact_phone != null ? location.emergency_contact_phone : '')
            );
    });
}

// Run after document is fully loaded
$(document).ready(function () {
    GetIncidents();
});
