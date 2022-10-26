<?php

namespace Core;

class Application
{
    //<editor-fold desc="Variables">
    public Router $router; // Crea un objeto de la clase Router para acceder a sus m[etodos y asignar rutas
    public Request $request; // Crea un objeto de la clase Request para obtener los datos de la peticion como la url y el metodo usado
    public Response $response; // Crea un objeto de la clase Response para responder al cliente en base al resultado de la peticion, nos va a servir para indicar errores
    //</editor-fold>

    public function __construct()
    {
        // Inicializa las variables asignadas
        $this->request = new Request();
        $this->response = new Response();
        // Pasamos como parámetro a $request y $response al objeto $router
        $this->router = new Router($this->request, $this->response);
    }

    public function run(): void
    {
        // Devolvemos lo que haya resuelto el router con un echo
        echo $this->router->resolve();
    }

}