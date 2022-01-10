<?php
require_once("bootstrap.php");

if (!is_user_logged_in()) {
    header("Location:login.php");
} else {
    $template_params["title"] = "Notifiche";
    $template_params["name"] = "notifications-template.php";
    $template_params["icon"] = "bell";
    $template_params["css"] = array("notifications");
    $template_params["js"] = array("notifications");
    $template_params["notifications"] = $db_helper->get_notifications();
}

require("template/navbar-template.php");
