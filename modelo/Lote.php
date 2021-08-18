<?php
    include_once 'Conexion.php';
    class Lote{
        var $objetos;
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function Crear($id_producto,$proveedor,$stock,$vencimiento){
            $sql = "INSERT INTO lote(stock,vencimiento,lote_id_prod,lote_id_prov) 
            VALUES (:stock,:vencimiento,:id_producto,:id_proveedor)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':id_producto'=>$id_producto,
            ':id_proveedor'=>$proveedor));
            echo 'added';
        }
        function Buscar(){
            if(!empty($_POST['consulta'])){
                $consulta = $_POST['consulta'];
                $sql = "SELECT id_lote, stock, vencimiento, concentracion, adicional, producto.nombre AS prod_nom,
                laboratorio.nombre AS lab_nom, tipo_producto.nombre AS tip_nom, presentacion.nombre AS pre_nom,
                proveedor.nombre proveedor, producto.avatar AS logo 
                FROM lote 
                JOIN proveedor ON lote_id_prov=id_proveedor
                JOIN producto ON lote_id_prod=id_producto
                JOIN laboratorio ON prod_lab=id_laboratorio
                JOIN tipo_producto ON prod_tip_prod=id_tip_prod
                JOIN presentacion ON prod_present=id_presentacion
                AND producto.nombre LIKE :consulta ORDER BY producto.nombre LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql = "SELECT id_lote, stock, vencimiento, concentracion, adicional, producto.nombre AS prod_nom,
                laboratorio.nombre AS lab_nom, tipo_producto.nombre AS tip_nom, presentacion.nombre AS pre_nom,
                proveedor.nombre proveedor, producto.avatar AS logo 
                FROM lote 
                JOIN proveedor ON lote_id_prov=id_proveedor
                JOIN producto ON lote_id_prod=id_producto
                JOIN laboratorio ON prod_lab=id_laboratorio
                JOIN tipo_producto ON prod_tip_prod=id_tip_prod
                JOIN presentacion ON prod_present=id_presentacion
                AND producto.nombre NOT LIKE '' ORDER BY producto.nombre LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function Editar($id_lote,$stock){
            $sql = "UPDATE lote SET stock=:stock WHERE id_lote=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_lote,':stock'=>$stock));
            echo 'edited';
        }
        function Borrar($id){
            $sql = "DELETE FROM lote WHERE id_lote=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id));
            if(!empty($query ->execute(array(':id'=>$id)))){
                echo 'borrado';
            }else{
                echo 'noborrado';
            }
        }
        function Devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
            $sql = "SELECT * FROM lote WHERE id_lote=:id_lote";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_lote'=>$id_lote));
            $lote = $query->fetchall();
            if(!empty($lote)){
                $sql = "UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
            }else{
                $sql = "SELECT * FROM lote WHERE vencimiento=:vencimiento AND lote_id_prod=:producto AND lote_id_prov=:proveedor";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
                $lote_nuevo = $query->fetchall();
                foreach ($lote_nuevo as $objeto) {
                    $id_lote_nuevo = $objeto->id_lote;
                }
                if(!empty($lote_nuevo)){
                    $sql = "UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
                    $query = $this->acceso->prepare($sql);
                    $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote_nuevo));
                }else{
                    $sql = "INSERT INTO lote(id_lote,stock,vencimiento,lote_id_prod,lote_id_prov)
                    VALUES (:id_lote,:stock,:vencimiento,:producto,:proveedor)";
                    $query = $this->acceso->prepare($sql);
                    $query->execute(array(':id_lote'=>$id_lote,':stock'=>$cantidad,':vencimiento'=>$vencimiento,
                    ':producto'=>$producto,':proveedor'=>$proveedor));
                }
            }
        }
    }
?>