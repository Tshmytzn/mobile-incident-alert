function AdminLogin(id) {
    let form = document.getElementById(id); // Get the form by ID

     if (!form.checkValidity()) {
         form.reportValidity(); // Shows default browser validation messages
         return; // Stop the function if validation fails
     }

    let formData = new FormData(form); // Collect all form inputs dynamically
    
    
    sendRequest("POST", "/save-data", formData, function (error, response) {
        if (error) {
            console.error("POST Error:", error, response);
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
