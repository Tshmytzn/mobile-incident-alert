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

<script>

let isAlertShown = false;

function playMusic() {
    var audio = document.getElementById("myAudio");

    // Try to play the audio
    audio.play().then(() => {
        
    }).catch(function (error) {
        console.error("Error playing audio:", error);

        if (error.name === 'NotAllowedError'  && !isAlertShown) {
            isAlertShown = true;
            // Show SweetAlert message to the user
            Swal.fire({
                title: 'Notification Blocked!',
                text: 'Click anywhere on the screen to get updates.',
                icon: 'warning',
                confirmButtonText: 'Got it!',
                willClose: () => {
                    // Add click listener after the alert is closed
                    window.addEventListener('click', function() {

                        isAlertShown = false;
                        // Attempt to play the audio on user click
                        audio.play().catch(function (error) {
                            console.error("Error playing audio after click:", error);
                        });
                    });
                }
            });
        }
    });
}

function stopMusic() {
    var audio = document.getElementById("myAudio");

    // Pause the audio and reset to the beginning
    if (audio) {
        audio.pause();
        audio.currentTime = 0; // Reset the audio playback to the start
        console.log("Audio stopped.");
    }
}

var incidentData = null;

async function GetIncidents() {
    try {
        incidentData = await GetRequest("/get-incidents");

        if (!incidentData || !Array.isArray(incidentData.data)) {
            console.error("Invalid data structure:", incidentData);
            return;
        }
        notificationUpdate(incidentData);
        if (typeof DisplayData === "function") {
        DisplayData(incidentData);
        }
        
    } catch (error) {
        console.error("Error fetching incidents:", error);
    }
}

setInterval(() => {
    GetIncidents();
    if (typeof DisplayData === "function") {
        DisplayData(incidentData);
    }
    if (typeof DisplayData === "function") {
        DataTable();
    }
    notificationUpdate(incidentData);
}, 10000); // Fetch every 10 seconds

function notificationUpdate(){
    const notification = incidentData.data.filter(item => item.status === "Pending");
    console.log(notification)
        const notIcon = document.getElementById('notifications-count');
        if (notification && Array.isArray(notification) && notification.length > 0) {
            playMusic();  // Play music when data is received
            notIcon.style.display = 'block';  // Show the icon
            notIcon.textContent = notification.length;

            const divNot = document.getElementById('div-not');
            divNot.innerHTML = '';
            notification.forEach(item => {
            const newDiv = document.createElement('div');
            newDiv.classList.add('list-group-item');
            
            newDiv.innerHTML = `
                <div class="row align-items-center">
                <div class="col text-truncate">
                    <span class="text-body d-block">Name: ${item.name} (${item.role})</span>
                    <div class="d-block text-secondary text-truncate mt-n1">
                    Emergency Type: ${item.type}
                    </div>
                </div>
                </div>
            `;
            
            divNot.appendChild(newDiv); // Append the new div to the div-not
            });

        } else {
            console.log(notification)
            notIcon.style.display = 'none';  // Hide the icon
            notIcon.textContent = 0;
            console.log("Data is empty");
            stopMusic();
            // Handle empty data scenario
        }
        console.log(notification)
}

$(document).ready(function () {
    GetIncidents();
});
</script>
