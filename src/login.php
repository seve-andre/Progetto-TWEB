<?php
require_once("bootstrap.php");

if (isset($_POST["email"]) && isset($_POST["password"])) {


    // controllo se esiste l'utente
    $login_result = $db_helper->get_user_by_email($_POST["email"]);

    if (
        !empty($_POST["password"])
        && password_verify($_POST["password"], $login_result["password"])
    ) {
        session_logged_user($login_result);
    } else {
        $template_params["errore_email"] = "Inserisci un indirizzo email valido.";
        $template_params["errore_pwd"] = "Password errata.";
    }
}

if ($db_helper->is_admin()) {
    header("Location:admin.php");
} else if (is_user_logged_in()) {
    header("Location:home.php");
} else {
    $template_params["title"] = "Login";
    $template_params["name"] = "login-template.php";
    $template_params["css"] = array("login");
    $template_params["js"] = array("show-hide-pwd");
}

require("template/base-template.php");
