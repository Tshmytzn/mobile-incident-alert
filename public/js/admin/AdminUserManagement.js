function GetUserData() {
    sendRequest("GET", "/get-user", null, function (error, response) {
        const responseMessage =
            typeof response === "string" ? JSON.parse(response) : response;

        if (!responseMessage.status) {
            console.error("GET Error:", error, response);
        } else {

            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable("#userTable")) {
                $("#userTable").DataTable().destroy();
            }

            // Clear the table body to avoid duplicated data
            $("#userTable tbody").empty();

            // Reinitialize DataTable with new data
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

function UpdateUserModal(id, name, email, role) {
    document.getElementById("update-user-name").value = name;
    document.getElementById("update-user-email").value = email;
    document.getElementById("update-user-role").value = role;
    document.getElementById("user-update-id").value = id;
}

async function AddUser(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetUserData();
    }
}

async function UpdateUser(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetUserData();
    }
}

$(document).ready(function () {
    GetUserData();
});
