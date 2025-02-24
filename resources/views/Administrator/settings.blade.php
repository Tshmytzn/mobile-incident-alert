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
            <div class="page-header d-print-none">
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
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="card">
                            <div class="row g-0">

                                <div class="col-12 col-md-9 d-flex flex-column">
                                    <!-- My Account Tab -->
                                    <div class="tab-pane fade show active" id="useraccount">
                                        <div class="card-body">
                                            <h2 class="mb-4">My Account</h2>
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span class="avatar avatar-xl"
                                                        style="background-image: url(./static/avatars/000m.jpg)"></span>
                                                </div>
                                                <div class="col-auto"><a href="#" class="btn">Change
                                                        avatar</a></div>
                                                <div class="col-auto"><a href="#"
                                                        class="btn btn-ghost-danger">Delete avatar</a></div>
                                            </div>
                                            <h3 class="card-title mt-4">User Information</h3>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-label">Name</div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label">Email</div>
                                                    <input type="email" class="form-control">
                                                </div>

                                            </div>

                                            <h3 class="card-title mt-4">Password</h3>
                                            <p class="card-subtitle">You can set a permanent password if you don't
                                                want to use temporary login codes.</p>
                                            <div>
                                                <a href="#" class="btn">Set new password</a>
                                            </div>
                                            <div class="card-footer bg-transparent mt-2">
                                                <div class="btn-list justify-content-end">
                                                    <button class="btn btn-primary"> Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
