<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Forms</title>
    <link rel="stylesheet" href="src/Libs/icons/font/typicons.css">
    <link rel="stylesheet" href="src/css/header.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="shortcut icon" href="src/img/favicon.png" type="image/x-icon">
    <script src="<?= URL . 'src/App/Home.js' ?>" type="module"></script>
    <link rel="stylesheet" href="src/css/forms.css">
</head>

<body>
<?php
require_once ROOT . "src/View/Partials/Header.php";
?>
<div id="san"></div>
<div>
    <p id="url" style="display: none;"><?= URL ?></p>
    <p id="user" style="display: none;"><?= $_SESSION["user"]["user_admin"] ?></p>

    <div id="body-home">
        <div id="box-search">
            <input type="text" name="search" id="search" placeholder="¿Qué nombre tiene el formulario?">
            <i id="icon" class="typcn typcn-zoom"></i>
        </div>
        <main id="main">
        </main>
    </div>
</div>

<footer>
    <?php
    require_once  ROOT . "src/View/Partials/Footer.php";
    ?>
</footer>
</body>

</html>