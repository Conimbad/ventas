<?php
    include '../modelo/Venta.php';
    session_start();
    $id_usuario = $_SESSION['usuario'];
    $venta = new Venta();

    if($_POST['funcion'] == 'listar'){
        $venta->Buscar();
        $json = array();
        foreach($venta->objetos as $objeto){
            $json['data'][] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion'] == 'mostrar_consultas'){
        $venta->VentaDiaVendedor($id_usuario);
        foreach ($venta->objetos as $objeto) {
            $venta_dia_vendedor = $objeto->venta_dia_vendedor;
        }
        $venta->VentaDiaria();
        foreach ($venta->objetos as $objeto) {
            $venta_diaria = $objeto->venta_diaria;
        }
        $venta->VentaMensual();
        foreach ($venta->objetos as $objeto) {
            $venta_mensual = $objeto->venta_mensual;
        }
        $venta->VentaAnual();

        $json = array();
        foreach($venta->objetos as $objeto){
            $json[] = array(
                'venta_dia_vendedor'=>$venta_dia_vendedor,
                'venta_diaria'=>$venta_diaria,
                'venta_mensual'=>$venta_mensual,
                'venta_anual'=>$objeto->venta_anual
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
?>