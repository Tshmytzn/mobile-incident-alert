<!doctype html>

<html lang="en">

@include('Responder.components.head')

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('Responder.components.aside')
        @include('Responder.components.header')

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
                                        <img src="./static/avatars/000m.jpg" class="rounded-circle border"
                                            width="100" height="100" alt="User Avatar">
                                        <div class="mt-2">
                                            <button data-bs-target="#uploadProfilePic" data-bs-toggle="modal"
                                                class="btn btn-outline-primary btn-sm"><i class="bi bi-image me-2"></i>
                                                Change profile</button>
                                        </div>
                                    </div>

                                    <!-- User Information -->
                                    <fieldset class="border rounded p-3 mb-4">
                                        <legend class="float-none w-auto px-2">Admin Information</legend>
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Zalia Redoblo">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" placeholder="admin@mail.com"
                                                disabled>
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
                        </div>
                    </div>
                </div>
                @include('Responder.components.modals')

                @include('Responder.components.footer')
            </div>

        </div>
        @include('Responder.components.scripts')

</body>

</html>
