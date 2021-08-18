<?php
    include '../modelo/Laboratorio.php';

    $laboratorio = new Laboratorio();
    if($_POST['funcion'] == 'crear'){
        $nombre = $_POST['nombre_lab'];
        $avatar = 'lab-default.png';
        $laboratorio->Crear($nombre,$avatar);
    }
    if($_POST['funcion'] == 'editar'){
        $nombre = $_POST['nombre_lab'];
        $id_editado= $_POST['id_editado'];
        $laboratorio->Editar($nombre,$id_editado);
    }
    if($_POST['funcion'] == 'buscar'){
        $laboratorio->Buscar();
        $json = array();
        foreach($laboratorio->objetos as $objeto){
            $json[] = array(
                'id'=>$objeto->id_laboratorio,
                'nombre'=>$objeto->nombre,
                'avatar'=>'../img/lab/'.$objeto->avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion'] == 'cambiar_logo'){
        $id = $_POST['id-logo-lab'];
        if(($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')){
            $nombre = uniqid().'-'.$_FILES['foto']['name'];
            $ruta = '../img/lab/'.$nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
            
            $laboratorio->CambiarLogo($id,$nombre);

            //Buscando avatar antiguo para borrarlo
            foreach($laboratorio->objetos as $objeto){
                if($objeto->avatar != 'lab-default.png'){
                    unlink('../img/lab/'.$objeto->avatar);
                }
                
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
    if($_POST['funcion'] == 'eliminar'){
        $id = $_POST['id'];
        $laboratorio->Borrar($id);
    }
    if($_POST['funcion'] == 'rellenar_lab'){
        $laboratorio->RellenarLab();
        $json = array();
        foreach ($laboratorio->objetos as $objeto) {
            $json[] = array(
                'id'=>$objeto->id_laboratorio,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
?>