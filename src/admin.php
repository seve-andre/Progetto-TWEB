<?php
require_once("bootstrap.php");

if (!$db_helper->is_admin()) {
    header("Location:home.php");
} else {
    $template_params["title"] = "Ordini odierni";
    $template_params["name"] = "admin-home-template.php";
    $template_params["orders"] = $db_helper->get_today_orders();
    $template_params["css"] = array("admin");
}

require("template/base-template.php");
