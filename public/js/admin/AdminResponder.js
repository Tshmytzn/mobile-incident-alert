async function AddResponder(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetResponderData();
    }
}

function GetResponderData() {
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
            let url = `/get-responder?start=${data.start}&length=${data.length}&draw=${data.draw}`;
            if (data.search.value) {
                url += `&search[value]=${data.search.value}`; // Append search query
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
            { data: "username" },
            { data: "type" },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<button class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#updateResponder" onclick="UpdateResponderModal('${row.id}','${row.name}','${row.username}','${row.type}')"><i class="bi bi-pencil-square"></i></button>`;
                },
            },
        ],
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
