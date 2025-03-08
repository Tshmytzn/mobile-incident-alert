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
                                                    src="" width="80" height="80" alt="Profile">
                                                <div class="col-auto"><a data-bs-target="#uploadProfilePic"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-outline-primary ms-3 ">Change
                                                        avatar</a></div>
                                            </div>
                                            <form id="update-profile-form" method="POST">
                                                @csrf

                                                <!-- User Information -->
                                                <h4 class="text-muted">User Information</h4>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="profile-name"
                                                            id="profile-name" placeholder="Enter your name" required
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="profile-email"
                                                            id="profile-email" placeholder="name@mail.com" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Contact Phone</label>
                                                        <input type="tel" class="form-control"
                                                            placeholder="09123456789" name="profile-number"
                                                            id="profile-number" required pattern="^09\d{9}$"
                                                            maxlength="11"
                                                            title="Phone number must start with 09 and be exactly 11 digits."
                                                            inputmode="numeric"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Address</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your address" name="profile-address"
                                                            id="profile-address">
                                                    </div>
                                                </div>

                                                <!-- Password Section -->
                                                <h4 class="mt-4 text-muted">Password</h4>
                                                <p class="small text-muted">You can set a new password for your account.
                                                </p>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#Userpassmodal">
                                                    <i class="bi bi-lock-fill me-2"></i> Set New Password
                                                </button>

                                                <!-- Save Changes Button -->
                                                <div class="card-footer mt-2 bg-light text-end">
                                                    @include('Administrator.components.button', [
                                                        'buttonWidth' => '',
                                                        'buttonLabel' => 'Save',
                                                        'buttonID' => 'update-profile-button',
                                                        'buttonSpan' => 'update-profile-button-span',
                                                        'buttonModal' => '',
                                                        'buttonFunction' => 'UpdateProfile',
                                                        'buttonFormID' => 'update-profile-form',
                                                        'buttonUrl' => '/user-profile-update',
                                                    ])
                                                </div>
                                        </div>
                                        </form>
                                        <!-- Emergency Contacts Tab -->
                                        <div class="tab-pane fade" id="usercontacts">
                                            <h2 class="mb-3">Emergency Contacts</h2>
                                            <form id="contact-form" method="post">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Contact Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Emergency contact name"
                                                            name="profile-contact-name" id="profile-contact-name"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Contact Phone</label>
                                                        <input type="tel" class="form-control"
                                                            placeholder="09123456789" name="profile-contact-number"
                                                            id="profile-contact-number" required pattern="^09\d{9}$"
                                                            maxlength="11"
                                                            title="Phone number must start with 09 and be exactly 11 digits."
                                                            inputmode="numeric"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                    </div>

                                                </div>
                                                <div class="mt-2 float-end">
                                                    @include('Administrator.components.button', [
                                                        'buttonWidth' => '',
                                                        'buttonLabel' => 'Save',
                                                        'buttonID' => 'update-contact-button',
                                                        'buttonSpan' => 'update-contact-button-span',
                                                        'buttonModal' => '',
                                                        'buttonFunction' => 'UpdateProfile',
                                                        'buttonFormID' => 'contact-form',
                                                        'buttonUrl' => '/user-contact-update',
                                                    ])
                                                </div>

                                            </form>

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
    <script src="{{ asset('js/user/UserProfile.js') }}"></script>

</body>

</html>
