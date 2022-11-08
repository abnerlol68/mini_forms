<pre>
  <?php
  ?>
</pre>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Builder Form</title>
  <link rel="stylesheet" href="<?= URL . 'src/css/form-builder.css' ?>">
  <script src="<?= URL . 'src/App/FormBuilder.js' ?>" type="module"></script>
</head>
<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="user" style="display: none;"><?= $_SESSION['user']['user_admin'] ?></p>
  <p id="form_id" style="display: none;"><?= $_GET['form_id'] ?></p>
  <main>
    <a href="<?= URL . 'form_preview/?form=' . $_GET['form_id'] ?>" class="go-to-preview">Preview</a>
    <div class="quest-container" id="quest-container"></div>
  </main>
</body>
</html>