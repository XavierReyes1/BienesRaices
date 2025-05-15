<?php

namespace Controllers;
use Model\Admin;
use MVC\Router;

class LoginController {

    public static function login(Router $router){
        $errores =[];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if(empty($errores)){
                //verifica si el usuario existe
             $resultado =   $auth->existeUsuario();

             if(!$resultado){
            //verificar si el usuario o no(mensaje de error)
                $errores = Admin::getErrores();
             }else{
                //verificar el password
               $autenticado = $auth->comprobarPassword($resultado);
                if($autenticado){
                    //autenticar al usuario
                    $auth->autenticar();
                }else{
                    //password incorecto
                    $errores = Admin::getErrores(); 
                }

             }
            }
        }
        $router->render('auth/login',[
            'errores'=>$errores
        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION=[];
        header('Location: /'); 
    }
}