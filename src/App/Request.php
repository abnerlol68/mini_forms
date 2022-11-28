<?php

namespace App;

use PDO;

class Request
{
    private PDO $conn;


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->get_conn();
    }

    public function response()
    {
        /*==== Request for Forms ====*/

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_forms') {
            $forms = [...$this->conn->query('CALL get_forms();')];
            echo json_encode($forms);
            http_response_code(200);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_form') {
            $content_req = json_decode(file_get_contents('php://input'), true);
            $stm = $this->conn->prepare(
                'CALL add_form(:title, :author);'
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
            $stm = $this->conn->prepare('CALL remove_form(:id);');
            $stm->execute(['id' => $content_req['id']]);
            http_response_code(200);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['req'] == 'update_form') {
            $content_req = json_decode(file_get_contents('php://input'), true);
            $stm = $this->conn->prepare('CALL update_form(:title, :id);');
            $stm->execute([
                'id' => $content_req['id'],
                'title' => $content_req['title'],
            ]);
            http_response_code(201);
            return;
        }


        /*==== Request for Questions ====*/

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_quests') {
            $stm = $this->conn->prepare('SELECT * FROM questions WHERE id_form = :form_id');
            $stm->execute(['form_id' => $_GET['form']]);
            $quests = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($quests);
            http_response_code(200);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_quest') {
            $content_req = json_decode(file_get_contents('php://input'), true);

            $this->conn->prepare('
        INSERT INTO questions (description_question, type_question, id_form) 
        VALUES (:title, :type, :id_form)
      ')->execute([
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
            $stm->execute(['id_quest' => $_GET['quest']]);
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

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && $_GET['req'] == 'remove_option-set') {
            $content_req = json_decode(file_get_contents('php://input'), true);
            $this->conn
                ->prepare(' DELETE FROM optionss WHERE id_question = :id_quest')
                ->execute([
                    'id_quest' => $content_req['questId'],
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

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'select_users') {
            $graduates = [...$this->conn->query('CALL select_graduate()')];
            echo json_encode($graduates);
            http_response_code(200);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'send_message') {
            $content_req = json_decode(file_get_contents('php://input'), true);
            $_SESSION['userMessage'] = $content_req['msj'];
            include_once ROOT . 'src/Controller/MessageWhats.php';
            http_response_code(201);
            return;
        }

//        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'start_session') {
//
//        }

//        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'close_session') {
//            session_destroy();
//            echo "Session cerrada correctamente";
////            header('Location: ' . URL);
//            http_response_code(200);
//        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'insert_users') {
            $content_req = json_decode(file_get_contents('php://input'), true);
            $stm = $this->conn->prepare(
                'INSERT INTO graduates (
                       email_graduate,
                       phone_graduate,
                       name_graduate,
                       last_name_graduate,
                       mothers_surname,
                       profession_graduate,
                       egress_year_graduate
                       )
                        VALUES (
                                :email,
                                :phone,
                                :name,
                                :lastName,
                                :motherSurname,
                                :carrier,
                                :graduate
                                )'
            );
            $stm->execute([
                'name' => $content_req['name'],
                'lastName' => $content_req['lastName'],
                'motherSurname' => $content_req['motherSurname'],
                'carrier' => $content_req['carrier'],
                'email' => $content_req['email'],
                'phone' => $content_req['phone'],
                'graduate' => $content_req['graduate'],
            ]);
            echo json_encode($content_req);
            http_response_code(201);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'charting') {
            $formComplete = [...$this->conn->query('CALL charting()')];
            echo json_encode($formComplete);
            http_response_code(200);
            return;
        }


        echo 'Operation not available';
        http_response_code(400);
        return;
    }
}

?>