<?php
    include_once 'Conexion.php';
    class Venta{
        var $objetos;
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function Crear($nombre,$dni,$total,$fecha,$vendedor){
            $sql = "INSERT INTO venta(fecha,cliente,dni,total,vendedor) 
                    VALUES(:fecha,:cliente,:dni,:total,:vendedor)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':cliente'=>$nombre,
            ':dni'=>$dni,':total'=>$total,':vendedor'=>$vendedor));
        }
        function UltimaVenta(){
            $sql = "SELECT MAX(id_venta) AS ultima_venta FROM venta";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function Borrar($id_venta){
            $sql = "DELETE FROM venta WHERE id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
            echo 'deleted';
        }
        function Buscar(){
            $sql = "SELECT id_venta,fecha,cliente,dni,total, 
            CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) AS vendedor
            FROM venta JOIN usuario ON vendedor=id_usuario";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function Verificar($id_venta,$id_usuario){
            $sql = "SELECT * FROM venta WHERE vendedor=:id_usuario AND id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta,':id_usuario'=>$id_usuario));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                return 1;
            }else{
                return 0;
            }
        }
        function RecuperarVendedor($id_venta){
            $sql = "SELECT us_tipo FROM venta JOIN usuario ON id_usuario=vendedor WHERE id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
            $this->objetos=$query->fetchall();
            
            return $this->objetos;
        }
        function VentaDiaVendedor($id_usuario){
            $sql = "SELECT SUM(total) AS venta_dia_vendedor FROM venta WHERE vendedor=:id_usuario 
            AND date(fecha) = date(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario));
            $this->objetos=$query->fetchall();
        }
        function VentaDiaria(){
            $sql = "SELECT SUM(total) AS venta_diaria FROM venta WHERE date(fecha)=date(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
        }
        function VentaMensual(){
            $sql = "SELECT SUM(total) AS venta_mensual FROM venta WHERE year(fecha) = year(curdate()) 
            AND month(fecha) = month(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
        }
        function VentaAnual(){
            $sql = "SELECT SUM(total) AS venta_anual FROM venta WHERE year(fecha) = year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
        }
        function BuscarId($id_venta){
            $sql = "SELECT id_venta,fecha,cliente,dni,total, 
            CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) AS vendedor
            FROM venta JOIN usuario ON vendedor=id_usuario
            AND id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }
?>