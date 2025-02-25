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
                                Responder Management
                            </h2>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <button data-bs-toggle="modal" data-bs-target="#addResponder" class="btn btn-primary" id="addUserBtn"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shield-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12.462 20.87c-.153 .047 -.307 .09 -.462 .13a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 .11 6.37" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                </svg> Add Responder</button>
                        </div>

                        <table id="userTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                        </table>

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
    <script src="{{ asset('js/admin/AdminResponder.js') }}"></script>
    <script src="{{ asset('js/RequestScript.js') }}"></script>
    
</body>

</html>
