<!-- Set New Password Modal -->
<div class="modal fade" id="Userpassmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responderModalLabel">Set New Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="User_pass_form" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label"> Enter Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter current password">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Enter New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cancel">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M18.364 5.636l-12.728 12.728" />
                    </svg> Close</button>
                    @include('Administrator.components.button', [
                        'buttonWidth' => '',
                        'buttonLabel' => 'Save Changes',
                        'buttonID' => 'update-userpass-button',
                        'buttonSpan' => 'update-password-button-span',
                        'buttonModal' => 'Userpassmodal',
                        'buttonFunction' => 'UpdateUserPassword',
                        'buttonFormID' => 'User_pass_form',
                        'buttonUrl' => '/user-password-update',
                    ])
            </div>
        </div>
    </div>
</div>

<!-- Upload Profile Picture Modal -->
<div class="modal fade" id="uploadProfilePic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="uploadProfilePicLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadProfilePicLabel">Upload Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-picture-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 text-center">
                            <input type="file" class="form-control" name="picture" accept="image/*" required>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <img id="previewImage" src="" alt="Profile Preview" class="img-thumbnail"
                                style="max-width: 150px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'update-picture-button',
                    'buttonSpan' => 'update-picture-button-span',
                    'buttonModal' => 'uploadProfilePic',
                    'buttonFunction' => 'UpdatePicture',
                    'buttonFormID' => 'update-picture-form',
                    'buttonUrl' => '/user-picture-update',
                ])
            </div>
        </div>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal modal-blur fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Warning Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
                <h3>Are you sure?</h3>
                <div class="text-secondary">You will be logged out of your account.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <form id="user-logout-form" method="POST">
                                @csrf
                                @include('Administrator.components.button', [
                                    'buttonWidth' => 'btn-danger w-100',
                                    'buttonLabel' => 'Logout',
                                    'buttonID' => 'logout-button',
                                    'buttonSpan' => 'button-span',
                                    'buttonModal' => 'none',
                                    'buttonFunction' => 'LogoutRequest',
                                    'buttonFormID' => 'user-logout-form',
                                    'buttonUrl' => '/user-logout',
                                ])
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="swipe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" id="modal-dialogs">
        <div class="modal-content" id="modal-contents">

            <div id="swipe-body">
                <div class="swipe-container">
                    <div class="swipe-button" id="swipeBtn">↔</div>
                    <div class="swipe-text" disabled>
                        <span>Left to Cancel</span>
                        <span>Right to Alert</span>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
