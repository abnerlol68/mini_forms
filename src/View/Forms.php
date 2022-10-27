<!--<pre style="font-size: 1.1rem;">-->
  <?php
  require_once 'src/Libs/Database.php';

  $forms = $conn->query('SELECT * FROM forms');
  ?>
<!--</pre>-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formularios</title>
    <?php
    require_once ROOT."src/View/Partials/Header.scripts.php";
    ?>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      font-size: 62.5%;
    }

    body {
      width: 100vw;
      min-height: 100vh;
      font-family: Helvetica, Arial, sans-serif;
      background-color: #5fbae9;
    }

    header {
      display: flex;
      margin-top: 1.5rem;
      margin-bottom: 2.6rem;
      padding: 0 4rem;
      justify-content: space-between;
      height: 10rem;
    }

    main {
      display: grid;
      justify-content: center;
      grid-template-columns: repeat(3, auto);
    }

    .box-form {
      width: 24rem;
      height: 24rem;
      margin: 2rem;
      padding-top: 1rem;
      display: grid;
      justify-items: center;
      align-content: space-around;
      background-color: #FFF;
      border: 2px solid #000;
      color: #000;
      text-decoration: none;
    }

    .box-form:hover {
      cursor: pointer;
    }

    .box-form>img:hover {
      filter: invert(10%);
    }

    .box-form__title {
      height: 4rem;
      display: flex;
      justify-content: center;
      align-items: center;
      width: inherit;
      font-size: 1.4rem;
      text-overflow: clip;
    }

    /* .box-form__title>img {
      padding: 0.5rem;
      position: relative;
      bottom: 0.2rem;
      left: 5.5rem;
    }

    .box-form__title>img:hover {
      cursor: pointer;
      background-color: rgb(192, 192, 192);
      border-radius: 5rem;
    } */

    .new-form img {
      position: relative;
      top: 1.5rem;
    }

    .new-form img:hover {
      filter: invert(40%);
    }

    .btn-menu {
      width: 4rem;
      height: 4rem;
      display: grid;
      padding: 0.2rem 0;
      position: absolute;
      justify-content: center;
      background-color: #FFF;
      border-top: 2px solid #000;
      border-bottom: 2px solid #000;
      border-right: 2px solid #000;
      border-radius: 0 0.8rem 0.8rem 0;
    }

    .btn-menu:hover {
      filter: invert(20%);
    }

    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
  </style>

  <script src="<?= constant('URL') . 'src/Libs/Forms.js' ?>" type="module">
  </script>
</head>

<body>
<?php
require_once ROOT."src/View/Partials/Header.php";
?>
  <main>
    <?php foreach ($forms as $form) : ?>
      <a class="box-form" href="<?= constant('URL') . 'form_builder/?id=' . $form['id_form'] ?>">
        <img src="public/assets/img/icon-form.png">
        <span class="box-form__title">
          <?= $form['title_form'] ?>
          <!-- <img src="public/assets/img/icon-more.png"> -->
        </span>
      </a>
    <?php endforeach ?>
    <!-- New Form -->
    <a class="box-form new-form" href="#">
      <img src="public/assets//img/icon-plus.png">
      <span class="box-form__title">
        Nuevo Formulario
      </span>
    </a>
  </main>
</body>

</html>