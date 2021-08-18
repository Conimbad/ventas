<?php
    include '../modelo/Lote.php';
    $lote = new Lote();

    if($_POST['funcion'] == 'crear'){
        $id_producto = $_POST['id_producto'];
        $proveedor = $_POST['proveedor'];
        $stock = $_POST['stock'];
        $vencimiento = $_POST['vencimiento'];
        
        $lote->Crear($id_producto,$proveedor,$stock,$vencimiento);
    }
    if($_POST['funcion'] == 'editar'){
        $id_lote = $_POST['id'];
        $stock = $_POST['stock'];
        
        $lote->Editar($id_lote,$stock);
    }
    if($_POST['funcion'] == 'buscar'){
        $lote->Buscar();
        $json = array();
        $fecha_actual = new DateTime();//Variable para guardar la fecha actual
        foreach($lote->objetos as $objeto){
            //Alertas de estado de vencimiento de un producto
            $vencimiento = new DateTime($objeto->vencimiento);
            $diferencia = $vencimiento->diff($fecha_actual);
            $mes = $diferencia->m;
            $dia = $diferencia->d;
            $verificado = $diferencia->invert;

            if($verificado == 0){
                $estado = 'danger';
                $mes = $mes * (-1);//Se coloca -1 para que el programa diga cuantos días han pasado 
                $dia = $dia * (-1);//desde su vencimiento y aparezca negativo
            }else{
                if($mes > 1){
                    $estado = 'light';
                }
                if($mes <= 1){
                    $estado = 'warning';
                }
            }
            //Array queasigna los datos recibidos de lote.js y los asigna al campo de la tabla
            $json[] = array(
                'id'=>$objeto->id_lote,
                'nombre'=>$objeto->prod_nom,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'vencimiento'=>$objeto->vencimiento,
                'proveedor'=>$objeto->proveedor,
                'stock'=>$objeto->stock,
                'laboratorio'=>$objeto->lab_nom,
                'tipo'=>$objeto->tip_nom,
                'presentacion'=>$objeto->pre_nom,
                'avatar'=>'../img/prod/'.$objeto->logo,
                'mes'=>$mes,
                'dia'=>$dia,
                'estado'=>$estado
            );
        }
        //Codifica el json y lo cinvierte a un string
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion'] == 'eliminar'){
        $id = $_POST['id'];
        $lote->Borrar($id);
    }
    
?>