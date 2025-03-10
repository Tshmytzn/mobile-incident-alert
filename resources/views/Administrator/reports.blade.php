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
                                Reports
                            </h2>
                        </div>

                        <div>
                            <table id="userTable" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th style="background-color: #00703C; color: white;">Emergency Type</th>
                                        <th style="background-color: #00703C; color: white;">Name</th>
                                        <th style="background-color: #00703C; color: white;">Number</th>
                                        <th style="background-color: #00703C; color: white;">Role</th>
                                        <th style="background-color: #00703C; color: white;">Emergency Contact</th>
                                        <th style="background-color: #00703C; color: white;">Assigned</th>
                                        <th style="background-color: #00703C; color: white;">Status</th>
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
    @include('Administrator.components.scripts')
    <script src="{{ asset('js/RequestScript.js') }}"></script>
    <script>
        function DataTable() {
            sendRequest("GET", "/get-solve-incidents", null, function(error, response) {
                if (error) {
                    console.error("Pagination Error:", error);
                    return;
                }

                const responseMessage =
                    typeof response === "string" ? JSON.parse(response) : response;

                let data = responseMessage.data || [];

                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable("#userTable")) {
                    $("#userTable").DataTable().destroy();
                }

                // Clear the table body to avoid duplicated data
                $("#userTable tbody").empty();

                // Initialize DataTable with fetched data
                $("#userTable").DataTable({
                    data: data,
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: "copyHtml5",
                            text: "Copy",
                            className: "btn btn-secondary",
                        },
                        {
                            extend: "excelHtml5",
                            text: "Excel",
                            className: "btn btn-success",
                        },
                        {
                            extend: "csvHtml5",
                            text: "CSV",
                            className: "btn btn-info",
                        },
                        {
                            extend: "pdfHtml5",
                            text: "PDF",
                            className: "btn btn-danger",
                        },
                        {
                            extend: "print",
                            text: "Print",
                            className: "btn btn-primary",
                        },
                    ],
                    columns: [{
                            data: "type"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "phone_number"
                        },
                        {
                            data: "role"
                        },
                        {
                            data: "emergency_contact_phone"
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `${row.responder_name} (${row.responder_type})`
                            },
                        },
                        {
                            data: "status"
                        },
                    ],
                });
            });
        }

        $(document).ready(function() {
            DataTable();
        });
    </script>


</body>

</html>
