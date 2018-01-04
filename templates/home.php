<?php
/**
 * @var int $total
 * @var int $count
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="Kevin betaalt altijd alles">

    <meta charset="UTF-8">
    <title>Natuurlijk</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>
<body>
<div class="pull">
    <main class="main">
        <div class="container">
            <div class="text-center">
                <h1 class="font-weight-bold home">Kevin betaalt altijd alles</h1>
                <p class="home">Wegens een overschot aan geld is Kevin begonnen met alles voor iedereen te betalen. Voor
                    verdere informatie kunt u contact opnemen met Kevin, te bereiken op
                    <a href="mailto:declaratie@kevinbetaaltalles.nl" target="#">declaratie@kevinbetaaltalles.nl</a>
                </p>
            </div>
        </div>
    </main>
    <div class="push"></div>
</div>
<footer>
    <div class="container">
        <span class="text-muted text-center">Er zijn al <?= $count ?> betalingen gemaakt door Kevin met een totale waarde van &euro; <?= $total ?></span>
    </div>
</footer>
</body>
</html>
