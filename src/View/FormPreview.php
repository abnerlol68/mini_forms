<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Preview</title>
  <script src="<?= URL . 'src/App/FormPreview.js' ?>" type="module"></script>
</head>

<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="user" style="display: none;"><?= $_SESSION['user']['user_admin'] ?></p>
  <p id="form_id" style="display: none;"><?= $_GET['form'] ?></p>
  <main></main>
</body>

</html>