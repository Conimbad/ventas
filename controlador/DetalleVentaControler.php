<?php
    include_once '../modelo/DetalleVenta.php';
    include_once '../modelo/VentaProducto.php';
    include_once '../modelo/Venta.php';
    include_once '../modelo/Lote.php';

    $detalle_venta = new DetalleVenta();
    $venta_producto = new VentaProducto();
    $venta = new Venta();
    $lote = new Lote();

    session_start();
    $id_usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['us_tipo'];
    if($_POST['funcion'] == 'borrar_venta'){
        $id_venta = $_POST['id'];

        if($venta->Verificar($id_venta,$id_usuario) == 1){
            $venta_producto->Borrar($id_venta);
            $detalle_venta->Recuperar($id_venta);
            foreach ($detalle_venta->objetos as $det) {
                $lote->Devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,
                $det->id__det_prod,$det->lote_id_prov);
                $detalle_venta->Borrar($det->id_detalle);
            }
            $venta->Borrar($id_venta);
        }else{
            if($tipo_usuario == 3){
                $venta_producto->Borrar($id_venta);
                $detalle_venta->Recuperar($id_venta);

                foreach ($detalle_venta->objetos as $det) {
                    $lote->Devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,
                    $det->id__det_prod,$det->lote_id_prov);
                    $detalle_venta->Borrar($det->id_detalle);
                }
                $venta->Borrar($id_venta);
            }else if($tipo_usuario == 1){
                $venta->RecuperarVendedor($id_venta);
                foreach ($venta->objetos as $objeto) {
                    if($objeto->us_tipo == 2){
                        $venta_producto->Borrar($id_venta);
                        $detalle_venta->Recuperar($id_venta);

                        foreach ($detalle_venta->objetos as $det) {
                            $lote->Devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,
                            $det->id__det_prod,$det->lote_id_prov);
                            $detalle_venta->Borrar($det->id_detalle);
                        }
                        $venta->Borrar($id_venta);
                    }else{
                        echo 'nodeleted';
                    }
                }
            }else{
                echo 'nodeleted';
            }
        }
    }
?>