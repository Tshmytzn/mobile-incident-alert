function AdminLogin(formID, buttonID, buttonSpan,Url) {
    let form = document.getElementById(formID); // Get the form by ID

    if (!form.checkValidity()) {
        form.reportValidity(); // Shows default browser validation messages
        return; // Stop the function if validation fails
    }

    let button = document.getElementById(buttonID);
    let spinner = document.getElementById(buttonID + "-spinner");
    let span = document.getElementById(buttonSpan);

    // Hide the button text and show the spinner
    span.style.display = "none";
    spinner.style.display = "inline-block";
    button.disabled = true;

    let formData = new FormData(form); // Collect all form inputs dynamically

    sendRequest("POST", Url, formData, function (error, response) {
        spinner.style.display = "none";
        span.style.display = "inline";
        button.disabled = false;
        if (error) {
            const errorMessage = JSON.parse(response);
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: errorMessage.message,
                showConfirmButton: false,
                timer: 1500,
            });
        } else {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Signed in successfully",
                showConfirmButton: false,
                timer: 1500,
            }).then(() => {
                window.location.replace("/dashboard");
            });
        }
    });
}

// Swal.fire({
//     title: "Are you sure?",
//     text: "You won't be able to revert this!",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonText: "Yes, delete it!",
//     cancelButtonText: "No, cancel!",
//     reverseButtons: true,
// }).then((result) => {
//     if (result.isConfirmed) {
//         Swal.fire("Deleted!", "Your file has been deleted.", "success");
//     } else if (result.dismiss === Swal.DismissReason.cancel) {
//         Swal.fire("Cancelled", "Your file is safe.", "error");
//     }
// });

// sendRequest("GET", getUrl, null, function (error, response) {
//     if (error) {
//         console.error("GET Error:", error, response);
//     } else {
//         console.log("GET Success:", response);
//     }
// });
