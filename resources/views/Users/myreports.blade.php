<!doctype html>

<html lang="en">

@include('Users.components.head')

<body>
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('Users.components.aside')
        @include('Users.components.header')

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
                                My Reports
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="mt-5">
                            <table id="userTable" class="table table-hover ">
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
            @include('Users.components.modals')
            @include('Users.components.footer')
        </div>
    </div>
    @include('Users.components.scripts')
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({

            });
        });
    </script>

</body>

</html>
