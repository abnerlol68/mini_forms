<?php
  require_once 'src/Libs/Database.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_forms') {
    $forms = [...$conn->query('SELECT * FROM forms')];
    echo json_encode($forms);
    http_response_code(200);
    return;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_form') {
    $content_req = json_decode(file_get_contents('php://input'), true);
    $stm = $conn->prepare('INSERT INTO forms VALUES (:id, :title, :author)');
    $stm->execute([
      'id' => $content_req['id'],
      'title' => $content_req['title'],
      'author' => $content_req['author'],
    ]);
    http_response_code(201);
    return;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['req'] == 'remove_form') {
    $content_req = json_decode(file_get_contents('php://input'), true);
    $stm = $conn->prepare('DELETE FROM forms WHERE id_form = :id');
    $stm->execute([ 'id' => $content_req['id'] ]);
    http_response_code(200);
    return;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['req'] == 'update_form') {
    $content_req = json_decode(file_get_contents('php://input'), true);
    $stm = $conn->prepare('UPDATE forms SET title_form = :title WHERE id_form = :id');
    $stm->execute([
      'id' => $content_req['id'],
      'title' => $content_req['title'],
    ]);
    http_response_code(201);
    return;
  }

  echo 'Operation not available';
  http_response_code(400);
  return;
?>