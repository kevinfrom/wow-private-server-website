<?php
/**
 * @var string              $appVersion
 * @var \App\View\Templater $this
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pik til Patrick - World of Warcraft Classic Private Server (1.12.1)</title>
    <meta name="robots" content="noindex">
    <link href="/favicon.png" rel="icon" type="image/png">
    <link href="/main.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <?= $this->element('header') ?>

    <main>
        <?= $this->element('characters') ?>

        <div class="container">
            <div class="grid">
                <?= $this->element('signup') ?>
                <?= $this->element('change-password') ?>
            </div>
        </div>

        <div class="container">
            <?= $this->element('connect') ?>
        </div>
    </main>

    <?= $this->element('footer') ?>
</div>

<script src="/main.js"></script>
</body>
</html>
