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
                                Reports
                            </h2>
                        </div>

                        <div class="mt-5">
                            <table id="ReportTable" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Report Type</th>
                                        <th>Report Date</th>
                                        <th>Status</th>

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
            @include('Responder.components.modals')
            @include('Responder.components.footer')
        </div>
    </div>
    @include('Responder.components.scripts')
    <script src="{{ asset('js/responder/ResponderReport.js') }}"></script>



</body>

</html>
