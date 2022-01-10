$(document).ready(function () {
    $(".notifications-cards .h-card > span").each(function () {
        if ($(this).hasClass("remove")) {
            $(this).remove();
        }
    });

    $(".notifications-cards .h-card > span").each(function () {
        $.post("manage-products.php",
            {
                id_notification: $(this).parent().attr("id")
            }
        );
    });
});