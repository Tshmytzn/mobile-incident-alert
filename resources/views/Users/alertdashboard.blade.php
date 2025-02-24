<!doctype html>
<html lang="en">

@include('Users.components.head')
<style>
    .form-select option {
        font-weight: bold;
    }

    .form-select option:hover,
    .form-select:focus option:checked {
        background-color: #007A33 !important;
        color: white !important;
    }
</style>

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

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
                                    <button class="btn btn-danger btn-lg w-100 rounded-pill fw-bold py-5"
                                        style="font-size: 2.5rem; transition: 0.3s ease;">
                                        <span class="me-3">Alert</span>
                                        <i class="bi bi-exclamation-triangle-fill fs-1"></i>
                                    </button>
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

                                    <!-- Emergency Type Dropdown -->
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-light"><i class="bi bi-list"></i></span>

                                        <select class="form-select p-3 rounded-3 shadow-sm border-0" id="emergencyType">
                                            <option selected disabled>Select an emergency type</option>
                                            <option value="medical">🚑 Medical</option>
                                            <option value="security">🔒 Security</option>
                                            <option value="fire">🔥 Fire</option>
                                        </select>

                                    </div>

                                    <!-- Submit Help Request Button -->
                                    <div class="d-grid">
                                        <button class="btn btn-success fw-bold py-3" onclick="sendHelpRequest()">
                                            <i class="bi bi-send-fill me-2"></i> Send Help Request
                                        </button>
                                    </div>
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
</body>

</html>
