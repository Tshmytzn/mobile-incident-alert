

async function GetProfile(){
    const data = await GetRequest("/user-profile");
    const profile = data.data;
    SetValue("profile-name", profile.name);
    SetValue("profile-email", profile.email);
    SetValue("profile-number", profile.phone_number);
    SetValue("profile-address", profile.address);

   document.getElementById("profilePicPreview").src = profile.picture
       ? `./StudentPicture/${profile.picture}`
       : "./static/avatars/000m.jpg";

    document.getElementById("previewImage").src = profile.picture
        ? `./StudentPicture/${profile.picture}`
        : "./static/avatars/000m.jpg";

    SetValue("profile-contact-name", profile.emergency_contact_name);
    SetValue("profile-contact-number", profile.emergency_contact_phone);
}

async function UpdateProfile(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetProfile();
    }
}

async function UpdatePicture(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetProfile();
    }
}

async function UpdateUserPassword(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetProfile();
    }
}

$(document).ready(function () {
    GetProfile();
});
