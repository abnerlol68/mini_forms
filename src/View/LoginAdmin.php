<?php
use App\Database;
$db = new Database();
$conn = $db->get_conn();

$errMsg = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $errMsg = "Please fill all the fields.";
  } else {
      $statement = $conn->prepare("SELECT user_admin, password_admin FROM admins WHERE user_admin = :user_admin");
    $statement->execute([
      'user_admin' => $_POST['username']
    ]);
    
    if ($statement->rowCount() == 0) {
      $errMsg = "Invalid credentials.";
    } else {
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      if ($_POST["password"] != $user["password_admin"]) {
        $errMsg = "Invalid credentials.";
      } else {
        session_start();

        unset($user["password_admin"]);
        $_SESSION["user"] = $user;

        header('Location: ' . constant('URL') . 'home');
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="src/Libs/jquery/jquery-3.6.1.min.js"></script>
  <link rel="stylesheet" href="src/Libs/icons/font/typicons.css">
  <link rel="shortcut icon" href="public/assets/img/icons8-wolf-32.png" type="image/x-icon">
  <title>Login Admin</title>
  <style>
    /* @import url("https://fonts.googleapis.com/css?family=Poppins"); */

    /* BASIC */

    html {
      background-color: #56baed;
    }

    body {
      font-family: Helvetica, Arial, sans-serif;
      height: 100vh;
    }

    a {
      color: #92badd;
      display: inline-block;
      text-decoration: none;
      font-weight: 400;
    }

    h2 {
      text-align: center;
      font-size: 16px;
      font-weight: 600;
      text-transform: uppercase;
      display: inline-block;
      margin: 10px 8px 15px 8px;
      color: #0d0d0d;
      border-bottom: 2px solid #5fbae9;
    }

    /* Message to indicate that the user has been conected */
    #msg-done {
      display: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      text-align: center;
      background-color: #9B5DE5;
      color: #fff;
      /* height: fit-content; */
    }

    /* STRUCTURE */

    .wrapper {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      width: 100%;
      min-height: 100%;
      padding: 20px;
      position: absolute;
    }

    #formContent {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      transform: translate(-50%, -50%);
      background: white;
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
      border-radius: 10px;
      text-align: center;
    }

    .wrapper .user-box {
      position: relative;
      /* height: max-content; */
    }

    #formFooter {
      background-color: #f6f6f6;
      border-top: 1px solid #dce8f1;
      padding: 25px;
      width: 400px;
      text-align: center;
      -webkit-border-radius: 0 0 10px 10px;
      border-radius: 0 0 10px 10px;
    }

    /* FORM TYPOGRAPHY*/

    #btn-submit {
      background-color: #56baed;
      border: none;
      color: white;
      padding: 15px 80px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      text-transform: uppercase;
      font-size: 13px;
      -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
      box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;
      margin: 10px 20px 10px 20px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -ms-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
    }

    #btn-submit:hover {
      background-color: #39ace7;
    }

    #btn-submit:active {
      -moz-transform: scale(0.95);
      -webkit-transform: scale(0.95);
      -o-transform: scale(0.95);
      -ms-transform: scale(0.95);
      transform: scale(0.95);
    }

    #login,
    #password {
      color: #0d0d0d;
      padding: 10px 0px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: -1%;
      /* margin-bottom: 30px; */
      width: 85%;
      border: 2px solid #f6f6f6;
      -webkit-transition: all 0.5s ease-in-out;
      -moz-transition: all 0.5s ease-in-out;
      -ms-transition: all 0.5s ease-in-out;
      -o-transition: all 0.5s ease-in-out;
      transition: all 0.5s ease-in-out;
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;
      outline: none;
      background: transparent;
    }

    #login {
      margin-bottom: 20px;
    }

    #password {
      margin-bottom: 10px;
    }

    #login:focus,
    #password:focus {
      /* border: 2px transparent #f6f6f6; */
      border-bottom: 2px solid #5fbae9;
      outline: none;
      background: transparent;
    }

    /* ANIMATIONS */

    /* Simple CSS3 Fade-in-down Animation */
    .fadeInDown {
      -webkit-animation-name: fadeInDown;
      animation-name: fadeInDown;
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
    }

    @-webkit-keyframes fadeInDown {
      0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0);
      }

      100% {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
      }
    }

    @keyframes fadeInDown {
      0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0);
      }

      100% {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
      }
    }

    /* Simple CSS3 Fade-in Animation */
    @-webkit-keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @-moz-keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .fadeIn {
      opacity: 0;
      -webkit-animation: fadeIn ease-in 1;
      -moz-animation: fadeIn ease-in 1;
      animation: fadeIn ease-in 1;

      -webkit-animation-fill-mode: forwards;
      -moz-animation-fill-mode: forwards;
      animation-fill-mode: forwards;

      -webkit-animation-duration: 1s;
      -moz-animation-duration: 1s;
      animation-duration: 1s;
    }

    .fadeIn.first {
      -webkit-animation-delay: 0.4s;
      -moz-animation-delay: 0.4s;
      animation-delay: 0.4s;
    }

    .fadeIn.second {
      -webkit-animation-delay: 0.6s;
      -moz-animation-delay: 0.6s;
      animation-delay: 0.6s;
    }

    .fadeIn.lbs1 {
      -webkit-animation-delay: 0.7s;
      -moz-animation-delay: 0.7s;
      animation-delay: 0.7s;
    }

    .fadeIn.third {
      -webkit-animation-delay: 0.8s;
      -moz-animation-delay: 0.8s;
      animation-delay: 0.8s;
    }

    .fadeIn.lbs2 {
      -webkit-animation-delay: 0.9s;
      -moz-animation-delay: 0.9s;
      animation-delay: 0.9s;
    }

    .fadeIn.fourth {
      -webkit-animation-delay: 1s;
      -moz-animation-delay: 1s;
      animation-delay: 1s;
    }

    .fadeIn.five {
      -webkit-animation-delay: 0.3s;
      -moz-animation-delay: 0.3s;
      animation-delay: 0.3s;
    }

    #img-logo {
      margin-top: -50px;
    }

    /* Simple CSS3 Fade-in Animation */
    .underlineHover:after {
      display: block;
      left: 0;
      bottom: -10px;
      width: 0;
      height: 2px;
      background-color: #56baed;
      content: "";
      transition: width 0.2s;
    }

    .underlineHover:hover {
      color: #000;
    }

    .underlineHover:hover:after {
      width: 100%;
    }

    .user-box label {
      width: max-content;
      position: absolute;
      top: 0;
      margin: 10px 0;
      padding: 0 1px;
      font-size: 16px;
      color: rgb(141, 136, 136);
      pointer-events: none;
      transition: 0.5s;
      background-color: white;
    }

    .user-box #label-first {
      left: calc(50% - 31px);
    }

    .user-box #label-second {
      left: calc(50% - 47px);
    }

    .user-box input:focus~label,
    .user-box input:valid~label {
      top: -20px;
      color: #5fbae9;
      font-size: 12px;
    }

    .user-box input:focus~#label-first,
    .user-box input:valid~#label-first {
      left: calc(50% - 24px);
    }

    .user-box input:focus~#label-second,
    .user-box input:valid~#label-second {
      left: calc(50% - 35px);
    }

    /* OTHERS */

    *:focus {
      outline: none;
    }

    #icon {
      width: 30%;
    }

    * {
      box-sizing: border-box;
    }

    #alert-msg {
      color: #F15BB5;
      font-size: small;
      display: inline;
    }

    p {
      display: inline;
    }

    img {
      color: #F15BB5;
    }

    #eye {
      /* background-image: url("../resources/icons8-eye-48.png"); */
      border: none;
      position: absolute;
      right: 0;
      top: 0;
      margin-right: 10%;
      margin-top: 0%;
      cursor: pointer;
      font-size: 28px;
      /* width: 48px; */
    }
  </style>
