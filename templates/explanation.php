<?php
/**
 * @var int $total
 * @var int $count
 * @var string $payer
 */

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="Opzoek naar iemand die alles betaalt">

    <meta charset="UTF-8">
    <title>Natuurlijk</title>
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
    <div class="text-center">
        <h1 class="font-weight-bold">Te weinig geld?</h1>
        <p> Wie gaat er vandaag voor iedereen betalen?</p>
    </div>
    <div class="row justify-content-center align-items-center">
        <form onsubmit="return goToLink();">
            <div class="form-group">
                <label for="name">Wie betaalt er</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Piet">
            </div>
            <div class="form-group">
                <label for="wat">Voor wie word er betaalt?</label>
                <input type="text" class="form-control" id="wat" name="wat" placeholder="Henk">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
<script>
    function goToLink() {
        window.location.href = 'http://' + document.getElementById('name').value + '.betaaltalles.nl/' + document.getElementById('wat').value;
        return false;
    }
</script>
</html>
