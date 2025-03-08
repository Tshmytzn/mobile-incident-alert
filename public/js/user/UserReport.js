function GetResponderData() {
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable("#userTable")) {
        $("#userTable").DataTable().destroy();
    }

    // Clear table body
    $("#userTable tbody").empty();

    // Reinitialize DataTable with styling
    $("#userTable").DataTable({
        processing: true,
        serverSide: true,
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
            let url = `/user-get-alert?start=${data.start}&length=${data.length}&draw=${data.draw}`;
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
            { data: "type" },
            { data: "reported_at" },
            {
                data: "status",
                render: function (data, type, row) {
                    let badgeClass = "";
                    switch (data.toLowerCase()) {
                        case "in progress":
                            badgeClass = " badge bg-warning text-white";
                            break;
                        case "assigned":
                            badgeClass = "text-white badge bg-primary";
                            break;
                        case "resolved":
                            badgeClass = "text-white badge bg-success";
                            break;
                        default:
                            badgeClass = "text-white badge bg-secondary";
                    }
                    return `<span class="${badgeClass}">${data}</span>`;
                },
            },
        ],
    });
}

$(document).ready(function () {
    GetResponderData();
});
