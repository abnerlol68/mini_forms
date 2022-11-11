<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Forms</title>
    <link rel="stylesheet" href="src/Libs/icons/font/typicons.css">
    <link rel="stylesheet" href="src/css/header.css">
    <link rel="shortcut icon" href="src/img/favicon.png" type="image/x-icon">
    <script src="<?= URL . 'src/App/Home.js' ?>" type="module"></script>
    <link rel="stylesheet" href="src/css/forms.css">
</head>

<body>
<?php
require_once ROOT . "src/View/Partials/Header.php";
?>
<br>
<br>
<br>
<br>
<p id="url" style="display: none;"><?= URL ?></p>
<p id="user" style="display: none;"><?= $_SESSION["user"]["user_admin"] ?></p>
<main id="main">
</main>
</body>

</html>