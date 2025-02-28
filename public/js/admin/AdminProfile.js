

async function GetAdminProfile(){
    const data = await GetRequest("/get-admin");
    const profile = data.data;
    SetValue("admin_name", profile.name);
    SetValue("admin_email", profile.email);

   document.getElementById("profilePicPreview").src = profile.picture
       ? `./AdminPicture/${profile.picture}`
       : "./static/avatars/000m.jpg";

    document.getElementById("previewImage").src = profile.picture
        ? `./AdminPicture/${profile.picture}`
        : "./static/avatars/000m.jpg";
}

async function UpdateAdminProfile(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetAdminProfile();
    }
}

async function UpdateAdminPicture(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetAdminProfile();
    }
}

$(document).ready(function () {
    GetAdminProfile();
});