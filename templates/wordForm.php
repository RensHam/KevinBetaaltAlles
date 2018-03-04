<?php
/**
 * @var string $nameKey
 * @var string $valueKey
 * @var string $name
 * @var string $value
 */

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <meta name="description" content="Word counter">

    <meta charset="UTF-8">
    <title>Word count</title>
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
            <form method="post">
                <div class="form-group">
                    <label for="text">Test text</label>
                    <textarea class="form-control" id="text" name="text" rows=3 placeholder="Bla foo,.."></textarea>
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



