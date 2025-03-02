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
        ajax: function (data, callback) {
            let url = `/user-get-alert?start=${data.start}&length=${data.length}&draw=${data.draw}`;
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
            { data: "type" },
            { data: "reported_at" },
            { data: "status" },
        ],
    });
}

$(document).ready(function () {
    GetResponderData();
});