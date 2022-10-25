<?php
  try {
    session_start();
    $uri = rtrim(isset($_GET['url']) ? $_GET['url'] : null, '/');

    $address = [
      'login' => constant('ROOT').'src/View/LoginAdmin.php',
      'home' => constant('ROOT').'src/View/Home.php',
      'requests' => constant('ROOT').'src/Libs/Requests.php',
      'form_builder' => constant('ROOT').'src/View/FormBuilder.php',
      'form_send' => constant('ROOT').'src/View/FormSend.php',
      'form_preview' => constant('ROOT').'src/View/FormPreview.php',
      'form_for_polled' => constant('ROOT').'src/View/FormForPolled.php',
      'not_found' => constant('ROOT').'src/View/NotFound.php',
    ];

    if (!isset($_SESSION["user"])) {
      require $address['login'];
      return;
    }
  
    // If uri is null, the request uri is point to home
    if (!$uri) {
      require $address['home'];
      return;
    }

    // If the uri is not found in addresses, NotFound is pointed to
    if (!$address[$uri]) {
      require $address['not_found'];
      return;
    }
  
    // The request uri is point to address select
    require $address[$uri];
    return;
  } catch (Exception $e) {
    die($e->getMessage());
  }
?>
