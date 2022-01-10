$(document).ready(function () {

    $.post("manage-products.php",
        {
            category: $(".active-v-card").find("span").text()
        },
        function (data) {
            $(".food-container .row").html(data);
            $(".category-details #n_products").text($(".card").length);
        }
    );

    $(".v-card").click(function () {
        if (!$(this).hasClass("active-v-card")) {
            let category = $(this).find("span").text();

            $(".v-card").each(function () {
                $(this).removeClass("active-v-card");
            });

            $(this).addClass("active-v-card");
            $(".category-details h3").text(category);

            $.post("manage-products.php",
                {
                    category: category
                },
                function (data) {
                    $(".food-container .row").html(data);
                    $("#n_products").text($(".card").length);
                }
            );
        }
    });

    $(".v-card").click(function () {
        if (!$(this).hasClass("active-v-card")) {
            let category = $(this).find("span").text();

            $(".v-card").each(function () {
                $(this).removeClass("active-v-card");
            });

            $(this).addClass("active-v-card");
            $(".category-details h3").text(category);

            $.post("manage-products.php",
                {
                    category: category
                },
                function (data) {
                    $(".food-container .row").html(data);
                    $("#n_products").text($(".card").length);
                }
            );
        }
    });

    $("body").on("click", ".add-to-cart", function () {
        let id_product = $(this).closest(".card").attr("id");
        // codice ASCII del simbolo di conferma
        $(this).html("&#10004;");

        // Caricamento variabili per Toast
        let card = $(this).closest(".card");
        let title_card_selected = card.find(".card-title").text();
        let img_card_selected = card.find(".product-img").attr("src");

        let add_to_cart_toast = `
            <div id="toast-container-all" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100" style="position: fixed;bottom: 50%; right: 7%">
                <div class="notification-content">
                    <div id="liveToast" class="toast" role="alert" data-bs-delay="800" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="${img_card_selected}" class="me-2 notification-logo" alt="" />
                            <strong class="me-auto">${title_card_selected}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Aggiunto ${title_card_selected} al carrello
                        </div>
                    </div>
                </div>
            </div>
            `;
        $(".toast-insertion").html(add_to_cart_toast);


        // Evento JS per Toast
        let toastLiveExample = $("#liveToast");
        let toast = new bootstrap.Toast(toastLiveExample);

        $.post("manage-products.php",
            {
                add_id_product: id_product
            }, function (is_product_insert) {
                //Mostro il Toast solo quando per la prima volta viene aggiunto lo specifico prodotto altrimenti no
                if (is_product_insert) {
                    //Apparizione Toast
                    toast.show();
                }
            }
        );
    });

    $("#site-search").on("input", function () {

        let searchText = $(this).val();
        if (searchText.length > 0) {
            $(".category-details h3").text(`Risultati per "${searchText}"`);
            $.post("manage-products.php",
                {
                    search_product: searchText
                },
                function (data) {
                    $(".food-container .row").html(data);
                    $("#n_products").text($(".card").length);
                }
            );
        } else {
            let activeOption = $(".active-v-card").find("span").text();
            $(".category-details h3").text(activeOption);
            $.post("manage-products.php",
                {
                    category: activeOption
                },
                function (data) {
                    $(".food-container .row").html(data);
                    $("#n_products").text($(".card").length);
                }
            );
        }
    });
});