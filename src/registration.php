<?php
require_once("bootstrap.php");

if (
    isset($_POST["name"])
    && isset($_POST["email"])
    && isset($_POST["password"])
) {

    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // controllo se l'email (deve essere UNICA per ogni utente) è già presente nel DB
    $email_taken = $db_helper->is_email_taken($email);
    $valid_email = is_email_valid($email);
    $valid_password = is_password_valid($password);


    if ($email_taken) {
        $template_params["errore_email"] = "Email già in uso.";
    } else if (!$valid_email) {
        $template_params["errore_email"] = "Email non corretta.";
    } else if (empty($_POST["email"])) {
        $template_params["errore_email"] = "Email non deve essere vuota.";
    } else if (empty($_POST["name"])) {
        $template_params["errore_nome"] = "Nome non può essere vuoto.";
    } else if (!$valid_password) {
        $template_params["errore_pwd"] = "Password errata.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db_helper->add_user_to_db($username, $email, $hashed_password);
        header("Location:login.php");
    }
}

if (is_user_logged_in()) {
    header("Location:home.php");
} else {
    $template_params["title"] = "Registrati";
    $template_params["name"] = "registration-template.php";
    $template_params["css"] = array("login");
    $template_params["js"] = array("registration", "show-hide-pwd");
}

require("template/base-template.php");
