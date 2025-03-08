var map; // Declare map globally
var incidentData = null;

async function GetIncidents() {
    try {
        incidentData = await GetRequest("/get-alert-for-responder");

        if (!incidentData || !Array.isArray(incidentData.data)) {
            console.error("Invalid data structure:", incidentData);
            return;
        }

        DisplayData(incidentData);
        DataTable(incidentData);
    } catch (error) {
        console.error("Error fetching incidents:", error);
    }
}


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
        dragging: true,
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
        role: element.role,
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
            .bindPopup(
                "<b> Name: " +
                    location.name +
                    " (" +
                    location.role +
                    ")" +
                    "</b><br>Address: " +
                    (location.address != null ? location.address : "") +
                    "<br>Number: " +
                    (location.phone_number != null
                        ? location.phone_number
                        : "") +
                    "<br>Emergency Contact: " +
                    (location.emergency_contact_phone != null
                        ? location.emergency_contact_phone
                        : "")
            );
    });
}

function DataTable(data) {
    const divNot = document.getElementById("user-info");
    divNot.innerHTML = "";

    data.data.forEach((item) => {
        // Create a new div for Bootstrap grid layout
        const cardWrapper = document.createElement("div");
        cardWrapper.className =
            "col-lg-4 col-md-6 col-12 d-flex justify-content-center"; // Responsive layout

        // Create card
        cardWrapper.innerHTML = `
            <div class="card m-2" style="width: 18rem;">
                <div class="card-header">
                    Emergency Information
                </div>
                <div class="card-body">
                    <h5 class="card-title">${item.name}</h5>
                    <p class="card-text"><strong>Emergency Type:</strong> ${
                        item.type
                    }</p>
                    <p class="card-text"><strong>Phone Number:</strong> ${
                        item.phone_number || "N/A"
                    }</p>
                    <p class="card-text"><strong>Emergency Contact:</strong> ${
                        item.emergency_contact_phone || "N/A"
                    }</p>
                </div>
                <button class="btn btn-success action-btn" onclick="confirmAction('${
                    item.id
                }')">Resolve</button>
            </div>
        `;

        // Append card to the container
        divNot.appendChild(cardWrapper);
    });
}


function confirmAction(id) {
    Swal.fire({
        title: "Are you sure?",
        text: `Are you sure you want to proceed?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, proceed!",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with the action (e.g., call a function or make an API request)
            console.log(`Action confirmed for ID: ${id}`);
            let formData = new FormData();

            formData.append("incident_id", id);

            // Get the CSRF token from the meta tag
            let csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            // Append CSRF token to the FormData
            formData.append("_token", csrfToken);

            sendRequest("POST", '/confirm-alert-for-responder', formData, function (error, response) {
                const responseMessage =
                    typeof response === "string"
                        ? JSON.parse(response)
                        : response;
                if (!responseMessage.status) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: responseMessage.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: responseMessage.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                     GetIncidents();
                }
            });

        } else {
            console.log("Action canceled");
        }
    });
}


$(document).ready(function () {
    GetIncidents();
});