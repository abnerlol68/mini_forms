<?php

namespace Core;
class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    // Método para asignar rutas dentro de nuestra matriz $routes
    // Cada ruta debe contener una direccion ($path), su función a realizar ($callback) y el método
    // de solicitud ($method). El método es opcional, pero si no se asigna especifica un método,
    // en automático se le asigna un método de solicitud de tipo GET.
    public function setRoutes($path, $callback, $method = 'get'): void
    {
        $this->routes[$method][$path] = $callback;
    }

    public function resolve()
    {
        if (!isset($_SESSION["user"])) {
            return $this->renderView("LoginAdmin");
        }
        // El atributo Request se refiere al objeto de la clase Request
        // quien contiene información sobre las peticiones hechas al servidor
        /*  [En PHP]  $this->request          es los mismo que   [En JAVA]  this.request   */

        // Obtiene la ruta URL del navegador a la cual el usuario desea acceder
        // a través de la petición y lo almacena en la variable llamada $path (ruta en español)
        $path = $this->request->getPath();
        // Obtiene el método de solicitud por parte del cliente
        // Métodos: GET o POST
        // El método es almacenado en la variable $method (método en español)
        $method = $this->request->getMethod();
        // Obtiene la vista ó función asociada a la matriz del atributo routes (rutas en español)
        // y si mediante el operador de doble signo de interrogacion (null operador coalescente) ??
        // pregunta si en los indices que le pasamos se "encuestra algo" osea, no es nulo.
        // si es nulo asigna el false a la variable $callback
        // si no lo es, es decir, encontró una ruta en esos indices, entonces retorna el valor entre los indices
        $callback = $this->routes[$method][$path] ?? false;
        // Ahora se consulta el resultado con una sentencia if
        // En caso de que el $callback sea igual a false
        if ($callback === false)
        {
            // Si el $callback es igual a false entonces le decimos al cliente mediante el objeto de response que
            // se a producido un codigo de error 404 que indica que el archivo no se ha encontrado
            $this->response->setStatusCode(404);
            // Enviamos la vista resuelta del documento NotFound.php
            return $this->renderView("NotFound");
        }
        // Si lo que encontró en los indices de la matriz routes es un string, quiere decir
        // que es el nombre de un archivo html o php que se tiene que llamar y colocarlo en la página
        if (is_string($callback))
        {
            // El método renderView coloca el contenido del nombre del archivo que se paso por un string
            // dentro del documento html
            return $this->renderView($callback);
        }
        // Si lo que encontró en los indices de la matriz routes es una función, entonces usamos
        // el método call_user_func para llamar a la funcion y ejecutarla.
        return call_user_func($callback);
    }

    private function renderView(string $callback): bool|string
    {
        // Recive el nombre del archivo y lo incluye en el documento con include_once
        ob_start();
//        include_once ROOT . "src/Libs/View/$callback.php";
        include_once ROOT . "src/View/$callback.php";
        return ob_get_clean();
    }
}