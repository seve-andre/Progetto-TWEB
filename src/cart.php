<?php
require_once("bootstrap.php");

if (!is_user_logged_in()) {
    header("Location:login.php");
} else {
    $template_params["title"] = "Carrello";
    $template_params["name"] = "cart-template.php";
    $template_params["icon"] = "shopping_cart";
    $template_params["css"] = array("cart");
    $template_params["js"] = array("cart");
    $template_params["products"] = $db_helper->get_cart_products();
}

require("template/navbar-template.php");
