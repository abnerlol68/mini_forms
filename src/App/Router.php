<?php

namespace App;

class Router
{
    public function __construct()
    {
    }

    public function get_uri(): string
    {
        return rtrim(isset($_GET['url']) ? $_GET['url'] : null, '/');
    }
// Routes
    public function redirect($uri): void
    {
        $ADDRESS = [
            'login' => ROOT . 'src/View/LoginAdmin.php',
            'home' => ROOT . 'src/View/Home.php',
            'data' => ROOT . 'src/View/Data.php',
            'stats' => ROOT . 'src/View/Stats.php',
            'form_builder' => ROOT . 'src/View/FormBuilder.php',
            'form_send' => ROOT . 'src/View/FormSend.php',
            'form_preview' => ROOT . 'src/View/FormPreview.php',
            'form_for_polled' => ROOT . 'src/View/FormForPolled.php',
            'close_session' => ROOT . 'src/Controller/CloseSession.php',
            'not_found' => ROOT . 'src/View/NotFound.php',
        ];

        if (!isset($_SESSION["user"])) {
            require $ADDRESS['login'];
            return;
        }

        if (isset($_SESSION["user"]) && $uri == 'login') {
            require $ADDRESS['home'];
            return;
        }

        // If uri is null, the request uri is point to home
        if (!$uri) {
            require $ADDRESS['home'];
            return;
        }

        if ($uri == 'request') {
            $request = new Request();
            $request->response();
            return;
        }

        // If the uri is not found in addresses, NotFound is pointed to
        if (!array_key_exists($uri, $ADDRESS)) {
            require $ADDRESS['not_found'];
            return;
        }

        // The request uri is point to address select
        require $ADDRESS[$uri];
        return;
    }
}

?>
