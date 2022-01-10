<?php
function is_user_logged_in()
{
    return isset($_SESSION["id_user"]);
}

function session_logged_user($user)
{
    $_SESSION["id_user"] = $user["id_user"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["username"] = $user["username"];
}

function log_out()
{
    session_destroy();
    unset($_SESSION);
    header("Location:login.php");
    exit;
}

function is_password_valid($password)
{
    $regex = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{10,512})/";
    return preg_match($regex, $password);
}

function is_email_valid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_payment_on()
{
    return isset($_SESSION["id_order"]);
}

function translate_category($category)
{
    return array_search($category, Category::$category_translation);
}
