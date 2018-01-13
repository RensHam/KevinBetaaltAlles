<?php
/**
 * @var string $payer
 */
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description"
          content="Aangezien je voor iedereen betaalt is het vanzelfsprekend dat je ook voor jezelf betaalt <?= htmlentities(ucfirst($payer)) ?>">

    <meta charset="UTF-8">
    <title>Natuurlijk</title>
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
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <h1 class="font-weight-bold text-center">Natuurlijk betaal je voor jezelf</h1>
    </div>
</div>
</body>
</html>