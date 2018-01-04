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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-111964650-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-111964650-1');
    </script>
</head>
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <p>Wegens een overschot aan geld is Kevin begonnen met alles voor iedereen betalen. Voor verdere informatie kunt u
            contact opnemen met Kevin, te bereiken op <a href="mailto:declaratie@kevinbetaaltalles.nl" target="#">declaratie@kevinbetaaltalles.nl</a>
        </p>
        <form method="post">
            <div class="form-group" >
                <label for="">Wie ben je?</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Piet">
            </div>
            <div class="form-group">
                <label for="">Hoeveel</label>
                <input type="number" name="geld" class="form-control" id="formGroupExampleInput2" placeholder="4747">
            </div>
            <div class="form-group" >
                <label for="">Waarvoor betaalt Kevin?</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="wat" placeholder="Een huis...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
            <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">
        </form>
    </div>
</div>
</body>
</html>



