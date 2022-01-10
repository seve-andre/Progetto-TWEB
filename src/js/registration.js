$(document).ready(function () {
    $(".validation-requirement > input").click(function (e) {
        e.preventDefault();
    });

    $("#pwd").on("input", function () {
        let text = $(this).val();

        checkPasswordFor($("#min-length"), text.length >= 10);
        checkPasswordFor($("#uppercase-letter"), text.match(/[A-Z]/));
        checkPasswordFor($("#lowercase-letter"), text.match(/[a-z]/));
        checkPasswordFor($("#number"), text.match(/[0-9]/));
    });
});

function checkPasswordFor(caller, condition) {
    if (condition) {
        caller.attr("checked", true);
    } else {
        caller.attr("checked", false);
    }
}