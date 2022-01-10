<?php
require_once("bootstrap.php");

if (
    isset($_POST["address"])
    && isset($_POST["payment"])
) {

    $address = $_POST["address"] == "first-floor" ? Address::FIRST_FLOOR : Address::GROUND_FLOOR;
    $payment_type = $_POST["payment"] == "consegna" ? PaymentType::CASH_ON_DELIVERY : PaymentType::CREDIT_CARD;

    $db_helper->update_address($address);
    $db_helper->update_payment_type($payment_type);
    if (
        !empty($_POST["card-number"])
        && !empty($_POST["owner"])
        && !empty($_POST["expiration"])
        && !empty($_POST["code"])
    ) {

        $month = substr($_POST["expiration"], 0, 2);

        if (
            !empty($_POST["expiration"])
            && strlen($_POST["expiration"]) == 5
        ) {
            $expiry_time = \DateTime::createFromFormat(
                'm/y',
                $_POST["expiration"]
            )->modify('+1 month first day of midnight');
        }
        $current_time = new \DateTime('now');

        if (strlen($_POST["card-number"]) != 19) {
            $template_params["cc_number_error"] = "Numero carta di credito non valido (16 cifre).";
        } else if (
            strlen($_POST["expiration"]) != 5
            || intval($month) < 1
            || intval($month) > 12
            || $expiry_time < $current_time
        ) {
            $template_params["expiration_error"] = "Inserire una data di scadenza valida.";
        } else if (strlen($_POST["code"]) != 3) {
            $template_params["code_error"] = "Il codice deve essere di 3 cifre.";
        } else {
            header("Location:order-confirmation.php");
        }
    } else if ($payment_type == PaymentType::CASH_ON_DELIVERY) {
        header("Location:order-confirmation.php");
    }
}


if (!is_user_logged_in()) {
    header("Location:login.php");
} else if (empty($db_helper->get_cart_products())) {
    header("Location:home.php");
} else {
    $template_params["title"] = "Pagamento";
    $template_params["name"] = "payment-template.php";
    $template_params["css"] = array("payment");
    $template_params["js"] = array("payment");
}


require("template/base-template.php");
