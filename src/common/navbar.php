<?php $navbar = array(
    "Home" => array(
        "ref" => "home.php",
        "image" => "./img/icon/2d/normal/home.svg",
        "image_name" => "home"
    ),
    "Notifiche" => array(
        "ref" => "notifications.php",
        "image" => "./img/icon/2d/normal/bell.svg",
        "image_name" => "bell"
    ),
    "Carrello" => array(
        "ref" => "cart.php",
        "image" => "./img/icon/2d/normal/shopping_cart.svg",
        "image_name" => "shopping_cart"
    ),
    "Profilo" => array(
        "ref" => "profile.php",
        "image" => "./img/icon/2d/normal/user.svg",
        "image_name" => "user"
    )
); ?>

<?php
$unseen_notifications = array();
$notifications = $db_helper->get_notifications();
foreach ($notifications as $notification) {
    if ($notification["seen"] == "0") {
        array_push($unseen_notifications, $notification);
    }
}
$total = count($unseen_notifications);
?>
<nav class="navbar">
    <ul>
        <?php foreach ($navbar as $label => $utils) : ?>
            <li>
                <a href="<?php echo $utils["ref"] ?>" <?php echo $label == "Notifiche" ? " class='position-relative'" : ""; ?>>
                    <?php if ($label == "Notifiche") : ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger<?php echo $total == 0 ? " remove" : ""; ?>">
                            <?php echo $total; ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    <?php endif; ?>
                    <div class="box">
                        <img id="<?php echo $utils["image_name"]; ?>" src="<?php echo $utils["image"] ?>" alt="" />
                        <p><?php echo $label ?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>