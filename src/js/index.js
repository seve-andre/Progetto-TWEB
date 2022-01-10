$(document).ready(function () {
    $("#text-video").slideDown(1000);

    setTimeout(function () {
        $("body").fadeOut("fast", function () {
            switchPage();
        });
    }, 2500);
});

function switchPage() {
    window.location.href = "./login.php";
}