async function AddResponder(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetResponderData();
    }
}

function GetResponderData() {
    sendRequest("GET", "/get-responder", null, function (error, response) {
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
                    { data: "username" },
                    { data: "type" },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<button class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#updateResponder" onclick="UpdateResponderModal('${row.id}','${row.name}','${row.username}','${row.type}')">Action</button>`;
                        },
                    },
                ],
            });
        }
    });
}

function UpdateResponderModal(id, name, username, role) {
    document.getElementById("update-responder-name").value = name;
    document.getElementById("update-responder-username").value = username;
    document.getElementById("update-responder-role").value = role;
    document.getElementById("update-responder-id").value = id;
}

async function UpdateResponder(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetResponderData();
    }
}

$(document).ready(function () {
    GetResponderData();
});
