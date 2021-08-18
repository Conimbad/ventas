<?php
    include 'Conexion.php';
    class Laboratorio{
        var $objetos;
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function Crear($nombre,$avatar){
            $sql = "SELECT id_laboratorio FROM laboratorio WHERE nombre=:nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadded';
            }else{  
                $sql = "INSERT INTO laboratorio(nombre,avatar) VALUES (:nombre,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
                echo 'added';
            }
        }
        function Buscar(){
            if(!empty($_POST['consulta'])){
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM laboratorio WHERE nombre LIKE :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql = "SELECT * FROM laboratorio WHERE nombre NOT LIKE '' ORDER BY id_laboratorio LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function CambiarLogo($id,$nombre){
            $sql="SELECT avatar FROM laboratorio WHERE id_laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos = $query->fetchall();

            $sql="UPDATE laboratorio SET avatar=:nombre WHERE id_laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':nombre'=>$nombre));
            return $this->objetos;
        }
        function Borrar($id){
            $sql="DELETE FROM laboratorio WHERE id_laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            
            if(!empty($query->execute(array(':id'=>$id)))){
                echo 'borrado';
            }else{
                echo 'noborrado';
            }  
        }
        function Editar($nombre,$id_editado){
            $sql="UPDATE laboratorio SET nombre=:nombre WHERE id_laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
            echo 'edit';
        }
        function RellenarLab(){
            $sql="SELECT * FROM laboratorio ORDER BY nombre ASC";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }
?>