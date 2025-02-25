function GetUserData(page = 1) {
    sendRequest(
        "GET",
        `/get-user?page=${page}`,
        null,
        function (error, response) {
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

                // Reinitialize DataTable with server-side pagination
                $("#userTable").DataTable({
                    processing: true,
                    serverSide: true, // Enable server-side processing
                    ajax: function (data, callback) {
                        sendRequest(
                            "GET",
                            `/get-user?page=${data.start / data.length + 1}`,
                            null,
                            function (error, response) {
                                if (error) {
                                    console.error("Pagination Error:", error);
                                    return;
                                }

                                const responseMessage =
                                    typeof response === "string"
                                        ? JSON.parse(response)
                                        : response;

                                callback({
                                    draw: data.draw,
                                    recordsTotal:
                                        responseMessage.pagination.total,
                                    recordsFiltered:
                                        responseMessage.pagination.total,
                                    data: responseMessage.data,
                                });
                            }
                        );
                    },
                    columns: [
                        { data: "name" },
                        { data: "email" },
                        { data: "role" },
                        { data: "phone_number", defaultContent: "N/A" },
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
        }
    );
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
