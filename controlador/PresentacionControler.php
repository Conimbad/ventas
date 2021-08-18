<?php
    include '../modelo/Presentacion.php';

    $presentacion = new Presentacion();
    if($_POST['funcion'] == 'crear'){
        $nombre = $_POST['nombre_pres'];
        $presentacion->Crear($nombre);
    }
    if($_POST['funcion'] == 'editar'){
        $nombre = $_POST['nombre_pres'];
        $id_editado= $_POST['id_editado'];
        $presentacion->Editar($nombre,$id_editado);
    }
    if($_POST['funcion'] == 'buscar'){
        $presentacion->Buscar();
        $json = array();
        foreach($presentacion->objetos as $objeto){
            $json[] = array(
                'id'=>$objeto->id_presentacion,
                'nombre'=>$objeto->nombre,

            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    
    if($_POST['funcion'] == 'eliminar'){
        $id = $_POST['id'];
        $presentacion->Borrar($id);
    }
    if($_POST['funcion'] == 'rellenar_pres'){
        $presentacion->RellenarPres();
        $json = array();
        foreach ($presentacion->objetos as $objeto) {
            $json[] = array(
                'id'=>$objeto->id_presentacion,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
?>
