<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estadisticas</title>
    <link rel="shortcut icon" href="<?= URL . 'src/img/favicon.png' ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= URL . 'src/Libs/icons/font/typicons.css' ?>">
    <link rel="stylesheet" href="<?= URL . 'src/Libs/fonts/Bitter-Regular/style.css' ?>">
    <link rel="stylesheet" href="<?= URL . 'src/Libs/fonts/Helvetica/style.css' ?>">
    <link rel="stylesheet" href="<?= URL . 'src/css/header.css' ?>">
    <link rel="stylesheet" href="<?= URL . 'src/css/footer.css' ?>">
    <link rel="stylesheet" href="<?= URL . 'src/css/stats.css' ?>">

</head>
<body>
<?php
require_once ROOT . "src/View/Partials/Header.php";
?>
<div id="data-charts-crude" hidden></div>
<div id="san"></div>
<div id="box-stats">
    <div id="box-charts">
        <div class="charts">
            <iframe src="<?= URL . 'src/View/charts/chartForms.php' ?>" class="doc-charts" scrolling="no"></iframe>
        </div>
        <div class="charts" id="select-quest-forms">
            <iframe src="<?= URL . 'src/View/charts/chartQuest.php' ?>" class="doc-charts" scrolling="no"></iframe>
        </div>
    </div>
</div>
<footer>
    <?php
    require_once ROOT . "src/View/Partials/Footer.php";
    ?>
</footer>
</body>
</html>