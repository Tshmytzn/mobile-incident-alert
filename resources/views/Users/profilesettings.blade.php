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
                                Profile Settings
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="card shadow-sm">
                            <div class="row g-0">
                                <!-- Sidebar Navigation -->
                                <div class="col-12 col-md-3 border-end bg-light p-3">
                                    <h4 class="subheader">Settings</h4>
                                    <div class="list-group list-group-flush" id="settingsTabs">
                                        <a href="#useraccount" class="list-group-item list-group-item-action active"
                                            data-bs-toggle="tab">
                                            <i class="bi bi-person-circle me-2"></i> My Account
                                        </a>
                                        <a href="#usercontacts" class="list-group-item list-group-item-action"
                                            data-bs-toggle="tab">
                                            <i class="bi bi-telephone me-2"></i> Emergency Contacts
                                        </a>
                                    </div>
                                </div>

                                <!-- Main Content -->
                                <div class="col-12 col-md-9 d-flex flex-column">
                                    <div class="tab-content p-4">
                                        <!-- My Account Tab -->
                                        <div class="tab-pane fade show active" id="useraccount">
                                            <h2 class="mb-3">My Account</h2>

                                            <!-- Profile Picture -->
                                            <div class="d-flex align-items-center mb-4">
                                                <img id="profilePicPreview" class="rounded-circle shadow-sm border"
                                                    src="./static/avatars/000m.jpg" width="80" height="80"
                                                    alt="Profile">
                                                <div class="col-auto"><a data-bs-target="#uploadProfilePic"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-outline-primary ms-3 ">Change
                                                        avatar</a></div>
                                            </div>

                                            <!-- User Information -->
                                            <h4 class="text-muted">User Information</h4>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control"
                                                        placeholder="name@mail.com">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="+63 912 345 6789">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your address">
                                                </div>
                                            </div>

                                            <!-- Password Section -->
                                            <h4 class="mt-4 text-muted">Password</h4>
                                            <p class="small text-muted">You can set a new password for your account.</p>
                                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#newpass">
                                                <i class="bi bi-lock-fill me-2"></i> Set New Password
                                            </button>

                                            <!-- Save Changes Button -->
                                            <div class="card-footer mt-2 bg-light text-end">
                                                <button class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                                    </svg> Save Changes</button>
                                            </div>
                                        </div>

                                        <!-- Emergency Contacts Tab -->
                                        <div class="tab-pane fade" id="usercontacts">
                                            <h2 class="mb-3">Emergency Contacts</h2>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Contact Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Emergency contact name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Contact Phone</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="+63 912 345 6789">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary mt-3">
                                                <i class="bi bi-check-circle me-2"></i> Save Contact
                                            </button>
                                        </div>
                                    </div>
                                </div> <!-- End of Main Content -->
                            </div>
                        </div>
                    </div>
                </div>

                @include('Users.components.modals')
                @include('Administrator.components.footer')
            </div>
            @include('Users.components.footer')
        </div>
    </div>
    @include('Users.components.scripts')

</body>

</html>
