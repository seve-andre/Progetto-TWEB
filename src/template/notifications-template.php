<div class="page-container">
    <div class="content-container">
        <header class="page-header">
            <h1><?php echo $template_params["title"]; ?></h1>
        </header>

        <?php if (empty($template_params["notifications"])) : ?>
            <div class="empty-page">
                <div class="img-center">
                    <img class="empty-page-img" src="./img/icon/3d/illustrations/floating.svg" alt="" />
                </div>
                <h2>Non ci sono notifiche</h2>
                <p>Ti faremo sapere quando ci sono notizie per te.</p>
            </div>
        <?php endif; ?>

        <div class="cards-container notifications-cards<?php echo empty($template_params["notifications"]) ? " remove" : ""; ?>">
            <?php foreach ($template_params["notifications"] as $notification) : ?>
                <div id="<?php echo $notification["id_notification"]; ?>" class="h-card<?php echo $notification["seen"] == 0 ? " position-relative" : ""; ?>">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger<?php echo $notification["seen"] == 1 ? " remove" : ""; ?>">
                        NEW
                    </span>
                    <div class="img-center profile-pic">
                        <img class="deliverer" src="<?php echo "./img/deliverers/" . $notification["delivery_man_img"]; ?>" alt="" />
                    </div>

                    <div class=" h-card-details">
                        <div class="h-card-header">
                            <h2 class="normal-text">Ordine #<?php echo $notification["id_order"]; ?></h2>
                        </div>
                        <div>
                            <p class="small-text">Il tuo ordine è in arrivo. La consegna è stata
                                incaricata a <strong class="small-text"><?php echo $notification["delivery_man_name"]; ?></strong>.</p>
                        </div>
                        <div class="h-card-time">
                            <p class="tiny-text"><?php echo $notification["order_date"]; ?></p>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>