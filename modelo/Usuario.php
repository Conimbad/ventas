<?php
    include 'Conexion.php';
    class Usuario{
        var $objetos;
        //Constructor que crea el objeto $db, crea la variable acceso y le asigna el objeto $db
        //con lo que tiene el pdo de la clase Conexion.php
        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        //Funcion que recibe como parametros el dni y el pass del formulario login
        function Loguearse($dni,$pass){
            $sql="SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo=id_tipo_us WHERE 
            dni_us=:dni AND contrasena_us=:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dni'=>$dni,':pass'=>$pass));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
        function ObtenerDatos($id){
            $sql="SELECT * FROM usuario JOIN tipo_us ON us_tipo=id_tipo_us AND id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
        function Editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
            $sql="UPDATE usuario SET telefono_us=:telefono,residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, 
            adicional_us=:adicional WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':residencia'=>$residencia,':correo'=>$correo,
            ':sexo'=>$sexo,':adicional'=>$adicional));
        }
        function CambiarContra($id_usuario, $oldpass, $newpass){
            $sql="SELECT  * FROM usuario WHERE id_usuario=:id AND contrasena_us=:oldpass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
            $this->objetos = $query->fetchall();
            if(!empty($this->objetos)){
                $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario, ':newpass'=>$newpass));
                echo 'update';    
            }else{
                echo 'noupdate';
            }
        }
        function CambiarFoto($id_usuario,$nombre){
            $sql="SELECT avatar FROM usuario WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario));
            $this->objetos = $query->fetchall();

            $sql="UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario, ':nombre'=>$nombre));
            return $this->objetos;
        }
        function Buscar(){
            if(!empty($_POST['consulta'])){
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us WHERE nombre_us LIKE :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql = "SELECT * FROM usuario JOIN tipo_us ON us_tipo=id_tipo_us WHERE nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function Crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){
            $sql = "SELECT id_usuario FROM usuario WHERE dni_us=:dni";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dni'=>$dni));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadded';
            }else{  
                $sql = "INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellido,:edad,:dni,:pass,:tipo,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dni'=>$dni,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
                echo 'added';
            }
        }
        function Ascender($pass,$id_ascendido,$id_usuario){
            $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                $tipo = 1;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));                
                echo 'ascendido';
            }else{
                echo 'noascendido';
            }
        }
        function Descender($pass,$id_descendido,$id_usuario){
            $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                $tipo = 2;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));                
                echo 'descendido';
            }else{
                echo 'nodescendido';
            }
        }
        function Eliminar($pass,$id_eliminar,$id_usuario){
            $sql = "SELECT id_usuario FROM usuario WHERE id_usuario=:id_usuario AND contrasena_us=:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                $sql = "DELETE FROM usuario WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_eliminar));                
                echo 'eliminado';
            }else{
                echo 'noeliminado';
            }
        }
    }
    
?>