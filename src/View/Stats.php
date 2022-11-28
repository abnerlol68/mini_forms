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
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="stylesheet" href="src/css/stats.css">
<!--    <script src="--><?//= URL . 'src/View/Stats.js' ?><!--" type="module"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>-->
</head>
<body>
<?php
require_once ROOT . "src/View/Partials/Header.php";
?>
<div id="san"></div>
<div id="box-stats">
    <div id="box-charts">
        <div class="charts">
            <iframe src="<?= URL . 'src/View/barChart.html' ?>" class="doc-charts" scrolling="no"></iframe>
        </div>
        <div class="charts">
            <iframe src="<?= URL . 'src/View/pieChart.html' ?>" class="doc-charts" scrolling="no"></iframe>
        </div>
    </div>
</div>
<footer>
    <?php
    require_once  ROOT . "src/View/Partials/Footer.php";
    ?>
</footer>
</body>
</html>

<script>
    // async function getData(){
    //     return await fetch("request/?req=charting").then(data => data.json());
    // }
    //
    // document.addEventListener('DOMContentLoaded', async () => {
    //     let dataRecovered = await getData();
    //     console.log(dataRecovered);
    // });
</script>
