<!DOCTYPE html>
<html lang="it">

<head>
    <?php require_once("./common/head.php"); ?>
    <?php
    if (isset($template_params["css"])) :
        foreach ($template_params["css"] as $css) : ?>
            <link rel="stylesheet" type="text/css" href="./css/<?php echo $css; ?>.css?<?php echo time(); ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
    <title><?php echo $template_params["title"]; ?> | Eat Up</title>
</head>

<body>
    <main>
        <?php require($template_params["name"]); ?>
    </main>
    <?php
    if (isset($template_params["js"])) :
        foreach ($template_params["js"] as $js) : ?>
            <script src="./js/<?php echo $js; ?>.js?<?php echo time(); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>