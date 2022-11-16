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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/login.css">
    <link rel="stylesheet" href="src/Libs/icons/font/typicons.css"/>
    <link rel="shortcut icon" href="src/img/favicon.png" type="image/x-icon">
</head>
<body>
<div id="background">

</div>
<div id="login">
    <div id="head_login">
        <img src="src/img/favicon.png" alt="logo" id="logo_login">
        <h2 id="login_message_head">&nbsp;Inicio de sesión&nbsp;</h2>
    </div>
    <div id="body_login">
        <form method="post" action="#">
            <!-- Data Username tag -->
            <div class="login_box_body">
                <label for="username" class="inputs_icons"><i class="typcn typcn-user"></i></label>
                <div class="login_box_inputs">
                    <input class="login_inputs" type="text" name="username" id="username" required=""
                           autocomplete="off" maxlength="15">
                    <label class="login_labels" for="username">Username</label>
                </div>
            </div>
            <!--            Data Password -->
            <div class="login_box_body">
                <label for="password" class="inputs_icons"><i class="typcn typcn-key"></i></label>
                <div class="login_box_inputs">
                    <input class="login_inputs" type="password" name="password" id="password" required=""
                           autocomplete="off" maxlength="15">
                    <label class="login_labels" for="password">Password</label>
                    <a id="show_password" onclick="show()" href="<?= URL . '/' ?>">mostrar</a>
                </div>
            </div>
            <button type="submit" id="login_button">
                Ingresar
            </button>
        </form>
    </div>
    <div id="foot_login">
        <!--        Error Message-->
        <?php if ($errMsg) : ?>
            <p class="text-danger" style="color: red; margin-bottom: 10px;"><?= $errMsg ?></p>
        <?php endif ?>
    </div>
</div>
</body>
</html>

<script>
    function show() {
        const inputPassword = document.getElementById("password");
        const type = inputPassword.type;
        inputPassword.type = (type === "password") ? "text" : "password";
    }
</script>
