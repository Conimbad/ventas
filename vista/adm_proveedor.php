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
<!-- Modal Cambio de logo-->
<div class="modal fade" id="cambio-logo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Avatar-->
      <div class="modal-body">
        <div class="text-center">
            <img id="logo-actual" src="../img/avatar.png" alt="Avatar" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
            <b id="nombre-logo">

            </b>
        </div>
        <div id="edit-prov" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>Cambio de logo correcto!</span>
        </div>
        <div id="no-edit-prov" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
        </div>
        <form id="form-logo" enctype="multipart/form-date">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="foto" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id-logo-prov" id="id-logo-prov">
                <input type="hidden" name="avatar" id="avatar">
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
<div class="modal fade" id="crear-proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear proveedor</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR PROVEEDOR-->
            <div id="added-prov" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Proveedor agregado correctamente</span>
            </div>
            <div id="noadded-prov" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El proveedor ya existe</span>
            </div>
            <div id="edited-prov" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Editado correctamente</span>
            </div>
              <form id="form-crear">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre/s" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input id="telefono" type="number" class="form-control" placeholder="Ingrese teléfono" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo electránico</label>
                    <input id="correo" type="email" class="form-control" placeholder="Ingrese correo">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" type="text" class="form-control" placeholder="Ingrese dirección" required>
                </div>
                <input type="hidden" id="id-edit-prov">
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
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
            <h1>Gestión de proveedores <button class="btn bg-primary ml-2" type="button" data-toggle="modal" data-target="#crear-proveedor">Crear proveedor</button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de proveedores</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Buscar proveedor</h3>
                <div class="input-group">
                    <input id="buscar-proveedor" placeholder="Escriba el nombre del proveedor" type="text" class="form-control float-left">
                    <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                </div>
                </div>
                <div class="card-body">
                    <div id="proveedores" class="row d-flex align-items-stretch">

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
<script src="../js/proveedor.js"></script>