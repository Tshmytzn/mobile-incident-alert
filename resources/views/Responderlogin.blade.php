<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Responder Login</title>
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

<body class="d-flex flex-column"
    style="
    background-image: url('./static/lasalle_campus.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    width: 100vw;
">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">

            <div class="card card-md ">
                <div class="text-center mb-4">
                    <a href="#" class="navbar-brand navbar-brand-autodark mt-5">
                        <img src="./static/lasalle_logo.png" style="width: 210px; height: 70px;" alt="Tabler"
                            class="navbar-brand-image">

                    </a>
                </div>
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Responder's Login</h2>
                    <form id="responder_login_form" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Your Username"
                                autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password

                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="Your password"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-footer">
                            @include('Administrator.components.button', [
                                'buttonWidth' => 'w-100',
                                'buttonLabel' => 'Sign in',
                                'buttonID' => 'login-button',
                                'buttonSpan' => 'button-span',
                                'buttonModal' => 'none',
                                'buttonFunction' => 'ResponderLogin',
                                'buttonFormID' => 'responder_login_form',
                                'buttonUrl' => '/responder-login',
                            ]) </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('Administrator.components.scripts')
</body>
<script src="{{ asset('js/Responder/ResponderLogin.js') }}"></script>
<script src="{{ asset('js/RequestScript.js') }}"></script>

</html>
