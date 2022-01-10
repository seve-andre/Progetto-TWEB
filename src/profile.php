<?php
require_once("bootstrap.php");

if (!is_user_logged_in()) {
    header("Location:login.php");
} else {
    $template_params["title"] = "Profilo";
    $template_params["name"] = "profile-template.php";
    $template_params["icon"] = "user";
    $template_params["orders"] = $db_helper->get_user_orders();
}

require("template/navbar-template.php");
