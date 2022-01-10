<?php
$confirmation = $template_params["confirmation"];
?>
<div class="page-container center">

    <div class="skill">
        <div class="outer">
            <div class="inner">
                <div id="number" class="number">
                </div>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
            <defs>
                <linearGradient id="GradientColor">
                    <stop offset="0%" stop-color="#e91e63" />
                    <stop offset="100%" stop-color="#673ab7" />
                </linearGradient>
            </defs>
            <circle cx="80" cy="80" r="70" stroke-linecap="round" />
        </svg>
    </div>

    <img id="successful-order" class="remove successful-order" src="./img/icon/2d/special/successful_order.svg" alt="" />

    <div class="order-summary">
        <p>Ordine #<?php echo $confirmation["id_order"]; ?></p>
        <p>&euro; <?php echo $confirmation["total_price"]; ?></p>
        <p>Grazie per l'ordine!</p>
        <p>
            Il tuo ordine è stato preso in carico e
            presto un fattorino lo consegnerà
            presso il campus in <?php echo $confirmation["shipping_address"]; ?>
        </p>

        <a class="go-to" href="home.php">Torna alla Home</a>
    </div>

    <div class="notification-content">
        <div id="modal-notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="./img/icon/favicon/favicon.svg" class="me-2 notification-logo" alt="" />
                <strong class="me-auto">Ordine #<?php echo $confirmation["id_order"]; ?></strong>
                <small>Ora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Il tuo ordine è in fase di preparazione.
            </div>
        </div>
    </div>
</div>
<script src="./js/order-confirmation-animation.js?<?php echo time(); ?>"></script>