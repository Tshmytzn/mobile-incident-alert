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
            window.location.replace("/dashboard");
        }
    });
}


// sendRequest("GET", getUrl, null, function (error, response) {
//     if (error) {
//         console.error("GET Error:", error, response);
//     } else {
//         console.log("GET Success:", response);
//     }
// });
