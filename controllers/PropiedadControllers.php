<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadControllers
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $resultado = $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'errores' => $errores,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        //metodo post para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            // Validación
            $errores = $propiedad->validar();

            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }



            if (empty($errores)) {
                // Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                // Guarda en la base de datos
                $resultado = $propiedad->guardar();

                if ($resultado) {
                    header('location: /propiedades');
                }
            }
        }


        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }


    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Leer el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    // encontrar y eliminar la propiedad
                    $propiedad = Propiedad::find($id);
                    $resultado = $propiedad->eliminar();

                }
            }
        }
    }
}
