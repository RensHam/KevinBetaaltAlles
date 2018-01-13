<?php
/**
 * @var string $nameKey
 * @var string $valueKey
 * @var string $name
 * @var string $value
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
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="container">
            <p>
                Wegens een overschot aan geld is <?= htmlentities(ucfirst($payer)) ?> begonnen met alles voor iedereen
                te betalen. Voor verdere informatie kunt u contact opnemen met <?= htmlentities(ucfirst($payer)) ?>, te
                bereiken op
                <a href="mailto:kevinbetaaltalles@gmail.com" target="#">declaratie@<?= htmlentities($payer) ?>
                    betaaltalles.nl</a>
            </p>
            <form method="post">
                <div class="form-group">
                    <label for="name">Wie ben je?</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Piet"
                           value="<?= htmlspecialchars(ucfirst($who)) ?>">
                </div>
                <div class="form-group">
                    <label for="cash">Hoeveel</label>
                    <input type="number" name="geld" class="form-control" id="cash" placeholder="4747">
                </div>
                <div class="form-group">
                    <label for="wat">Waarvoor betaalt <?= htmlentities(ucfirst($payer)) ?>?</label>
                    <input type="text" class="form-control" id="wat" name="wat" placeholder="Een huis...">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
                <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">
            </form>
        </div>
    </div>
</div>
</body>
</html>



