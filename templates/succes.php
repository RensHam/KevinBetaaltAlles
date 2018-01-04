<?php
/**
 * @var int $cost
 * @var string $name
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="Kevin betaalt altijd alles">

    <title>Kevin betaalt alles</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
</head>
<body>
<h1 class="centered">Kevin heeft voor <?= htmlspecialchars(ucfirst($name)) ?> &euro; <?= $cost?> betaald </h1>

</body>
</html>