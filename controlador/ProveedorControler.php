<?php
    include '../modelo/Proveedor.php';
    $proveedor = new Proveedor();

    if($_POST['funcion'] == 'crear'){
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $avatar = 'prov-default.png';

          $proveedor->Crear($nombre,$telefono,$correo,$direccion,$avatar);
    }
    if($_POST['funcion'] == 'editar'){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];

          $proveedor->Editar($id,$nombre,$telefono,$correo,$direccion);
    }
    if($_POST['funcion'] == 'buscar'){
        $proveedor->Buscar();
        $json = array();
        foreach($proveedor->objetos as $objeto){
            $json[] = array(
                'id'=>$objeto->id_proveedor,
                'nombre'=>$objeto->nombre,
                'telefono'=>$objeto->telefono,
                'correo'=>$objeto->correo,
                'direccion'=>$objeto->direccion,
                'avatar'=>'../img/prov/'.$objeto->avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion'] == 'cambiar_logo'){
        $id = $_POST['id-logo-prov'];
        $avatar = $_POST['avatar'];
        if(($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')){
            $nombre = uniqid().'-'.$_FILES['foto']['name'];
            $ruta = '../img/prov/'.$nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
            
            $proveedor->CambiarLogo($id,$nombre);

            //Buscando avatar antiguo para borrarlo
            
            if($avatar != '../img/prov/prov-default.png'){
                unlink($avatar);
            }

            $json = array();
            $json[] = array(
                'ruta' => $ruta,
                'alert' => 'edit'  
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }else{
            $json = array();
            $json[] = array(
                'alert' => 'noedit'   
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }
    if($_POST['funcion'] == 'eliminar'){
        $id = $_POST['id'];
        $proveedor->Borrar($id);
    }
    if($_POST['funcion'] == 'rellenar_proveedores'){
        $proveedor->RellenarProveedores();
        $json = array();
        foreach ($proveedor->objetos as $objeto) {
            $json[] = array(
                'id'=>$objeto->id_proveedor,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
?>