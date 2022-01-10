$(document).ready(function () {

    $("#eye-btn").on("click", function () {
        if ($("#eye").attr("src") == "./img/icon/2d/normal/eye.svg") {
            $("#eye").attr("src", "./img/icon/2d/normal/eye-slash.svg");
            $("#pwd").attr("type", "text");
            $("#eye").attr("alt", "Nascondi password");
            $("#pwd").focus();
        } else {
            $("#eye").attr("src", "./img/icon/2d/normal/eye.svg");
            $("#pwd").attr("type", "password");
            $("#eye").attr("alt", "Mostra password");
            $("#pwd").focus();
        }
    });

});
