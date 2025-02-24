function sendRequest(method, url, data = null, callback) {
    let xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    let isFormData = data instanceof FormData;
    if (!isFormData) {
        xhr.setRequestHeader("Content-Type", "application/json");
    }

    let csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");
    if (method === "POST" && csrfToken) {
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            // console.log("Raw Response:", xhr.responseText); // Debugging

            if (xhr.status === 200 || xhr.status === 201) {
                try {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    callback(null, jsonResponse);
                } catch (error) {
                    console.error("JSON Parse Error:", error, xhr.responseText);
                    callback("Invalid JSON response", xhr.responseText);
                }
            } else {
                callback(xhr.status, xhr.responseText);
            }
        }
    };

    xhr.send(isFormData ? data : JSON.stringify(data));
}


function PostRequest(formID, buttonID, buttonSpan, Url) {
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
        const responseMessage = JSON.parse(response);
        if (error) {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: responseMessage.message,
                showConfirmButton: false,
                timer: 1500,
            });
        } else {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: responseMessage,
                showConfirmButton: false,
                timer: 1500,
            });
        }
    });
}
