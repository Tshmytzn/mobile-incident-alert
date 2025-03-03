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
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Maps & Tracking
                            </h2>
                        </div>

                        <!-- Map Section -->
                        <div class="col-12 mt-2">
                            <div class="card-body">
                                <div id="map" style="height: 540px;"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5" id="user-info">
                            {{-- <div class="card" style="width: 18rem;">
                                <div class="card-header">
                                    Emergency Information
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">John Doe</h5>
                                    <p class="card-text"><strong>Emergency Type:</strong> Medical</p>
                                    <p class="card-text"><strong>Phone Number:</strong> +1 (123) 456-7890</p>
                                    <p class="card-text"><strong>Emergency Contact:</strong> Jane Doe (+1 (098)
                                        765-4321)</p>
                                </div>
                            </div> --}}
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
    <script src="{{ asset('js/responder/ResponderIncident.js') }}"></script>
</body>

</html>
