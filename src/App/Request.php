<?php

namespace App;

use PDO;

class Request {
  private PDO $conn;

  public function __construct() {
    $db = new Database();
    $this->conn = $db->get_conn();
  }

  public function response() {
    /*==== Request for Forms ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_forms') {
      $forms = [...$this->conn->query('SELECT * FROM forms')];
      echo json_encode($forms);
      http_response_code(200);
      return;
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_form') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $stm = $this->conn->prepare(
        'INSERT INTO forms (title_form, user_admin) VALUES (:title, :author)'
      );
      $stm->execute([
        'title' => $content_req['title'],
        'author' => $content_req['author'],
      ]);
      $last_form = [...$this->conn->query('SELECT * FROM forms ORDER BY id_form DESC LIMIT 1')][0];
      echo json_encode($last_form);
      http_response_code(201);
      return;
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['req'] == 'remove_form') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $stm = $this->conn->prepare('DELETE FROM forms WHERE id_form = :id');
      $stm->execute([ 'id' => $content_req['id'] ]);
      http_response_code(200);
      return;
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['req'] == 'update_form') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $stm = $this->conn->prepare('UPDATE forms SET title_form = :title WHERE id_form = :id');
      $stm->execute([
        'id' => $content_req['id'],
        'title' => $content_req['title'],
      ]);
      http_response_code(201);
      return;
    }


    /*==== Request for Questions ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_quests') {
      $quests = [...$this->conn->query('SELECT * FROM questions')];
      echo json_encode($quests);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_quest') {
      $content_req = json_decode(file_get_contents('php://input'), true);

      // Soon the id will not be passed since from the DB it is auto-increment
      $this->conn->prepare('
        INSERT INTO questions (id_question, description_question, type_question, id_form) 
        VALUES (:id, :title, :type, :id_form)
      ')->execute([
        'id' => $content_req['id'],
        'title' => $content_req['title'],
        'type' => $content_req['type'],
        'id_form' => $content_req['idForm'],
      ]);
      
      $last_quest = [...$this->conn->query(
        'SELECT * FROM questions GROUP BY id_question DESC LIMIT 1'
      )][0];
      
      echo json_encode($last_quest);
      http_response_code(201);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['req'] == 'remove_quest') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $this->conn
        ->prepare('DELETE FROM questions WHERE id_question = :id AND id_form = :id_form')
        ->execute([
          'id' => $content_req['id'],
          'id_form' => $content_req['idForm'],
        ]);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['req'] == 'update_quest') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $stm = $this->conn->prepare('
        UPDATE questions SET description_question = :title, type_question = :type
        WHERE id_question = :id AND id_form = :id_form
      ');
      $stm->execute([
        'id' => $content_req['id'],
        'id_form' => $content_req['idForm'],
        'title' => $content_req['title'],
        'type' => $content_req['type'],
      ]);
      http_response_code(201);
      return;
    }


    /*==== Request for Questions ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_options') {
      $stm = $this->conn->prepare('SELECT * FROM optionss WHERE id_question = :id_quest');
      $stm->execute([ 'id_quest' => $_GET['quest']]);
      $options = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($options);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_option') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      
      $this->conn->prepare('
        INSERT INTO optionss (description_option, id_question) 
        VALUES (:desc, :id_quest)
      ')->execute([
        'desc' => $content_req['desc'],
        'id_quest' => $content_req['questId'],
      ]);
      
      $last_opt = [...$this->conn->query('
        SELECT * FROM optionss ORDER BY id_option DESC LIMIT 1;
      ')][0];
      
      echo json_encode($last_opt);
      http_response_code(201);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['req'] == 'remove_option') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      $this->conn
        ->prepare('
          DELETE FROM optionss 
          WHERE id_question = :id_quest AND id_option = :id_opt
        ')
        ->execute([
          'id_quest' => $content_req['questId'],
          'id_opt' => $content_req['optId']
        ]);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['req'] == 'update_option') {
      $content_req = json_decode(file_get_contents('php://input'), true);
      
      $this->conn
        ->prepare('
          UPDATE optionss SET description_option = :desc
          WHERE id_option = :id_opt AND id_question = :id_quest
        ')
        ->execute([
          'id_opt' => $content_req['optId'],
          'desc' => $content_req['desc'],
          'id_quest' => $content_req['questId'],
        ]);

      http_response_code(201);
      return;
    }

    echo 'Operation not available';
    http_response_code(400);
    return;
  }
}

?>