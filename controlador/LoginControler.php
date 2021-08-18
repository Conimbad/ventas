<?php
    include_once '../modelo/Usuario.php';
    session_start();
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    $usuario = new Usuario();
    
    //Si hay sesion en curso se realiza el switch para ver a donde ser redirigira
    if(!empty($_SESSION['us_tipo'])){
       
        switch($_SESSION['us_tipo']){
            case 1:
                header('Location: ../vista/adm_catalogo.php');
            break;

            case 2:
                header('Location: ../vista/tec_catalogo.php');
            break;
            
            case 3:
                header('Location: ../vista/adm_catalogo.php');
            break;
        }
    }else{
        //Recorre la tabla usuarios en busca de coincidencias de lo que se ingresa en el form
        //foreach($usuario->objetos as $objeto){
        //    print_r($objeto->nombre_us);
        //}
        $usuario->Loguearse($user,$pass);
        if(!empty($usuario->objetos)){
            foreach($usuario->objetos as $objeto){
                $_SESSION['usuario']=$objeto->id_usuario;
                $_SESSION['us_tipo']=$objeto->us_tipo;
                $_SESSION['nombre_us']=$objeto->nombre_us;
            }
            //Ve que tipo de usuario es para redireccionarlo a una pagina diferente, admin o tecnico
            switch($_SESSION['us_tipo']){
                case 1:
                    header('Location: ../vista/adm_catalogo.php');
                break;

                case 2:
                    header('Location: ../vista/tec_catalogo.php');
                break;

                case 3:
                    header('Location: ../vista/adm_catalogo.php');
                break;
            }
        }else{
            header('Location: ../index.php');//Si no hay coincidencia redirecciona a la misma pagina de login
        }
    }
    
?>