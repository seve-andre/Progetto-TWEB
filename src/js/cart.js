$(document).ready(function () {
    let n_products = parseInt($("#n_products").text());
    if (n_products > 1) {
        // gets "articolo"
        $(".page-header p").contents().get(2).nodeValue = "articoli";
    }

    $(".adder-action").on("click", function () {

        let button = $(this);

        let quantityField = button.parent().find(".quantity");
        let quantity = parseInt(quantityField.val());
        let price = parseFloat($(this).closest(".h-card").find(".product-price-quantity p span").text());
        let totalProductsPrice = parseFloat($(".detail:nth-child(1) > p:nth-child(2) > span:nth-child(1)").text());
        let totalPrice = parseFloat($(".total-price p span").text());
        let newTotalProductsPrice;
        let newTotalPrice;

        $(".quantity").attr("maxlength", "1");

        if (button.hasClass("add-item") && quantity < 25) {
            quantityField.attr("value", quantity + 1);
            newTotalProductsPrice = parseFloat(totalProductsPrice + price).toFixed(2);
            newTotalPrice = parseFloat(totalPrice + price).toFixed(2);
            button.closest(".h-card").find(".quantity-detail").removeClass("hidden").find(".quantity-text").text("x" + (quantity + 1).toString());


            $.post("manage-products.php",
                {
                    id_product: $(this).closest(".h-card").attr("id"),
                    quantity: quantity + 1,
                    operation: "addition"
                }
            );
        } else if (button.hasClass("subtract-item") && quantity > 1) {
            quantityField.attr("value", quantity - 1);
            newTotalProductsPrice = parseFloat(totalProductsPrice - price).toFixed(2);
            newTotalPrice = parseFloat(totalPrice - price).toFixed(2);
            if ((quantity - 1) > 1) {
                button.closest(".h-card").find(".quantity-detail").removeClass("hidden").find(".quantity-text").text("x" + (quantity - 1).toString());
            } else {
                button.closest(".h-card").find(".quantity-detail").addClass("hidden");
            }

            $.post("manage-products.php",
                {
                    id_product: $(this).closest(".h-card").attr("id"),
                    quantity: quantity - 1,
                    operation: "subtraction"
                }
            );
        }
        $(".detail:nth-child(1) > p:nth-child(2) > span:nth-child(1)").text(newTotalProductsPrice);
        $(".total-price p span").text(newTotalPrice);
    });

    $(".remove-card").click(function () {
        if ($(".h-card").length == 1) {
            $("#remove-items").click();
        } else {

            let id_product = $(this).closest(".h-card").attr("id");
            let quantity = $(this).closest(".h-card").find("#quantity").val();

            $.post("manage-products.php",
                {
                    remove_id_product: id_product
                }
            );

            let price = $(this).closest(".h-card").find(".product-price-quantity p span").text();
            let totalProductsPrice = $(".detail:nth-child(1) > p:nth-child(2) > span:nth-child(1)").text();
            let totalPrice = $(".total-price p span").text();

            let newTotalProductsPrice = parseFloat(totalProductsPrice - price * quantity).toFixed(2);
            let newTotalPrice = parseFloat(totalPrice - price * quantity).toFixed(2);

            $(".detail:nth-child(1) > p:nth-child(2) > span:nth-child(1)").text(newTotalProductsPrice);
            $(".total-price p span").text(newTotalPrice);

            $(this).closest(".h-card").remove();
        }
    });

    $("#remove-items").click(function () {

        $(".h-card").each(function () {
            $.post("manage-products.php",
                {
                    remove_id_product: $(this).attr("id")
                }
            );
        });

        let header = $(".page-header");
        $(".cards-container").remove();
        $(".order-details").remove();
        $(header).find("p").remove();
        $(header).find("button").remove();

        let emptyPage = getEmptyCart();
        $(emptyPage).appendTo($(".content-container"));
    });
});

function getEmptyCart() {
    return `
        <div class="empty-page">
            <div class="img-center">
                <img class="empty-page-img" src="./img/icon/3d/illustrations/bag.png" alt="" />
            </div>
            <h2>Il carrello è vuoto</h2>
            <p>Sembra che tu non abbia ancora aggiunto nulla al carrello.</p>
            <a href="home.php" class="go-to">Compra ora</a>
        </div>
        `;
}