</head>

<body>

<script>
    function viewPass() {
        const pwd = document.getElementById('password');
        const eye = document.getElementById('eye');
        $('#eye').css('color',(pwd.type == "password" ? '#56baed': '#dce8f1'))
        // pwd.type == "password" ? ($('#eye').css('color','#56baed')) : ($('#eye').css('color','#dce8f1'));
        pwd.type == "password" ? (pwd.type = 'text') : (pwd.type = 'password');
    }
</script>

  <div id="msg-done">
  </div>
  <div class="wrapper fadeInDown">

    <div id="formContent">
      <!-- Mensaje del error -->

      <!-- Icon -->
      <div class="fadeIn first" id="img-logo">
        <!-- <p id="circle"></p> -->
        <img src="public/assets/img/lobo-logo.png" id="icon" alt="User Icon" />
      </div>

      <!-- Tabs Titles -->
      <div id="Titulo">
        <h2 class="active"> Inicio de Sesión </h2>
        <br>
      </div>

      <!-- Login Form -->
      <form method="post" action="#" id="formlg">

        <div class="user-box">
          <input type="text" id="login" class="fadeIn second" pattern="[A-Za-z0-9_-]{1,15}" name="username" autocomplete="off">
          <label for="login" id="label-first" class="fadeIn lbs1"> Usuario </label><br>
        </div>
        <div class="user-box">
          <input type="password" id="password" class="fadeIn third" pattern="[A-Za-z0-9_-]{1,15}" name="password">
          <label for="password" id="label-second" class="fadeIn lbs2"> Contraseña </label><br>
           <i id="eye" class="fadeIn lbs2 typcn typcn-eye" alt="ver" onclick="viewPass()" style="color: #dce8f1"></i>
          <!-- <img src="./assets/img/lobo-logo.svg-hide.png" id="eye" class="fadeIn lbs2" alt="ver" onclick="viewPass()"> -->
        </div>
        <input type="submit" class="fadeIn fourth" value="Ingresar" id="btn-submit">
      </form>

      <div id="alert-msg" class="fadeIn five" style="display: none">
        <!-- <h2> Error </h2> -->
        <i class="typcn typcn-warning"></i>
        <!-- <img src="./assets/img/lobo-logo.svgwidth="14px"> -->
        <p>&nbsp;El nombre de usario o la contraseña son incorrectos</p>
      </div>

      <?php if ($errMsg) : ?>
        <p class="text-danger" style="color: red; margin-bottom: 10px;"><?= $errMsg ?></p>
      <?php endif ?>
    </div>
  </div>
</body>

</html>