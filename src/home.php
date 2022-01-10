<?php
require_once("bootstrap.php");

if (!is_user_logged_in()) {
    header("Location:login.php");
} else {
    $template_params["title"] = "Menù";
    $template_params["name"] = "home-template.php";
    $template_params["icon"] = "home";
    $template_params["css"] = array("home");
    $template_params["js"] = array("home");
}

require("template/navbar-template.php");
