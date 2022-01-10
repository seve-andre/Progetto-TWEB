<!DOCTYPE html>
<html lang="it">

<head>
    <?php require_once("./common/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="./css/navbar.css?<?php echo time(); ?>">
    <?php
    if (isset($template_params["css"])) :
        foreach ($template_params["css"] as $css) : ?>
            <link rel="stylesheet" type="text/css" href="./css/<?php echo $css; ?>.css?<?php echo time(); ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
    <title><?php echo $template_params["title"]; ?> | Eat Up</title>
</head>

<body>
    <?php require_once("./common/navbar.php"); ?>
    <main>
        <?php require $template_params["name"]; ?>
    </main>
    <?php
    if (isset($template_params["js"])) :
        foreach ($template_params["js"] as $js) : ?>
            <script src="./js/<?php echo $js; ?>.js?<?php echo time(); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $("#<?php echo $template_params["icon"]; ?>").attr("src", "./img/icon/2d/filled/<?php echo $template_params["icon"]; ?>.svg");
            $("#<?php echo $template_params["icon"]; ?>").next().css("font-weight", "bold");
        });
    </script>
</body>

</html>