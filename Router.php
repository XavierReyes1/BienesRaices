<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //arreglo de rutas protegidad..
        $rutas_protegidad = ['/admin','/propiedades/crear','/propiedades/actualizar',
    '/propiedades/eliminar', '/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar',];

        $urActual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$urActual] ?? null;
        } else {
            $fn = $this->postRoutes[$urActual] ?? null;
        }

        if(in_array($urActual,$rutas_protegidad) && !$auth){
            header('Location: /');
        }

        if ($fn) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include __DIR__ . '/views/layout.php';
    }
}
