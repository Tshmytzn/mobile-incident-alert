
// Cache DOM elements
let heartLoader = document.getElementById("overlay-mia");
let emergencyTypeInput = document.getElementById("emergencyType");
let countAlert = document.getElementById("countAlert");
let cardToShow = document.getElementById("card-to-show");
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

// Predefine the polygon boundary to avoid re-creating it
const customBoundary = [
    [10.6797, 122.961], [10.6806, 122.9627], [10.6797, 122.9635], [10.6788, 122.9646], 
    [10.6783, 122.9649], [10.6776, 122.964], [10.6765, 122.9627], [10.6769, 122.9626], 
    [10.6775, 122.9618], [10.6778, 122.9616], [10.6779, 122.9611], [10.6782, 122.9607], 
    [10.6785, 122.9607], [10.679, 122.9609], [10.6795, 122.961]
];
const boundaryPolygon = L.polygon(customBoundary);

// Check if user is inside boundary
function isInsideCustomBoundary(userLat, userLng) {
    return boundaryPolygon.getBounds().contains(L.latLng(userLat, userLng));
}

// Function to handle user location and process alert
async function checkUserLocation() {
    if (!navigator.geolocation) {
        showError("Geolocation is not supported by your browser.");
        return;
    }
    startCountdown();
    return new Promise((resolve) => {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                let userLat = position.coords.latitude;
                let userLng = position.coords.longitude;

                if (isInsideCustomBoundary(userLat, userLng)) {
                    sendAlert(userLat, userLng, "/user-send-alert", resolve);
                } else {
                    showError("You're outside La Salle Bacolod campus.");
                    resolve();
                }
            },
            (error) => {
                showError("Error getting location: " + error.message);
                resolve();
            }
        );
    });
}

// Unified function to send alerts
function sendAlert(lat, lng, url, resolve, type = "") {
    let formData = new FormData();
    formData.append("lat", lat);
    formData.append("lng", lng);
    formData.append("_token", csrfToken);
    if (type) formData.append("type", type);

    sendRequest("POST", url, formData, (error, response) => {
        const res = typeof response === "string" ? JSON.parse(response) : response;
        heartLoader.style.display = "none";

        if (!res.status) {
            showError(res.message);
        } else {
            GetActiveAlert();
            showSuccess(res.message);
            if (type) emergencyTypeInput.value = "";
        }

        if (resolve) resolve();
    });
}

// Send alert confirmation
function sendAlertNow() {
    Swal.fire({
        title: "Are you sure?",
        text: "Click Yes to confirm or No to cancel.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            heartLoader.style.display = "flex";
            checkUserLocation();
        }
    });
}

// Send manual alert
function SendManualAlert() {
    let typeVal = emergencyTypeInput.value.trim();
    if (!typeVal) {
        showError("Select Alert Type");
        return;
    }

    heartLoader.style.display = "flex";
    startCountdown();
    if (!navigator.geolocation) {
        showError("Geolocation is not supported by your browser.");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        (position) => {
            // let userLat = position.coords.latitude;
            // let userLng = position.coords.longitude;

            let userLat = 10.678985;
            let userLng = 122.96208;

            if (isInsideCustomBoundary(userLat, userLng)) {
                sendAlert(userLat, userLng, "/user-send-manual-alert", null, typeVal);
            } else {
                showError("❌ You are OUTSIDE the custom range.");
            }
        },
        (error) => {
            showError("Error getting location: " + error.message);
        }
    );
}

// Display toast messages
function showError(message) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
    heartLoader.style.display = "none";
}

function showSuccess(message) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

// Get active alerts (Debounced)
let alertData = null;
const GetActiveAlert = debounce(async function () {
    const alert = await GetRequest("/user-get-active-alert");
    countAlert.textContent = alert.data.length;
    alertData = alert.data;
}, 300);

// Function to display alerts
function showAlert() {
    cardToShow.innerHTML = "";
    const fragment = document.createDocumentFragment();

    alertData.forEach((item) => {
        const newDiv = document.createElement("div");
        const responderName = item.responder_name?.trim() ? item.responder_name : "No Responder";

        newDiv.innerHTML = `
            <div class="col-12">
                <div class="card border shadow">
                    <div class="card-body">
                        <h5 class="card-title">Type: ${item.type}</h5>
                        <p class="card-text"><strong>Responder:</strong> ${responderName}</p>
                        <p class="card-text"><strong>Date:</strong> ${item.reported_at}</p>
                        <p class="card-text"><strong>Status:</strong> 
                            <span class="text-white ${item.status === "In Progress" ? "badge bg-warning" : "badge bg-success"}">
                                ${item.status}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        `;
        fragment.appendChild(newDiv);
    });

    cardToShow.appendChild(fragment);
}

// Debounce function to optimize performance
function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}
let AlertSpan = document.getElementById("alertSpan");
let AlertIcon = document.getElementById("alerticonSpan");
let AlertButton = document.getElementById("AlertBTN");

let ManualAlertBtn = document.getElementById("ManualAlertBtn");
let ManualAlertIcon = document.getElementById("ManualAlertIcon");
let ManualAlertSpan = document.getElementById("ManualAlertSpan");

function startCountdown() {
    localStorage.setItem("checkTmer", "true");
    let timer = 30;
    const countdownElement = document.getElementById("countdown");
    countdownElement.style.display = "flex";
    AlertSpan.style.display = "none";
    AlertIcon.style.display = "none";
    AlertButton.disabled = true;

    const countdownElement2 = document.getElementById("countdown2");
    countdownElement2.style.display = "flex";

    ManualAlertSpan.style.display = "none";
    ManualAlertIcon.style.display = "none";
    ManualAlertBtn.disabled = true;

    const interval = setInterval(() => {
        let minutes = Math.floor(timer / 60);
        let seconds = timer % 60;

        // Format time as MM:SS
        countdownElement.textContent =
            String(minutes).padStart(2, "0") +
            ":" +
            String(seconds).padStart(2, "0");

        countdownElement2.textContent =
            String(minutes).padStart(2, "0") +
            ":" +
            String(seconds).padStart(2, "0");

        if (timer === 0) {
            clearInterval(interval);
            countdownElement.style.display = "none";
            AlertSpan.style.display = "flex";
            AlertIcon.style.display = "flex";
            AlertButton.disabled = false;

            countdownElement2.style.display = "none";
            ManualAlertSpan.style.display = "flex";
            ManualAlertIcon.style.display = "flex";
            ManualAlertBtn.disabled = false;
            localStorage.setItem("checkTmer", "false");
        } else {
            timer--;
        }
    }, 1000);
}

// Load active alerts on page load
$(document).ready(function () {
    GetActiveAlert();
    let check = localStorage.getItem("checkTmer");
    if(check){
        startCountdown();
    }
});
