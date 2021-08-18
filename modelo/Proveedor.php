<?php
    include 'Conexion.php';
    class Proveedor{
        var $objetos;
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function Crear($nombre,$telefono,$correo,$direccion,$avatar){
            $sql = "SELECT id_proveedor FROM proveedor WHERE nombre=:nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadded';
            }else{  
                $sql = "INSERT INTO proveedor(nombre,telefono,correo,direccion,avatar) 
                VALUES (:nombre,:telefono,:correo,:direccion,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,
                ':direccion'=>$direccion,':avatar'=>$avatar));
                echo 'added';
            }
        }
        function Buscar(){
            if(!empty($_POST['consulta'])){
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM proveedor WHERE nombre LIKE :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql = "SELECT * FROM proveedor WHERE nombre NOT LIKE '' ORDER BY id_proveedor DESC LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function CambiarLogo($id,$nombre){
            $sql = "UPDATE proveedor SET avatar=:nombre WHERE id_proveedor=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id,':nombre'=>$nombre));
        }
        function Borrar($id){
            $sql = "DELETE FROM proveedor WHERE id_proveedor=:id";
            $query = $this->acceso->prepare($sql);
            $query ->execute(array(':id'=>$id));
            if(!empty($query ->execute(array(':id'=>$id)))){
                echo 'borrado';
            }else{
                echo 'noborrado';
            }
        }
        function Editar($id,$nombre,$telefono,$correo,$direccion){
            $sql = "SELECT id_proveedor FROM proveedor WHERE id_proveedor!=:id AND nombre=:nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre,));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noedit';
            }else{  
                $sql = "UPDATE proveedor SET nombre=:nombre,telefono=:telefono,correo=:correo,direccion=:direccion
                WHERE id_proveedor=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id,':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion));
                echo 'edit';
            }
        }
        function RellenarProveedores(){
            $sql = "SELECT * FROM proveedor ORDER BY nombre ASC";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    }
?>