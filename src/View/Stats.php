<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estadisticas</title>
    <link rel="shortcut icon" href="src/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="src/Libs/icons/font/typicons.css">
    <link rel="stylesheet" href="src/css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="<?= URL . 'src/View/Stats.js' ?>" ></script>
</head>
<body>

<?php
require_once ROOT . "src/View/Partials/Header.php";
?>

<br>
<br>
<br>
<br>
<div id="chart">
</div>
</body>
</html>
