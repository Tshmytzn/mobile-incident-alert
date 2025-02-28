<!-- Add User Modal -->
<div class="modal fade" id="adduser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-user-form" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter full name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email"
                                required>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example">
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'add-user-button',
                    'buttonSpan' => 'add-user-span',
                    'buttonModal' => 'adduser',
                    'buttonFunction' => 'AddUser',
                    'buttonFormID' => 'add-user-form',
                    'buttonUrl' => '/add-user',
                ])
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-user-form" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="userid" id="user-update-id" required hidden>
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="update-user-name"
                                placeholder="Enter full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="update-user-email"
                                placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" id="update-user-role"
                                aria-label="Default select example">
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'update-user-button',
                    'buttonSpan' => 'update-user-span',
                    'buttonModal' => 'updateuser',
                    'buttonFunction' => 'UpdateUser',
                    'buttonFormID' => 'update-user-form',
                    'buttonUrl' => '/update-user',
                ])
            </div>
        </div>
    </div>
</div>

<!-- Add Responder Modal -->
<div class="modal fade" id="addResponder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responderModalLabel">Add New Responder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-responder-form" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter full name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">UserName</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter username"
                                required>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Enter password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example" required>
                                <option value="Medical">Medical</option>
                                <option value="Security">Security</option>
                                <option value="Disasters">Disasters</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Fire">Fire</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'add-responder-button',
                    'buttonSpan' => 'add-responder-span',
                    'buttonModal' => 'addResponder',
                    'buttonFunction' => 'AddResponder',
                    'buttonFormID' => 'add-responder-form',
                    'buttonUrl' => '/add-responder',
                ])
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateResponder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responderModalLabel">Add New Responder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-responder-form" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="responderid" id="update-responder-id" hidden>
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="update-responder-name"
                                placeholder="Enter full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">UserName</label>
                            <input type="text" class="form-control" name="username"
                                id="update-responder-username" placeholder="Enter username" required>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="udate-responder-password"
                                name="password" placeholder="Enter password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" id="update-responder-role"
                                aria-label="Default select example" required>
                                <option value="Medical">Medical</option>
                                <option value="Security">Security</option>
                                <option value="Disasters">Disasters</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Fire">Fire</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'update-responder-button',
                    'buttonSpan' => 'update-responder-span',
                    'buttonModal' => 'updateResponder',
                    'buttonFunction' => 'UpdateResponder',
                    'buttonFormID' => 'update-responder-form',
                    'buttonUrl' => '/update-responder',
                ])
            </div>
        </div>
    </div>
</div>

<!-- Set New Password Modal -->
<div class="modal fade" id="newPassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responderModalLabel">Set New Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="admin-pass-form" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="admin_old_password" required name="admin_old_password" placeholder="Enter password">
                        </div>
                        <div class="col-12">
                            <label class="form-label"> New Password</label>
                            <input type="password" class="form-control" id="admin_new_password" required name="admin_new_password" placeholder="Enter password">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close</button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save Changes',
                    'buttonID' => 'update-password-button',
                    'buttonSpan' => 'update-password-button-span',
                    'buttonModal' => 'newPassModal',
                    'buttonFunction' => 'UpdateAdminPassword',
                    'buttonFormID' => 'admin-pass-form',
                    'buttonUrl' => '/admin-password-update',
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cancel">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M18.364 5.636l-12.728 12.728" />
                    </svg> Close
                </button>
                @include('Administrator.components.button', [
                    'buttonWidth' => '',
                    'buttonLabel' => 'Save',
                    'buttonID' => 'update-picture-button',
                    'buttonSpan' => 'update-picture-button-span',
                    'buttonModal' => 'uploadProfilePic',
                    'buttonFunction' => 'UpdateAdminPicture',
                    'buttonFormID' => 'update-picture-form',
                    'buttonUrl' => '/admin-picture-update',
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
                            <form id="admin-logout-form" method="POST">
                                @csrf
                                @include('Administrator.components.button', [
                                    'buttonWidth' => 'btn-danger w-100',
                                    'buttonLabel' => 'Logout',
                                    'buttonID' => 'logout-button',
                                    'buttonSpan' => 'button-span',
                                    'buttonModal' => 'none',
                                    'buttonFunction' => 'LogoutRequest',
                                    'buttonFormID' => 'admin-logout-form',
                                    'buttonUrl' => '/admin-logout',
                                ])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
