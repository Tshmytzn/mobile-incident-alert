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
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <!-- Page pre-title -->
                                <div class="page-pretitle">
                                    Overview
                                </div>
                                <h2 class="page-title">
                                    Incident Management
                                </h2>
                            </div>
                            <button class="btn btn-outline-success rounded-circle shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#settingsModal">
                                <i class="bi bi-gear-fill"></i> </button>
                        </div>

                        <!-- Map Section -->
                        <div class="col-12 mt-2">
                             <div class="card-body">
                                <div id="map" style="height: 540px;"></div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <table id="userTable" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Emergency Type</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Role</th>
                                        <th>Emergency Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">


                    </div>
                </div>
            </div>
            @include('Administrator.components.modals')
            @include('Administrator.components.footer')
        </div>
    </div>
    @vite('resources/js/app.js')
    @include('Administrator.components.scripts')
    <script src="{{ asset('js/RequestScript.js') }}"></script>
    <script src="{{ asset('js/admin/AdminIncident.js') }}"></script>

</body>

</html>
