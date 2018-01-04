<?php
/**
 * @var string $nameKey
 * @var string $valueKey
 * @var string $name
 * @var string $value
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
</head>
<body>
<p>Wegens een overschot aan geld is Kevin begonnen met alles voor iedereen betalen. Voor verdere informatie kunt u
    contact opnemen met Kevin, te bereiken op <a href="mailto:declaratie@kevinbetaaltalles.nl" target="#">declaratie@kevinbetaaltalles.nl</a>
</p>
<form method="post">
    <label>
        je naam: <input type="text" name="name">
    </label>
    <label>
        hoeveel: <input type="number" name="geld">
    </label>
    <label>
        wat: <input type="text" name="wat">
    </label>
    <input type="submit">
    <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
    <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">
</form>
</body>
</html>



