<?php
/**
 * @var Payments $payments
 * @var string $payer
 */

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="<?= htmlentities(ucfirst($payer)) ?> betaalt altijd alles">

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
<body onload="downloadCss()">
<div class="pull">
    <main class="main">
        <div class="container">
            <div class="text-center">
                <h1 class="font-weight-bold home"><?= htmlentities(ucfirst($payer)) ?> betaalt altijd alles</h1>
                <p class="home">Wegens een overschot aan geld is <?= htmlentities(ucfirst($payer)) ?> begonnen met alles voor iedereen te betalen. Voor
                    verdere informatie kunt u contact opnemen met <?= htmlentities(ucfirst($payer)) ?>, te bereiken op
                    <a href="mailto:kevinbetaaltalles@gmail.com" target="#">declaratie@<?= htmlentities($payer) ?>betaaltalles.nl</a> of voer
                    een declaratie in op <a href="/add/payment"> http://<?= htmlentities($payer) ?>.betaaltalles.nl/add/payment</a>
                </p>
            </div>
        </div>
    </main>
    <div class="push"></div>
</div>
<footer>
    <div class="container text-center">
        <span class="text-muted text-center">Er zijn al <?= $payments->count ?> betalingen gemaakt door <?= htmlentities(ucfirst($payer)) ?> met een totale waarde van &euro;<?= $payments->amount ?></span>
    </div>
</footer>
</body>
</html>
