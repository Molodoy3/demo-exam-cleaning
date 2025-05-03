<?php

/** @var string $title */
/** @var string $contentFile */

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Мой не сам - <?= $title; ?></title>
</head>
<body>
    <?php include __DIR__ . '/../Components/header.php'; ?>

    <?php include __DIR__ . '/../' . $contentFile; ?>

    <?php include __DIR__ . '/../Components/footer.php'; ?>

    <script src="/public/js/script.js"></script>
</body>
</html>