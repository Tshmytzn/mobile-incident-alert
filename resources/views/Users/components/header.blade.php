<!-- Navbar -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex me-4">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg> Dark Theme
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg> Light Theme
                </a>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    @php
                        // Fetch the user_id from the session
                        $userId = session('user_id');

                        // Fetch the user data from the AppUser model using the user_id
                        $user = \App\Models\AppUser::find($userId);
                    @endphp

                    @if ($user)
                        @php
                            // Check if the user has a picture
                            $profilePicture = $user->picture
                                ? asset('StudentPicture/' . $user->picture)
                                : asset('static/avatars/000m.jpg');
                        @endphp
                        <span class="avatar avatar-sm" style="background-image: url('{{ $profilePicture }}')">
                        </span>
                        <div class="d-none d-xl-block ps-2">
                            <div class="d-block d-xl-none fw-bold">{{ $user->name }}</div>
                            <div class="d-none d-xl-block">{{ $user->name }}</div>
                            <div class="mt-1 small text-secondary">{{ $user->role }}</div>
                        </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <!-- User Info Section -->
                    @if ($user)
                        <div class="dropdown-header text-center d-flex align-items-center"
                            style="padding: 10px; border-bottom: 1px solid #ddd;">
                            <!-- User Profile Picture -->
                            <span class="avatar avatar-md me-2"
                                style="background-image: url('{{ $profilePicture }}'); width: 40px; height: 40px; border-radius: 50%;">
                            </span>
                            <div class="text-start">
                                <strong id="user-name">{{ $user->name }}</strong> <br>
                                <small id="user-role" class="text-muted">{{ ucfirst($user->role) }}</small>
                            </div>
                        </div>
                    @endif

                    <!-- Menu Items -->
                    <a href="/profilesettings" class="dropdown-item">Settings</a>
                    <a data-bs-target="#logoutModal" data-bs-toggle="modal" class="dropdown-item text-danger">Logout</a>
                </div>
            @else
                <div>User not found.</div>
                @endif
            </div>

        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">

        </div>
    </div>
</header>
