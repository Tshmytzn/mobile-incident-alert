function GetUserData(){
    sendRequest("GET", "/get-user", null, function (error, response) {
        const responseMessage = JSON.parse(response);
        if (!responseMessage.status) {
            console.error("GET Error:", error, response);
        } else {
            console.log(responseMessage.data);
            $("#userTable").DataTable({
                processing: true,
                data: responseMessage.data, // Set data directly
                columns: [
                    { data: "name" },
                    { data: "email" },
                    { data: "role" },
                    { data: "phone_number", defaultContent: "N/A" }, // Handle missing phone numbers
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<button class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#updateuser" onclick="UpdateUserModal('${row.id}','${row.name}','${row.email}','${row.role}')">Action</button>`;
                        },
                    },
                ],
            });
        }
    });
}

function UpdateUserModal(id,name,email,role)
{
    document.getElementById('update-user-name').value = name;
    document.getElementById('update-user-email').value = email;
    document.getElementById("update-user-role").value = 'role';
}


$(document).ready(function () {
    GetUserData();
});