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
            console.log("Raw Response:", xhr.responseText); // Debugging

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
