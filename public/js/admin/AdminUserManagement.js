function GetUserData() {
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable("#userTable")) {
        $("#userTable").DataTable().destroy();
    }

    // Clear the table body to avoid duplicated data
    $("#userTable tbody").empty();

    // Reinitialize DataTable with server-side pagination & searching
    $("#userTable").DataTable({
        processing: true,
        serverSide: true, // Enable server-side processing
        dom: 'Bfrtip',
        buttons: [
            {
                extend: "copyHtml5",
                text: "Copy",
                className: "btn btn-secondary",
            },
            {
                extend: "excelHtml5",
                text: "Excel",
                className: "btn btn-success",
            },
            {
                extend: "csvHtml5",
                text: "CSV",
                className: "btn btn-info",
            },
            {
                extend: "pdfHtml5",
                text: "PDF",
                className: "btn btn-danger",
            },
            {
                extend: "print",
                text: "Print",
                className: "btn btn-primary",
            },
        ],
        ajax: function (data, callback) {
            let url = `/get-user?start=${data.start}&length=${data.length}&draw=${data.draw}`;
            if (data.search.value) {
                url += `&search[value]=${data.search.value}`;
            }

            sendRequest("GET", url, null, function (error, response) {
                if (error) {
                    console.error("Pagination Error:", error);
                    return;
                }

                const responseMessage =
                    typeof response === "string"
                        ? JSON.parse(response)
                        : response;

                callback({
                    draw: responseMessage.pagination.draw,
                    recordsTotal: responseMessage.pagination.total,
                    recordsFiltered: responseMessage.pagination.total,
                    data: responseMessage.data,
                });
            });
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
                    return `<button class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#updateuser" onclick="UpdateUserModal('${row.id}','${row.name}','${row.email}','${row.role}')"><i class="bi bi-pencil-square"></i></button>`;
                },
            },
        ],
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
