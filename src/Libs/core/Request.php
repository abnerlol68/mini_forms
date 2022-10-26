<?php

namespace Core;

class Request
{


    public function getPath()
    {
        // La URI en el servidor consta de la barra diagonal y el nombre del directorio o archivo
        //      Ejemplo:    $_SERVER['REQUEST_URI'] = '/home'

        // Consultamos la URI de nuestro servidor, en caso de que la URI sea nula
        // le asignamos un valor fijo = "/" que va a indicar que ira a la ruta de home
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        // Si nos retorna algo tenemos que validar que sea una ruta limpia, es decir,
        // sin parametros, para ello buscamos la posicion del signo de interrogacion de cierre en
        // la URI puesto que este simbolo es el separador entre la URI y sus parametros
        $position = strpos($path,'?');
        // Si existe el simbolo en la instruccion anterior, nos devolvera la posicion del mismo
        // en caso contrario nos devuelve un boleano con valor de false
        if ($position === false)
        {
            // Si nos devuelve el boleano con valor de false, quiere decir que no hay simbolo
            // y por lo tanto no hay parametros y se puede retornar la ruta inmediatamente
            return $path;
        }
        // Si nos devuleve una posicion (un entero) entonces mediante un substring, cortamos la
        // URI solo hasta el punto donde donde esta el signo de interrogacion y devolvemos la URI
        // completamente limpia
        return substr($path,0,$position);
    }

    public function getMethod(): string
    {
        // A partir del servidor obtenemos el metodo con el que se realizo la peticion
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}