<?php
/**
 * @var array $words
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
            <table class="table">
                <thead>
                <tr>
                    <th>Word</th>
                    <th>Count</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($words as $word => $count): ?>
                    <tr>
                        <td><?= htmlentities($word) ?></td>
                        <td><?= $count ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>



