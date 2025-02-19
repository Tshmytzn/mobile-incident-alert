<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin Login</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="./dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="./dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="./dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="./dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">

            <div class="card card-md">
                <div class="text-center mb-4">
                    <a href="#" class="navbar-brand navbar-brand-autodark mt-5">
                        <img src="./static/lasalle_logo.png" style="width: 210px; height: 70px;" alt="Tabler" class="navbar-brand-image">
                    </a>
                </div>
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Administrator's Login</h2>
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="admin@lasalle.edu.ph" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password

                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" placeholder="Your password"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('Administrator.components.scripts')
</body>
</html>
