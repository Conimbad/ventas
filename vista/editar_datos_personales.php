<?php
    session_start();
    if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){ 
        include_once 'layouts/header.php';
?>
  <title>Adm | Editar datos</title>
  <!-- Esto se llama desde la carpeta layouts, como se repetira en todas las paginas -->
<?php
    include 'layouts/nav.php';
?>
<!-- Button trigger modal -->

<!-- Modal Cambio avatar-->
<div class="modal fade" id="cambio-foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Avatar-->
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar_1" src="../img/avatar.png" alt="Avatar" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
            <b>
                <?php
                    echo $_SESSION['nombre_us'];
                ?>
            </b>
        </div>
        <div id="edit" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>Cambio de avatar correcto!</span>
        </div>
        <div id="no-edit" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
        </div>
        <form id="form-foto" enctype="multipart/form-date">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="foto" class="input-group">
                <input type="hidden" name="funcion" value="cambiar_foto">
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
<!-- MODAL DE CAMBIO DE PASSWORD-->
<div class="modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
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
        <div id="update" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>Cambio de contrase;a correcto</span>
        </div>
        <div id="no-update" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>La contrase;a no es correcta</span>
        </div>
        <form id="form-pass">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input id="old-pass" type="password" class="form-control" placeholder="Ingrese Contrase;a actual">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input id="new-pass" type="password" class="form-control" placeholder="Ingrese nueva contrase;a">
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Datos personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class=" card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img id="avatar_2" src="../img/avatar.png" alt="avatar" class="profile-user-img img-fluid img-circle">
                                </div>
                                <div class="text-center mt-1">
                                    <button type="button" data-toggle="modal" data-target="#cambio-foto" class="btn btn-primary btn-sm">Cambiar avatar</button>
                                </div>
                                <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="nombre_us" class="profile-username text-center text-success">Nombre</h3>
                                <p id="apellidos_us" class="text-muted text-center">Apellidos</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b style="color:black">Edad</b><a id="edad" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:black">DNI</b><a id="dni_us" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:black">Tipo Usuario</b>
                                        <span id="us_tipo" class="float-right">Administrador</span>
                                    </li>
                                      <button type="button" class="btn btn-block btn-outline-warning" data-toggle="modal" data-target="#cambiocontra">Cambiar contraseña</button>
                                </ul>
                            </div>  
                        </div>
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Sobre mi</h3>
                            </div>
                            <div class="card-body">
                                <strong>
                                    <i class="fas fa-phone mr-1"></i>Telefono  
                                </strong>
                                <p id="telefono_us" class="text-muted">56105014</p>
                                <strong>
                                    <i class="fas fa-map-marker-alt mr-1"></i>Residencia  
                                </strong>
                                <p id="residencia_us" class="text-muted">San Antonio Huista</p>
                                <strong>
                                    <i class="fas fa-at mr-1"></i>Correo  
                                </strong>
                                <p id="correo_us" class="text-muted">escocarl@gmail.com</p>
                                <strong>
                                    <i class="fas fa-smile-wink mr-1"></i>Sexo  
                                </strong>
                                <p id="sexo_us" class="text-muted">Masculino</p>
                                <strong>
                                    <i class="fas fa-pencil-alt mr-1"></i>Info. Adicional  
                                </strong>
                                <p id="adicional_us" class="text-muted">56105014</p>
                                <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Clic en el boton si desea editar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar datos personales</h3>
                            </div>
                            <div class="card-body">
                                <div id="editado" style="display: none;" class="alert alert-success text-center">
                                    <span><i class="fas fa-check m-1"></i>Guardado con exito</span>
                                </div>
                                <div id="no-editado" style="display: none;" class="alert alert-danger text-center">
                                    <span><i class="fas fa-times m-1"></i>Necesita editar los datos</span>
                                </div>
                                <form id="form-usuario" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-10">
                                            <input type="number" id="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="residencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="correo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sexo" class="col-sm-2 col-form-label">sexo</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="sexo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Info. Adicional</label>
                                        <div class="col-sm-10">
                                            <textarea id="adicional" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 float-right">
                                            <button class="btn btn-block btn-outline-success">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Cuidado con ingresar datos erroneos</p>
                            </div>
                        </div>
                    </div>
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
<script src="../js/usuario.js"></script>