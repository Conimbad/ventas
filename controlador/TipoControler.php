<?php
    include '../modelo/Tipo.php';

    $tipo = new Tipo();
    if($_POST['funcion'] == 'crear'){
        $nombre = $_POST['nombre_tipo'];
        $tipo->Crear($nombre);
    }
    if($_POST['funcion'] == 'editar'){
        $nombre = $_POST['nombre_tipo'];
        $id_editado= $_POST['id_editado'];
        $tipo->Editar($nombre,$id_editado);
    }
    if($_POST['funcion'] == 'buscar'){
        $tipo->Buscar();
        $json = array();
        foreach($tipo->objetos as $objeto){
            $json[] = array(
                'id'=>$objeto->id_tip_prod,
                'nombre'=>$objeto->nombre,

            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    
    if($_POST['funcion'] == 'eliminar'){
        $id = $_POST['id'];
        $tipo->Borrar($id);
    }
    if($_POST['funcion'] == 'rellenar_tipos'){
        $tipo->RellenarTipos();
        $json = array();
        foreach ($tipo->objetos as $objeto) {
            $json[] = array(
                'id'=>$objeto->id_tip_prod,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
?>
