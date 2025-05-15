<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index( Router $router ) {

        $propiedades = propiedad::get(3);

        $router->render('paginas/index', [
            'inicio' => true,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros', [

        ]);
    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {

        $router->render('paginas/blog');
    }

    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }

    public static function contacto (Router $router){

        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $contenido = ''; // Initialize the variable

            $respuestas = $_POST['contacto'];
            //crea instacia     
            $mail  = new PHPMailer();
            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '213e520e8d6731';
            $mail->Password = '33327c155d785c';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
     

            //configurar el contenido
            $mail->setFrom('admin@binesraices.com');
            $mail->addAddress('admin@binesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';


            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido
            $contenido .= '<html>';
            $contenido.='<p>Tienes un nuevo mensaje</p>';
            $contenido.='<p>Nombre: '.$respuestas['nombre'].'</p>';
   

            if($respuestas['contacto']==='telefono'){
                $contenido.='<p>Eligio ser contactado por telefono</p>';
                $contenido.='<p>telfono: '.$respuestas['telefono'].'</p>';
                $contenido.='<p>Fecha Contacto: '.$respuestas['fecha'].'</p>';
                $contenido.='<p>Hora : '.$respuestas['hora'].'</p>';
            }else{
                $contenido.='<p>Eligio ser contactado por email</p>';
                $contenido.='<p>Email: '.$respuestas['email'].'</p>';
           
            }
            $contenido.='<p>Mensaje: '.$respuestas['mensaje'].'</p>';
            $contenido.='<p>Vende o compra: '.$respuestas['tipo'].'</p>';
            $contenido.='<p>Precio o presupuesto: $'.$respuestas['precio'].'</p>';
            $contenido.='<p>Prefiere ser contactado por: '.$respuestas['contacto'].'</p>';
           
            $contenido .='</html>';

            $mail->Body =$contenido;
            $mail->AltBody ="Es texto alternativo si html";

            //enviar mail
            if($mail->send()){
                $mensaje = "El mensaje fue enviado";
            }else{
                $mensaje =  "El mensaje no se pudo enviar";
            }
        }
        $router->render('paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }
  
}