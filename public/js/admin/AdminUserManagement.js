function GetUserData(){
    sendRequest("GET", "/get-user", null, function (error, response) {
        const responseMessage = JSON.parse(response);
        if (!responseMessage.status) {
            console.error("GET Error:", error, response);
        } else {
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
                            return `<button class="btn btn-primary action-btn" data-id="${row.id}">Action</button>`;
                        },
                    },
                ],
            });
        }
    });
}


$(document).ready(function () {
    GetUserData();
});