<?php
    session_start();
    if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){ 
        include_once 'layouts/header.php';
?>
  <title>Adm | Gestión de usuarios</title>
  <!-- Esto se llama desde la carpeta layouts, como se repetira en todas las paginas -->
<?php
    include 'layouts/nav.php';
?>
<!-- Modal Ascender -->
<div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Conirmar acción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar_3" src="../img/avatar.png" alt="Avatar" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
            <b>
                <?php
                    echo $_SESSION['nombre_us'];
                ?>
            </b>
        </div>
        <span>Se necesita la contraseña para continuar</span>
        <div id="confirmado" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>Acción realizada con éxito</span>
        </div>
        <div id="rechazado" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>La contraseña es incorrecta</span>
        </div>
        <form id="form-confirmar">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input id="old-pass" type="password" class="form-control" placeholder="Ingrese Contrase;a actual">
                <input type="hidden" id="id-us">
                <input type="hidden" id="funcion">
            </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Crear Usuario-->
<div class="modal fade" id="crear_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear usuario</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR USUARIO-->
            <div id="added" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Usuario agregado correctamente</span>
            </div>
            <div id="noadded" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El código de usuario ya existe</span>
            </div>
              <form id="form-crear">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre/s" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input id="apellido" type="text" class="form-control" placeholder="Ingrese Apellidos" required>
                </div>
                <div class="form-group">
                    <label for="edad">Fecha de nacimiento</label>
                    <input id="edad" type="date" class="form-control" placeholder="Ingrese fecha de nacimiento" required>
                </div>
                <div class="form-group">
                    <label for="dni">NIT o No. de identificación</label>
                    <input id="dni" type="text" class="form-control" placeholder="Ingrese numero de identificador" required>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input id="pass" type="password" class="form-control" placeholder="Ingrese contraseña " required>
                </div>
              
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right m-1">Registrar usuario</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary float-right m-1">Cerrar</button>
              </form>
          </div>
        </div>
      
    </div>
  </div>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de usuarios <button id="boton-crear" class="btn bg-primary ml-2" type="button" data-toggle="modal" data-target="#crear_usuario">Crear usuario</button></h1>
            <input id="tipo-usuario" type="hidden" value="<?php echo $_SESSION['us_tipo']?>">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Buscar usuario</h3>
                <div class="input-group">
                    <input id="buscar" placeholder="Escriba el nombre del usuario" type="text" class="form-control float-left">
                    <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                </div>
                </div>
                <div class="card-body">
                    <div id="usuarios" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
<?php
include_once 'layouts/footer.php';
}else{
    header('Location: ../index.php');
}
?>
<script src="../js/gestion_usuario.js"></script>