<?php
/** @var string $name */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="Kevin betaalt altijd alles">

    <title>Kevin betaalt alles</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <h1 class="font-weight-bold text-center">Kevin betaalt alles voor <?= htmlspecialchars(ucfirst($name)) ?></h1>
    </div>
</div>

</body>
</html>