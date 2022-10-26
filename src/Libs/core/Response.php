<?php

namespace Core;

class Response
{
    // Funcion que asigna un codigo http en respuesta a una peticion
    public function setStatusCode(int $code): void
    {
        // funcion http que recibe el codigo
        http_response_code($code);
    }
}