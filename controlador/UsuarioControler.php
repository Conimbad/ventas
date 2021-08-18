<?php
    include_once '../modelo/Usuario.php';
    $usuario = new Usuario();
    
    session_start();
    $id_usuario = $_SESSION['usuario'];

    if($_POST['funcion'] == 'buscar_usuario'){
        $json = array();
        // convirtiendo mi fecha de nacimiento a edad para que se auto incremente ** hay que cambiar el tipo de dato en la bd del campo a DATE
        $fecha_actual = new DateTime();
        $usuario->ObtenerDatos($_POST['dato']);
        foreach ($usuario->objetos as $objeto){
            $nacimiento = new DateTime($objeto->edad);
            $edad = $nacimiento->diff($fecha_actual);
            $edad_year = $edad->y;
            $json[] = array(
                'nombre'=>$objeto->nombre_us,
                'apellidos'=>$objeto->apellidos_us,
                'edad'=>$edad_year,
                'dni'=>$objeto->dni_us,
                'tipo'=>$objeto->nombre_tipo,
                'telefono'=>$objeto->telefono_us,
                'residencia'=>$objeto->residencia_us,
                'correo'=>$objeto->correo_us,
                'sexo'=>$objeto->sexo_us,
                'adicional'=>$objeto->adicional_us,
                'avatar'=>'../img/'.$objeto->avatar
            );
        }
        $jsonString = json_encode($json[0]);
        echo $jsonString;
    }
    if($_POST['funcion'] == 'capturar_datos'){
        $json = array();
        
        $id_usuario = $_POST['id_usuario'];//id_usuario que se envio desde javascript
        $usuario->ObtenerDatos($id_usuario);
        foreach ($usuario->objetos as $objeto) {
            $json[] = array(
                'telefono'=>$objeto->telefono_us,
                'residencia'=>$objeto->residencia_us,
                'correo'=>$objeto->correo_us,
                'sexo'=>$objeto->sexo_us,
                'adicional'=>$objeto->adicional_us
            );
        }
        $jsonString = json_encode($json[0]);
        echo $jsonString;
    }
    if($_POST['funcion'] == 'editar_usuario'){

        $id_usuario = $_POST['id_usuario'];//id_usuario que se envio desde javascript
        $telefono = $_POST['telefono'];
        $residencia = $_POST['residencia'];
        $correo = $_POST['correo'];
        $sexo = $_POST['sexo'];
        $adicional = $_POST['adicional'];
        $usuario->Editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);
        echo 'editado';
    }
    if($_POST['funcion'] == 'cambiar_contra'){

        $id_usuario = $_POST['id_usuario'];//id_usuario que se envio desde javascript
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $usuario -> CambiarContra($id_usuario,$oldpass,$newpass);
    }
    if($_POST['funcion'] == 'cambiar_foto'){
        if(($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')){
            $nombre = uniqid().'-'.$_FILES['foto']['name'];
            $ruta = '../img/'.$nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
            $usuario->CambiarFoto($id_usuario,$nombre);

            //Buscando avatar antiguo para borarlo
            foreach($usuario->objetos as $objeto){
                unlink('../img/'.$objeto->avatar);
            }
            $json = array();
            $json[] = array(
                'ruta' => $ruta,
                'alert' => 'edit'  
            );
            $jsonString = json_encode($json[0]);
            echo $jsonString;
        }else{
            $json = array();
            $json[] = array(
                'alert' => 'noedit'   
            );
            $jsonString = json_encode($json[0]);
            echo $jsonString;
        }
    }
    if($_POST['funcion'] == 'buscar_us'){
        $json = array();
        
        $fecha_actual = new DateTime();
        $usuario->Buscar();
        foreach ($usuario->objetos as $objeto){
            $nacimiento = new DateTime($objeto->edad);
            $edad = $nacimiento->diff($fecha_actual);
            $edad_year = $edad->y;
            $json[] = array(
                'id'=>$objeto->id_usuario,
                'nombre'=>$objeto->nombre_us,
                'apellidos'=>$objeto->apellidos_us,
                'edad'=>$edad_year,
                'dni'=>$objeto->dni_us,
                'tipo'=>$objeto->nombre_tipo,
                'telefono'=>$objeto->telefono_us,
                'residencia'=>$objeto->residencia_us,
                'correo'=>$objeto->correo_us,
                'sexo'=>$objeto->sexo_us,
                'adicional'=>$objeto->adicional_us,
                'avatar'=>'../img/'.$objeto->avatar,
                'tipo_usuario'=>$objeto->us_tipo
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    }
    if($_POST['funcion'] == 'crear_usuario'){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $dni = $_POST['dni'];
        $pass = $_POST['pass'];
        $tipo = 2;
        $avatar = 'default.jpg';
        $usuario->Crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
    }
    if($_POST['funcion'] == 'ascender'){
        $pass = $_POST['pass'];
        $id_ascendido = $_POST['id_usuario'];
        $usuario->Ascender($pass,$id_ascendido,$id_usuario);
    }
    if($_POST['funcion'] == 'descender'){
        $pass = $_POST['pass'];
        $id_descendido = $_POST['id_usuario'];
        $usuario->Descender($pass,$id_descendido,$id_usuario);
    }
    if($_POST['funcion'] == 'eliminar_usuario'){
        $pass = $_POST['pass'];
        $id_eliminar = $_POST['id_usuario'];
        $usuario->Eliminar($pass,$id_eliminar,$id_usuario);
    }
?>