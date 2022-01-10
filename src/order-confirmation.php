<?php
require_once("bootstrap.php");

if (empty($db_helper->get_cart_products())) {
    header("Location:home.php");
} else {
    $template_params["title"] = "Conferma Ordine";
    $template_params["name"] = "order-confirmation-template.php";
    $template_params["css"] = array("order-confirmation");
    $template_params["js"] = array("order-confirmation-animation");
    $template_params["confirmation"] = $db_helper->get_order_confirmation();
    $db_helper->update_status(OrderStatus::PAID);
    $db_helper->add_notification();
    unset($_SESSION["id_order"]);
}

require("template/base-template.php");
