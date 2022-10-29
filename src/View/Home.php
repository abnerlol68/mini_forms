<pre style="font-size: 1.1rem;">
  <?php
  ?>
</pre>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Forms</title>
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
      display: grid;
      justify-items: center;
      align-content: space-around;
      background-color: #FFF;
      border: 2px solid #000;
    }

    .box-form__goto {
      width: 6.4rem;
      height: 6.4rem;
      background-repeat: no-repeat;
      background-color: transparent;
      background-image: url("src/img/icon-form.png");
    }

    .box-form__goto:hover {
      filter: invert(10%);
    }

    .box-form__title {
    }

    .box-form__remove {
      width: 3rem;
      height: 3rem;
      border: none;
      background-size: 2.8rem;
      background-repeat: no-repeat;
      background-color: transparent;
      background-image: url("src/img/remove.png");
    }

    .box-form__remove:hover {
      background-image: url("src/img/remove-hover.png");
    }

    .new-form {
      display: flex;
      justify-content: center;
      background-image: url('src/img/add.png');
      background-repeat: no-repeat;
      background-position: center 6rem;
    }

    .new-form:hover {
      background-image: url('src/img/add-hover.png');
    }

    .new-form__title {
      margin-bottom: 3rem;
      align-self: flex-end;
    }

    /* .new-form img {
      position: relative;
      top: 1.5rem;
    }

    .new-form img:hover {
      filter: invert(40%);
    } */

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
  <script src="<?= URL . 'src/App/Home.js' ?>" type="module">
  </script>
</head>

<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="user" style="display: none;"><?= $_SESSION["user"]["user_admin"] ?></p>
  <main>
  </main>
</body>

</html>