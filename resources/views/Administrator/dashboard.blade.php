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
                                Dashboard
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="row row-cards">

                                <!-- Responder Alerts -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-warning text-white avatar">
                                                        <!-- Responder Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-message-reply">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                                            <path d="M11 8l-3 3l3 3" />
                                                            <path d="M16 11h-8" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Available Responders
                                                    </div>
                                                    <div id="active_incidents" class="text-secondary">
                                                        @php
                                                            $availableResponders = \App\Models\Responder::where(
                                                                'status',
                                                                '1',
                                                            )->count();
                                                        @endphp

                                                        @if ($availableResponders > 0)
                                                            {{ $availableResponders }} Responder/s
                                                        @else
                                                            No Responders Available.
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Pending Incidents -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-info text-white avatar">
                                                        <!-- Pending Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-loader">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 6l0 -3" />
                                                            <path d="M16.25 7.75l2.15 -2.15" />
                                                            <path d="M18 12l3 0" />
                                                            <path d="M16.25 16.25l2.15 2.15" />
                                                            <path d="M12 18l0 3" />
                                                            <path d="M7.75 16.25l-2.15 2.15" />
                                                            <path d="M6 12l-3 0" />
                                                            <path d="M7.75 7.75l-2.15 -2.15" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Pending Alerts
                                                    </div>
                                                    <div id="pending_incidents" class="text-secondary">
                                                        @php
                                                            $inProgressCount = \App\Models\Incidents::where(
                                                                'status',
                                                                'Pending',
                                                            )->count();
                                                        @endphp

                                                        @if ($inProgressCount > 0)
                                                            {{ $inProgressCount }} Incident/s
                                                        @else
                                                            No Pending Incidents.
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Incident Alerts -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-danger text-white avatar">
                                                        <!-- Alert Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-alert-hexagon">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                                            <path d="M12 8v4" />
                                                            <path d="M12 16h.01" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Active Incidents
                                                    </div>
                                                    <div id="active_incidents" class="text-secondary">
                                                        @php
                                                            $inProgressCount = \App\Models\Incidents::where(
                                                                'status',
                                                                'In Progress',
                                                            )->count();
                                                        @endphp

                                                        @if ($inProgressCount > 0)
                                                            {{ $inProgressCount }} Incident/s
                                                        @else
                                                            No Active Incidents.
                                                        @endif
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Resolved Incidents -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-success text-white avatar">
                                                        <!-- Resolved Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-check">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                            <path
                                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                            <path d="M9 15l2 2l4 -4" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Resolved Incidents
                                                    </div>
                                                    <div id="active_incidents" class="text-secondary">
                                                        @php
                                                            $inProgressCount = \App\Models\Incidents::where(
                                                                'status',
                                                                'Resolved',
                                                            )->count();
                                                        @endphp

                                                        @if ($inProgressCount > 0)
                                                            {{ $inProgressCount }} Incident/s
                                                        @else
                                                            No Incidents Resolved
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Map Section -->
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">La Salle Bacolod Campus Map</h3>
                            </div>
                            <div class="card-body">
                                <div id="map" style="height: 540px;"></div>
                            </div>
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
    <script src="{{ asset('js/admin/AdminDashboard.js') }}"></script>

</body>

</html>
