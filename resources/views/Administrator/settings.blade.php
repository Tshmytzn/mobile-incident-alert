<!doctype html>

<html lang="en">

@include('Administrator.components.head')

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('Administrator.components.aside')
        @include('Administrator.components.header')

        <div class="page-wrapper">
            <!-- Page header -->
            {{-- <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Settings
                            </h2>
                        </div>

                    </div>
                </div>
            </div> --}}
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-sm rounded-3">
                                <div class="card-header bg-light text-center py-3">
                                    <h3 class="mb-0">My Account Settings</h3>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Avatar Section -->
                                    <div class="text-center mb-4">
                                        <img class="rounded-circle border" id="profilePicPreview"
                                            width="100" height="100" alt="User Avatar">
                                        <div class="mt-2">
                                            <button data-bs-target="#uploadProfilePic" data-bs-toggle="modal" 
                                                class="btn btn-outline-primary btn-sm"><i class="bi bi-image me-2"></i>
                                                Change profile</button>
                                        </div>
                                    </div>
                                    <form id="admin-profile-form" method="POST">
                                        <!-- User Information -->
                                    <fieldset class="border rounded p-3 mb-4">
                                        <legend class="float-none w-auto px-2">Admin Information</legend>
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="admin_name" required placeholder="Zalia Redoblo">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control"id="admin_email" required placeholder="admin@mail.com"
                                                >
                                        </div>
                                    </fieldset>

                                    <!-- Password Section -->
                                    <fieldset class="border rounded p-3 mb-4">
                                        <legend class="float-none w-auto px-2">Security</legend>
                                        <p class="text-muted">Set a permanent password if you don't want to use
                                            temporary login codes.</p>
                                        <button data-bs-toggle="modal" data-bs-target="#newpass"
                                            class="btn btn-outline-dark"><i class="bi bi-shield-lock me-2"></i> Set New
                                            Password</button>
                                    </fieldset>
                                </div>

                                <!-- Save Changes Button -->
                                <div class="card-footer bg-light text-end">
                                    @include('Administrator.components.button', [
                                        'buttonWidth' => '',
                                        'buttonLabel' => 'Save Changes',
                                        'buttonID' => 'update-admin-button',
                                        'buttonSpan' => 'update-admin-button-span',
                                        'buttonModal' => '',
                                        'buttonFunction' => 'UpdateAdminProfile',
                                        'buttonFormID' => 'update-admin-form',
                                        'buttonUrl' => '/admin-profile-update',
                                    ])
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('Administrator.components.modals')

                @include('Administrator.components.footer')
            </div>

        </div>
        @include('Administrator.components.scripts')
        <script src="{{ asset('js/RequestScript.js') }}"></script>
        <script src="{{ asset('js/admin/AdminProfile.js') }}"></script>


</body>

</html>
