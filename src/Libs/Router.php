<?php

session_start();
// Cargamos el modulo autoload.php para que podamos usar
// las clases que declaramos en el namespace adecuado
require_once ROOT."vendor/autoload.php";
// Comenzamos a usar la clase aplicación
use Core\Application;
// Creamos un objeto de la clase Application  y lo almacenamos en $app
$app = new Application();
// Creamos las rutas que deberá conocer el la aplicación
$app->router->setRoutes('/login','LoginAdmin');
$app->router->setRoutes('/home','Home');
$app->router->setRoutes('/','Home');
$app->router->setRoutes('/forms','Forms');
$app->router->setRoutes('/requests','Requests');
$app->router->setRoutes('/form_builder','FormBuilder');
$app->router->setRoutes('/form_send','FormSend');
$app->router->setRoutes('/form_preview','FormPreview');
$app->router->setRoutes('/form_for_polled','FormForPolled');
// Ejecutamos la aplicación.
$app->run();