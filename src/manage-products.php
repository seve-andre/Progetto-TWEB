<?php
require_once("bootstrap.php");

if (
    isset($_POST["remove_id_product"])
) {
    $db_helper->remove_product_from_order($_POST["remove_id_product"]);
}

if (
    isset($_POST["add_id_product"])
    && !$db_helper->is_product_in_cart($_POST["add_id_product"])
) {
    $db_helper->add_product_to_cart($_POST["add_id_product"]);
    echo "true";
}

if (
    isset($_POST["id_product"])
    && isset($_POST["quantity"])
    && isset($_POST["operation"])
) {
    $product_price = $db_helper->get_product_price($_POST["id_product"]);
    $db_helper->update_quantity_to($_POST["id_product"], $_POST["quantity"]);
    $db_helper->update_total_price($_POST["operation"] == "addition" ? $product_price : -$product_price);
}

if (
    isset($_POST["payment_type"])
) {

    if (str_contains($_POST["payment_type"], "consegna")) {
        $db_helper->update_payment_type(PaymentType::CASH_ON_DELIVERY);
    } else {
        $db_helper->update_payment_type(PaymentType::CREDIT_CARD);
    }
}

if (
    isset($_POST["address"])
) {
    $db_helper->update_address($_POST["address"]);
}

if (isset($_POST["id_notification"])) {
    $db_helper->see_notification($_POST["id_notification"]);
}

if (
    isset($_POST["category"])
    || isset($_POST["search_product"])
) :

    if (isset($_POST["category"])) {
        $translated_category = translate_category($_POST["category"]);
        $products = $db_helper->get_products_from_category($translated_category);
    } else {
        $products = $db_helper->search_input_product($_POST["search_product"]);
    }

    foreach ($products as $product) : ?>
        <div id="<?php echo $product["id_product"]; ?>" class="card">
            <div class="product-img-container">
                <img class="product-img" src="<?php echo PRODUCTS_DIR . strtolower($product["category_name"]) . "/" . $product["product_img"]; ?>" alt="" />
            </div>
            <div class="card-body">
                <div class="product-details">
                    <?php if ($product["rating"] > 0) : ?>
                        <div class="single-detail">
                            <div class="img-center">
                                <img src=" ./img/icon/2d/special/star.png" alt="valutazione" data-bs-toggle="tooltip" data-bs-placement="bottom" title="valutazione" />
                            </div>
                            <p><?php echo $product["rating"]; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($product["kcal"] > 0) : ?>
                        <div class="single-detail">
                            <div class="img-center">
                                <img src="./img/icon/2d/special/fire.png" alt="rapporto calorico" data-bs-toggle="tooltip" data-bs-placement="bottom" title="rapporto calorico" />
                            </div>
                            <p><?php echo $product["kcal"]; ?>&nbsp;kcal</p>
                        </div>
                    <?php endif; ?>
                </div>

                <h4 class="card-title"><?php echo $product["product_name"]; ?></h4>
                <p class="card-text"><?php echo $product["description"]; ?></p>

                <div class="v-card-footer">
                    <h5>&euro;&nbsp;<span><?php echo $product["price"]; ?></span></h5>
                    <button class="add-to-cart">
                        <?php echo $db_helper->is_product_in_cart($product["id_product"]) ? "&#10004;" : "+"; ?>
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>