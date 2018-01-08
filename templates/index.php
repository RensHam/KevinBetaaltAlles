<?php
/**
 * @var string $name
 * @var string $payer
 * @var Payments $payments
 */
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="<?= htmlentities(ucfirst($payer)) ?> betaalt altijd alles">

    <title><?= htmlentities(ucfirst($payer)) ?> betaalt alles</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111964650-1"></script>
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
    <div class="row h-100 justify-content-center text-center align-items-center">
        <div class="container">
            <h1 class="font-weight-bold"><?= htmlentities(ucfirst($payer)) ?> betaalt alles
                voor <?= htmlspecialchars(ucfirst($name)) ?></h1>
            <small class="form-text text-muted">Er zijn al <?= $payments->count ?> betalingen gemaakt
                door <?= htmlentities(ucfirst($payer)) ?> voor <?= htmlspecialchars(ucfirst($name)) ?> met een totale waarde
                van &euro;<?= (int)$payments->amount ?></small>
            <small class="form-text text-muted">
                Voer een nieuwe declaratie in op <a href="/add/payment/<?= htmlspecialchars(ucfirst($name)) ?>"> http://<?= htmlentities($payer) ?>.betaaltalles.nl/add/payment</a>
            </small>
        </div>
    </div>
</div>

</body>
</html>