<!doctype html>

<html lang="en">

@include('Responder.components.head')
<style>
    .nav-tabs .nav-link {
        border: none;
        padding: 12px 20px;
        color: #555;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
    }

    .nav-tabs .nav-link.active {
        background-color: #105801;
        color: white;
    }

</style>

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('Responder.components.aside')
        @include('Responder.components.header')

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
                                    Emergency Alerts
                                </h2>
                            </div>
                            <button class="btn shadow-sm" data-bs-toggle="modal" data-bs-target="#settingsModal">
                                <i class="bi bi-gear-fill"></i> </button>
                        </div>

                        <nav class="mt-4">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-active-alerts-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-active-alerts" type="button" role="tab"
                                    aria-controls="nav-active-alerts" aria-selected="true">Active Alerts</button>
                                <button class="nav-link" id="nav-alert-actions-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-alert-actions" type="button" role="tab"
                                    aria-controls="nav-alert-actions" aria-selected="false">Alert Actions</button>
                                <button class="nav-link" id="nav-emergency-log-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-emergency-log" type="button" role="tab"
                                    aria-controls="nav-emergency-log" aria-selected="false">Emergency Log</button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- Active Alerts -->
                            <div class="tab-pane fade show active" id="nav-active-alerts" role="tabpanel"
                                aria-labelledby="nav-active-alerts-tab">
                                <h5 class="mt-3">Live Emergency Reports</h5>
                                <div class="mt-3">
                                    <table id="activeAlerts" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <!-- Alert Actions -->
                            <div class="tab-pane fade" id="nav-alert-actions" role="tabpanel"
                                aria-labelledby="nav-alert-actions-tab">
                                <h5 class="mt-3">Acknowledge & Respond</h5>
                                <div class="mt-3">
                                    <table id="alertActions" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <!-- Emergency Log -->
                            <div class="tab-pane fade" id="nav-emergency-log" role="tabpanel"
                                aria-labelledby="nav-emergency-log-tab">
                                <h5 class="mt-3">Past Emergencies</h5>
                                <div class="mt-3">
                                    <table id="emergencyLog" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
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
            @include('Responder.components.modals')
            @include('Responder.components.footer')
        </div>
    </div>
    @include('Responder.components.scripts')

    <script>
        $(document).ready(function() {
            $('#activeAlerts').DataTable({

            });
        });
        $(document).ready(function() {
            $('#alertActions').DataTable({

            });
        });
        $(document).ready(function() {
            $('#emergencyLog').DataTable({

            });
        });
    </script>

</body>

</html>
