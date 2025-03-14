<!doctype html>
<html lang="en">

@include('Users.components.head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.5.0/turf.min.js"></script>
<style>
    .form-select option {
        font-weight: bold;
    }

    .form-select option:hover,
    .form-select:focus option:checked {
        background-color: #007A33 !important;
        color: white !important;
    }

    /* Make modal background more transparent */
    #modal-dialogs {
        display: flex;
        align-items: center;
        /* Centers content */
        justify-content: center;
    }

    /* Transparent modal with a green border */
    #modal-contents {
        background: rgba(0, 0, 0, 0.2);
        /* Slight transparency */
        border: 2px solid #007A33;
        /* Green border */
        box-shadow: none;
    }

    /* Adjust modal backdrop transparency */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.2) !important;
        /* More transparent */
    }

    /* Swipe container parent */
    #swipe-body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.1);
        /* Super transparent black */
        backdrop-filter: blur(3px);
        /* Slight blur for a glass effect */
    }

    /* Swipe Container */
    .swipe-container {
        position: relative;
        width: 300px;
        height: 60px;
        background: #e9ecef;
        border-radius: 30px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Swipe Button */
    .swipe-button {
        position: absolute;
        left: 125px;
        /* Start in the center */
        width: 50px;
        height: 50px;
        background: #007bff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        cursor: grab;
        transition: left 0.3s ease-out;
        user-select: none;
        /* Prevents text selection */
    }

    /* Swipe Text */
    .swipe-text {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 0 8px;
        user-select: none;
        /* Prevents text selection */
        pointer-events: none;
        /* Disables pointer interactions */
        cursor: default;
        /* Keeps the cursor normal */
    }

    .pulse-icon {
        color: #f9fd0d;
        animation: pulse 1s infinite alternate;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(1.2);
            opacity: 0.8;
        }
    }
    .scroll-container {
    max-height: 100%; /* Adjust height as needed */
    overflow-y: auto;
    padding-right: 10px; /* Prevent content from touching the scrollbar */
}

/* Hide scrollbar */
.scroll-container::-webkit-scrollbar {
    width: 0px;
    display: none;
}

.scroll-container {
    scrollbar-width: none; /* Firefox */
}
.modal {
    overflow: hidden; /* Hide scrollbar */
}

.modal-body {
    max-height: 100vh; /* Prevents scrolling on the entire screen */
    overflow-y: auto; /* Allows internal scrolling */
}

/* Hide scrollbar */
.modal-body::-webkit-scrollbar {
    width: 0px;
    display: none;
}

.modal-body {
    scrollbar-width: none; /* Firefox */
}
</style>

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        @include('HeartLoader')
        @include('Users.components.aside')
        @include('Users.components.header')

        <div class="page-wrapper">
            <div class="page-body py-4">
                <div class="container-xl">
                    <div class="row g-4">
                        <!-- Emergency Alert Section -->
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border-0 rounded-lg">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-stretch">
                                        <button
                                            class="btn btn-danger btn-lg flex-grow-1 rounded-start-pill fw-bold py-5"
                                            {{-- data-bs-target="#swipe" data-bs-toggle="modal" --}}
                                            style="font-size: 2.5rem; transition: 0.3s ease;" id="AlertBTN" onclick="sendAlertNow()">
                                            <span class="me-3 ms-4" id="alertSpan">Alert</span>
                                            <i class="bi bi-exclamation-triangle-fill fs-1" id="alerticonSpan"></i>
                                             <span id="countdown" style="display: none">00:30</span>
                                        </button>
                                        <button class="btn btn-warning btn-lg rounded-end-pill fw-bold py-5 px-4"
                                            data-bs-target="#viewAlert" data-bs-toggle="modal"
                                            style="font-size: 2rem; transition: 0.3s ease;" onclick="showAlert()">
                                            <i class="bi bi-lightning-fill fs-1 pulse-icon me-1"></i>
                                            <span id="countAlert" class="pulse-icon"></span>
                                        </button>
                                    </div>
                                    <h5 class="fw-bold text-danger mt-3">Emergency Alert</h5>
                                    <p class="text-muted">Tap to notify responders immediately</p>
                                </div>
                            </div>
                        </div>


                        <!-- Help Request Section -->
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border-0 rounded-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold text-dark">Request Help</h5>
                                    <p class="text-muted">Select the type of emergency:</p>
                                    <form id="send-alert-form" method="post">
                                        @csrf
                                        <!-- Emergency Type Dropdown -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-light"><i class="bi bi-list"></i></span>

                                            <select class="form-select p-3 rounded-3 shadow-sm border-0" name="type"
                                                id="emergencyType">
                                                <option selected value="">Select an emergency type</option>
                                                <option value="Medical">🚑 Medical</option>
                                                <option value="Security">🔒 Security</option>
                                                <option value="Fire">🔥 Fire</option>
                                                <option value="Disasters">🌪️ Disasters</option>
                                            </select required>

                                        </div>

                                        <!-- Submit Help Request Button -->
                                        <div class="d-grid">
                                            <button type="button" class="btn btn-success fw-bold py-3"
                                                onclick="SendManualAlert()" id="ManualAlertBtn">
                                                <i class="bi bi-send-fill me-2" id="ManualAlertIcon"></i> 
                                                <span id="ManualAlertSpan">Send Help Request</span>
                                                <span id="countdown2" style="display: none">00:30</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('Users.components.modals')
        @include('Users.components.footer')
    </div>

    @include('Users.components.scripts')
    <script src="{{ asset('js/user/UserDashboard.js') }}"></script>

</body>

</html>
