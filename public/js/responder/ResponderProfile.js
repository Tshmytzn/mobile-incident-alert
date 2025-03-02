

async function GetResponderProfile(){
    const data = await GetRequest("/responder-profile");
    const profile = data.data;
    SetValue("fullname", profile.name);
    SetValue("username", profile.username);

//    document.getElementById("profilePicPreview").src = profile.picture
//        ? `./StudentPicture/${profile.picture}`
//        : "./static/avatars/000m.jpg";

//     document.getElementById("previewImage").src = profile.picture
//         ? `./StudentPicture/${profile.picture}`
//         : "./static/avatars/000m.jpg";

}

async function UpdateProfile(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetResponderProfile();
    }
}

// async function UpdatePicture(formID, buttonID, buttonSpan, Url, Modal) {
//     const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
//     if (status) {
//         GetResponderProfile();
//     }
// }

async function UpdateResponderPassword(formID, buttonID, buttonSpan, Url, Modal) {
    const status = await PostRequest(formID, buttonID, buttonSpan, Url, Modal);
    if (status) {
        GetResponderProfile();
    }
}

$(document).ready(function () {
    GetResponderProfile();
});
