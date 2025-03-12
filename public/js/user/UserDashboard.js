// const swipeBtn = document.getElementById("swipeBtn");
// const container = document.querySelector(".swipe-container");
// let isDragging = false,
//     startX = 0,
//     currentX = 0,
//     initialLeft = 125;

// swipeBtn.addEventListener("mousedown", startDrag);
// swipeBtn.addEventListener("touchstart", startDrag);

// function startDrag(e) {
//     isDragging = true;
//     startX = e.touches ? e.touches[0].clientX : e.clientX;
//     document.addEventListener("mousemove", moveDrag);
//     document.addEventListener("mouseup", endDrag);
//     document.addEventListener("touchmove", moveDrag);
//     document.addEventListener("touchend", endDrag);
// }

// function moveDrag(e) {
//     if (!isDragging) return;
//     currentX = (e.touches ? e.touches[0].clientX : e.clientX) - startX;
//     let newLeft = initialLeft + currentX;

//     if (newLeft <= 5) {
//         swipeBtn.style.left = "5px";
//         container.style.background = "#dc3545"; // Red for cancel
//         swipeBtn.innerHTML = "✖";
//     } else if (newLeft >= 245) {
//         swipeBtn.style.left = "245px";
//         container.style.background = "#28a745"; // Green for unlock
//         swipeBtn.innerHTML = "✔";
//     } else {
//         swipeBtn.style.left = `${newLeft}px`;
//         container.style.background = "#e9ecef";
//         swipeBtn.innerHTML = "↔";
//     }
// }

// async function endDrag() {
//     isDragging = false;
//     let finalLeft = parseInt(swipeBtn.style.left);

//     if (finalLeft <= 5) {
//         $("#swipe").modal("hide");
//     } else if (finalLeft >= 245) {
//         await checkUserLocation();
//         $("#swipe").modal("hide");
//     }

//     swipeBtn.style.left = "125px"; // Reset to center
//     swipeBtn.innerHTML = "↔";
//     container.style.background = "#e9ecef";
//     document.removeEventListener("mousemove", moveDrag);
//     document.removeEventListener("mouseup", endDrag);
//     document.removeEventListener("touchmove", moveDrag);
//     document.removeEventListener("touchend", endDrag);
// }
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

// Load active alerts on page load
$(document).ready(function () {
    GetActiveAlert();
});
