$(document).ready(function () {

    let counter = 0;
    setInterval(() => {

        if (counter == 100) {
            clearInterval();
            $(".skill").hide();
            $("#successful-order").fadeIn().show();
        } else {
            counter += 1;
            $("#number").text(counter + "%");
        }

    }, 15);

    setTimeout(function () {
        var toast = new bootstrap.Toast($("#modal-notification"));
        toast.show();
    }, 2000);

});