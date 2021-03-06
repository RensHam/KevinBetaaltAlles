<?php
/**
 * @var int $cost
 * @var string $name
 * @var string $payer
 */
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="<?= htmlentities(ucfirst($payer)) ?> betaalt altijd alles">

    <title><?= htmlentities(ucfirst($payer)) ?> betaalt alles</title>
    <?php require_once 'main_css.php' ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111964650-1"></script>
    <script async src="/assets/load_css.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-111964650-1');
    </script>

</head>
<body onload="downloadCss()">
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <h1 class="font-weight-bold text-center"><?= htmlentities(ucfirst($payer)) ?> heeft
            voor <?= htmlspecialchars(ucfirst($name)) ?> &euro;<?= $cost ?> betaald</h1>
    </div>
</div>

</body>
</html>
