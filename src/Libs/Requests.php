<?php
  require_once 'src/Libs/Database.php';

  if ($_GET['req'] == 'get_forms') {
    $forms = [...$conn->query('SELECT * FROM forms')];
    echo json_encode($forms);
    return;
  }

  echo null;
  return;
?>