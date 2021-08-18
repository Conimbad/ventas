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
<!--Modal Crear Lotes-->
<div class="modal fade" id="crear-lote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear lote</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR LOTES-->
            <div id="added-lote" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Lote agregado correctamente</span>
            </div>
              <form id="form-crear-lote">
              <div class="form-group">
                    <label for="nombre-producto-lote">Producto: </label>
                    <label id="nombre-producto-lote">"Nombre del producto"</label>
                </div>
                <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <select name="presentacion" id="proveedor" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input id="stock" type="number" class="form-control" placeholder="Ingrese stock">
                </div>
                <div class="form-group">
                    <label for="vencimiento">Vencimiento</label>
                    <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese el vencimiento del producto">
                </div>
                <input type="hidden" id="id-lote-prod">
              
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
        <div id="edit" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas  fa-check m-1"></i>Cambio de logo correcto!</span>
        </div>
        <div id="no-edit" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
        </div>
        <form id="form-logo" enctype="multipart/form-date">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="foto" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id-logo-prod" id="id-logo-prod">
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
<!-- Modal Crear Laboratorio -->
<div class="modal fade" id="crear-lab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Guardar laboratorio</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR LABORATORIO-->
            <div id="added-lab" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Laboratorio agregado correctamente</span>
            </div>
            <div id="noadded-lab" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El laboratorio ya existe</span>
            </div>
            <!-- ALERT PARA EDITAR LABORATORIO-->
            <div id="edited-lab" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Laboratorio editado correctamente</span>
            </div>
              <form id="form-crear-lab">
                <div class="form-group">
                    <label for="nombre-laboratorio">Nombre</label>
                    <input id="nombre-laboratorio" type="text" class="form-control" placeholder="Ingrese nombre" required>
                    <input type="hidden" id="editar-lab">
                </div>
              
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
<!-- Modal Crear Producto-->
<div class="modal fade" id="crear-producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear producto</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR PRODUCTO-->
            <div id="added" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Producto agregado correctamente</span>
            </div>
            <div id="noadded" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El producto ya existe</span>
            </div>
            <!-- ALERT PARA EDITAR PTODUCTO-->
            <div id="edit-prod" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>El producto se editó correctamente</span>
            </div>
              <form id="form-crear-producto">
                <div class="form-group">
                    <label for="nombre-producto">Nombre</label>
                    <input id="nombre-producto" type="text" class="form-control" placeholder="Ingrese nombre del producto" required>
                </div>
                <div class="form-group">
                    <label for="concentracion">Concentración</label>
                    <input id="concentracion" type="text" class="form-control" placeholder="Ingrese concentración del producto">
                </div>
                <div class="form-group">
                    <label for="adicional">Detalle</label>
                    <input id="adicional" type="text" class="form-control" placeholder="Ingrese detalles del producto">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input id="precio" step="any" type="number" class="form-control" value='1' placeholder="Ingrese precio del producto" required>
                </div>
                <div class="form-group">
                    <label for="laboratorio">Laboratorio</label>
                    <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="form-group">
                    <label for="presentacion">Presentación</label>
                    <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%"></select>
                </div>
                <input type="hidden" id="id-edit-prod">
              
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
            <h1>Gestión de productos <button id="boton-crear" class="btn bg-primary ml-2" type="button" data-toggle="modal" data-target="#crear-producto">Crear producto</button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de productos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Buscar producto</h3>
                <div class="input-group">
                    <input id="buscar-producto" placeholder="Escriba el nombre del producto" type="text" class="form-control float-left">
                    <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                </div>
                </div>
                <div class="card-body">
                    <div id="productos" class="row d-flex align-items-stretch">

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
<script src="../js/producto.js"></script>