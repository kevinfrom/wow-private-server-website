<?php
/**
 * @var string              $appVersion
 * @var array               $characters
 * @var bool                $characterListEnabled
 * @var bool                $signupEnabled
 * @var bool                $changePasswordEnabled
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
    <link href="/main.min.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <?= $this->element('header') ?>

    <main>
        <?php if ($characterListEnabled) { ?>
            <?= $this->element('characters') ?>
        <?php } ?>

        <div class="container">
            <div class="grid">
                <?php if ($signupEnabled) { ?>
                    <?= $this->element('signup') ?>
                <?php } ?>

                <?php if ($changePasswordEnabled) { ?>
                    <?= $this->element('change-password') ?>
                <?php } ?>
            </div>
        </div>

        <div class="container">
            <?= $this->element('connect') ?>
        </div>
    </main>

    <?= $this->element('footer') ?>
</div>

<script src="/main.min.js"></script>
</body>
</html>
