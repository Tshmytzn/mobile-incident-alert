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
                                        <img src="./static/avatars/000m.jpg" class="rounded-circle border" width="100" height="100" alt="User Avatar">
                                        <div class="mt-2">
                                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-image"></i> Change Avatar</button>
                                            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                                        </div>
                                    </div>
                                    
                                    <!-- User Information -->
                                    <fieldset class="border rounded p-3 mb-4">
                                        <legend class="float-none w-auto px-2">User Information</legend>
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="John Doe">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" placeholder="john.doe@example.com" disabled>
                                        </div>
                                    </fieldset>
                                    
                                    <!-- Password Section -->
                                    <fieldset class="border rounded p-3 mb-4">
                                        <legend class="float-none w-auto px-2">Security</legend>
                                        <p class="text-muted">Set a permanent password if you don't want to use temporary login codes.</p>
                                        <button class="btn btn-outline-dark"><i class="bi bi-shield-lock"></i> Set New Password</button>
                                    </fieldset>
                                </div>
                                
                                <!-- Save Changes Button -->
                                <div class="card-footer bg-light text-end">
                                    <button class="btn btn-primary"><i class="bi bi-save"></i> Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @include('Administrator.components.footer')
            </div>

        </div>
        @include('Administrator.components.scripts')

</body>

</html>
