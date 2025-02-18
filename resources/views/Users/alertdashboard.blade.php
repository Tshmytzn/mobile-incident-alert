<!doctype html>

<html lang="en">

@include('Users.components.head')

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('Users.components.aside')
        @include('Users.components.header')

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Dashboard
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    <div class="col-12">
                        <div class="row row-cards">
                            <!-- Emergency Button Section -->
                            <div class="col-sm-12 col-lg-6">
                                <div class="card card-sm">
                                    <div class="card-body text-center">
                                        <div class="row align-items-center m-5">
                                            <!-- Emergency Button Icon -->
                                            <button class="btn btn-danger btn-lg w-100 rounded-pill"
                                                style="font-size: 2rem; padding: 1.5rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); transition: box-shadow 0.3s ease;">
                                                <span class="me-3">Alert</span>

                                                <!-- Larger SVG Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-alert-hexagon">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                                    <path d="M12 8v4" />
                                                    <path d="M12 16h.01" />
                                                </svg>
                                            </button>

                                        </div>

                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Emergency Alert
                                            </div>
                                            <div class="text-secondary">
                                                Tap to send an alert to responders
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Multidisciplinary Help Request Section -->
                            <div class="col-sm-12 col-lg-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="font-weight-medium">Request Help</h5>
                                                <p class="text-secondary">Select the type of emergency:</p>
                                            </div>

                                            <!-- Emergency Type Dropdown -->
                                            <div class="col-12">
                                                <select class="form-select" id="emergencyType">
                                                    <option selected disabled>Select an emergency type</option>
                                                    <option value="medical">Medical</option>
                                                    <option value="security">Security</option>
                                                    <option value="fire">Fire</option>
                                                </select>
                                            </div>

                                            <!-- Submit Help Request Button -->
                                            <div class="col-12 mt-3 text-center">
                                                <button class="btn btn-success" onclick="sendHelpRequest()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 3v18l7 -7l-7 -7z" />
                                                    </svg>
                                                    Send Help Request
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('Users.components.footer')
        </div>
    </div>
    @include('Users.components.scripts')

</body>

</html>
