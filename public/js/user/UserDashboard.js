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
let heartLoader = document.getElementById("overlay-mia");
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
        } else {
        }
    });
}


// Function to check if the user's location is inside the defined boundary
function isInsideCustomBoundary(userLat, userLng) {
    var userPoint = L.latLng(userLat, userLng); // test current location

    var customBoundary = [
         [10.6797, 122.961], // Point 1 la salle
         [10.6806, 122.9627], // Point 2 right corner
         [10.6797, 122.9635], // Point 2 right corner
         [10.6788, 122.9646], // Point 3
         [10.6783, 122.9649], // Point 3
         [10.6776, 122.964], // Point 3
         [10.6765, 122.9627], // Point 4
         [10.6769, 122.9626], // Point 5
         [10.6775, 122.9618], // Point 6
         [10.6778, 122.9616], // Point 6
         [10.6779, 122.9611], // Point 6
         [10.6782, 122.9607], // Point 6 plus
         [10.6785, 122.9607], // Point 6 man
         [10.679, 122.9609], // Point 6 creeck
         [10.6795, 122.961], // Closing point (same as first)
     ];

    // Convert customBoundary to a Leaflet polygon
    var boundaryPolygon = L.polygon(customBoundary);

    // Check if the user's location is inside the boundary
    return boundaryPolygon.getBounds().contains(userPoint);
}

// Function to get user's current location
async function checkUserLocation() {
    return new Promise((resolve) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    // var userLat = 10.678985;
                    // var userLng = 122.96208;

                    if (isInsideCustomBoundary(userLat, userLng)) {
                        let formData = new FormData();
                        formData.append("lat", userLat);
                        formData.append("lng", userLng);
                        let csrfToken = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content");
                        formData.append("_token", csrfToken);
                        
                        sendRequest("POST", "/user-send-alert", formData, function (error, response) {
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
                                    heartLoader.style.display = "none";
                                    resolve();
                                } else {
                                    GetActiveAlert();
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "success",
                                        title: responseMessage.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                    heartLoader.style.display = "none";
                                    resolve();
                                }
                            }
                        );

                    } else {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "You're outside La Salle Bacolod campus.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        heartLoader.style.display = "none";
                        resolve();
                    }
                },
                function (error) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Error getting location: " + error.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    heartLoader.style.display = "none";
                    resolve();
                }
            );
        } else {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Geolocation is not supported by your browser.",
                showConfirmButton: false,
                timer: 1500,
            });
            heartLoader.style.display = "none";
            resolve();
        }
    });
}

function SendManualAlert() {
    let typeVal = document.getElementById("emergencyType").value;
    if (typeVal.trim() == "") {
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Select Alert Type",
            showConfirmButton: false,
            timer: 1500,
        });
        return;
    }
    heartLoader.style.display = "flex";
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    // var userLat = position.coords.latitude;
                    // var userLng = position.coords.longitude;

                    var userLat = 10.678985;
                    var userLng = 122.96208;

                    if (isInsideCustomBoundary(userLat, userLng)) {
                        let formData = new FormData();
                        formData.append("lat", userLat);
                        formData.append("lng", userLng);
                        let csrfToken = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content");
                        formData.append("type", typeVal);
                        formData.append("_token", csrfToken);

                        sendRequest(
                            "POST",
                            "/user-send-manual-alert",
                            formData,
                            function (error, response) {
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
                                    heartLoader.style.display = "none";
                                } else {
                                    GetActiveAlert();
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "success",
                                        title: responseMessage.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                    });
                                    heartLoader.style.display = "none";
                                    document.getElementById(
                                        "emergencyType"
                                    ).value = "";
                                }
                            }
                        );
                    } else {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "❌ You are OUTSIDE the custom range.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        heartLoader.style.display = "none";
                        resolve();
                    }
                },
                function (error) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Error getting location: " + error.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    heartLoader.style.display = "none";
                }
            );
        }
}
let alertData = null;
async function GetActiveAlert(){
   const alert = await GetRequest("/user-get-active-alert");
   document.getElementById("countAlert").textContent = alert.data.length;
   alertData = alert.data;
}

function showAlert() {
    const divNot = document.getElementById("card-to-show");
    divNot.innerHTML = "";
    alertData.forEach((item) => {
        // Create a new div element
        const newDiv = document.createElement("div");

        const responderName = item.responder_name?.trim()
            ? item.responder_name
            : "No Responder";
        // Set the innerHTML of the new div
        newDiv.innerHTML = `
            <div class="col-12">
                            <div class="card border shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Type: ${
                                        item.type
                                    }</h5>
                                    <p class="card-text"><strong>Responder:</strong> ${responderName}</p>
                                    <p class="card-text"><strong>Date:</strong> ${
                                        item.reported_at
                                    }</p>
                                    <p class="card-text"><strong>Status:</strong> <span class="text-white ${
                                        item.status == "In Progress"
                                            ? "badge bg-warning"
                                            : "badge bg-success"
                                    }">${item.status}</span></p>
                                </div>
                            </div>
                        </div>
        `;

        // Append the new div to the div-not
        divNot.appendChild(newDiv);
    });
}

$(document).ready(function () {
    GetActiveAlert();
});