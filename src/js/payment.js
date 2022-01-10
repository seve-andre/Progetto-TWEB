$(document).ready(function () {

    $(".option").click(function () {
        if (!$(this).hasClass("active-option")) {

            $(this).closest(".option-container").find(".option").each(function () {
                $(this).removeClass("active-option");
                $(this).find(".form-check-input").removeAttr("checked");
            });
            $(this).addClass("active-option");
            $(this).find(".form-check-input").prop("checked", "checked");

            let detail = $(this).find(".details span:first-of-type").text();
            if ($(this).find("input[name='address']").length > 0) {
                $.post("manage-products.php",
                    {
                        address: detail
                    }
                );
            } else {
                $.post("manage-products.php",
                    {
                        payment_type: detail
                    }
                );
            }

            if ($(this).is($(".option-container:nth-child(2) > div:nth-child(3)"))) {
                $("#credit-card-form").show();
            } else if ($(this).is($(".option-container:nth-child(2) > div:nth-child(2)"))) {
                $("#credit-card-form").hide();
            }
        }
    });

    $(".option").on("enterKey", function () {
        $(this).click();
    });

    $(".option").keyup(function (e) {
        if (e.keyCode == 13) {
            $(this).trigger("enterKey");
        }
    });

    let address = $("input[name='address']:checked").next().find("span:first-of-type").text();
    $.post("manage-products.php",
        {
            address: address
        }
    );

    let payment_type = $("input[name='payment']:checked").next().find("span:first-of-type").text();
    $.post("manage-products.php",
        {
            payment_type: payment_type
        }
    );

    $("#owner").blur(function (e) {
        e.target.value = e.target.value.trim();
    });

    removeSpacesTo($("#name"));

    // adds a space every 4 digits of credit card number
    $("#card-number").on("input", function (e) {
        e.target.value = e.target.value.replace(/\b0+/g, '')
            .replace(/[^0-9.]/g, '')
            .replace(/(\..*?)\..*/g, '$1')
            .replace(/(.{4})/g, '$1 ').trim();
    });

    // adds a slash after first 2 chars to match date convention
    $("#expiration").on("input", function (e) {
        if (e.target.value.length < 5) {
            e.target.value = e.target.value
                .replace(/[^\dA-Z]/g, '')
                .replace(/(.{2})/g, '$1/').trim();
        }
    });

    $("#code").on("input", function (e) {
        e.target.value = e.target.value
            .replace(/[^0-9.]/g, '')
            .replace(/(\..*?)\..*/g, '$1').trim();
    });

    limitInputTo($("#expiration"), 5);
    limitInputTo($("#card-number"), 19);
    limitInputTo($("#code"), 3);
    removeSpacesTo($("#expiration"));
    removeSpacesTo($("#code"));
});

function limitInputTo(caller, maxlength) {

    caller.on("input", function () {
        if ($(this).val().length > maxlength) {
            $(this).val($(this).val().substring(0, maxlength));
        }
    });
}

function removeSpacesTo(caller) {

    caller.on("input", function () {
        $(this).val($(this).val().replace(/\s/g, ""));
    });
}