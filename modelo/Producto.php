<?php
    include 'Conexion.php';
    class Producto{
        var $objetos;
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function Crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
            $sql = "SELECT id_producto FROM producto WHERE nombre=:nombre AND concentracion=:concentracion
            AND adicional=:adicional AND prod_lab=:laboratorio AND prod_tip_prod=:tipo
            AND prod_present=:presentacion";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadded';
            }else{  
                $sql = "INSERT INTO producto(nombre, concentracion, adicional, precio, prod_lab,prod_tip_prod, 
                prod_present,avatar) VALUES (:nombre,:concentracion,:adicional,:precio,:laboratorio,:tipo,
                :presentacion,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':precio'=>$precio,':avatar'=>$avatar));
                echo 'added';
            }
        }
        function Editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion){
            $sql = "SELECT id_producto FROM producto WHERE id_producto!=:id AND nombre=:nombre AND concentracion=:concentracion 
            AND adicional=:adicional AND prod_lab=:laboratorio AND prod_tip_prod=:tipo 
            AND prod_present=:presentacion";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noedit';
            }else{  
                $sql = "UPDATE producto SET nombre=:nombre,concentracion=:concentracion,adicional=:adicional,prod_lab=:laboratorio,prod_tip_prod=:tipo,prod_present=:presentacion,precio=:precio
                WHERE id_producto=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':precio'=>$precio));
                echo 'edit';
            }
        }
        function Buscar(){
            if(!empty($_POST['consulta'])){
                $consulta = $_POST['consulta'];
                $sql = "SELECT id_producto, producto.nombre AS nombre, concentracion, adicional, precio, laboratorio.nombre AS laboratorio,
                tipo_producto.nombre AS tipo, presentacion.nombre AS presentacion, producto.avatar AS avatar,
                prod_lab, prod_tip_prod, prod_present
                FROM producto
                JOIN laboratorio ON prod_lab=id_laboratorio
                JOIN tipo_producto ON prod_tip_prod=id_tip_prod
                JOIN presentacion ON prod_present=id_presentacion
                AND producto.nombre LIKE :consulta LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql = "SELECT id_producto, producto.nombre AS nombre, concentracion, adicional, precio, laboratorio.nombre AS laboratorio,
                tipo_producto.nombre AS tipo, presentacion.nombre AS presentacion, producto.avatar AS avatar,
                prod_lab, prod_tip_prod, prod_present
                FROM producto
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
        function CambiarLogo($id,$nombre){
            $sql = "UPDATE producto SET avatar=:nombre WHERE id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id,':nombre'=>$nombre));
        }
        function Borrar($id){
            $sql = "DELETE FROM producto WHERE id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id));
            if(!empty($query ->execute(array(':id'=>$id)))){
                echo 'borrado';
            }else{
                echo 'noborrado';
            }
        }
        function ObtenerStock($id){
            $sql = "SELECT SUM(stock) AS total FROM lote WHERE lote_id_prod=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function BuscarId($id){
            $sql = "SELECT id_producto, producto.nombre AS nombre, concentracion, adicional, precio, laboratorio.nombre AS laboratorio,
            tipo_producto.nombre AS tipo, presentacion.nombre AS presentacion, producto.avatar AS avatar,
            prod_lab, prod_tip_prod, prod_present
            FROM producto
            JOIN laboratorio ON prod_lab=id_laboratorio
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion
            WHERE id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }

    }
?>