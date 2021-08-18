<?php
    session_start();
    if($_SESSION['us_tipo']==3){ 
        include_once 'layouts/header.php';
?>
  <title>Adm | Gestión de lotes</title>
  <!-- Esto se llama desde la carpeta layouts, como se repetira en todas las paginas -->
<?php
    include 'layouts/nav.php';
?>
<!--Modal Editar Lotes-->
<div class="modal fade" id="editar-lote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Editar lote</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR LOTES-->
            <div id="edited-lote" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Lote editado correctamente</span>
            </div>
              <form id="form-editar-lote">
              <div class="form-group">
                    <label for="codigo-lote">Código de lote: </label>
                    <label id="codigo-lote">"Codigo lote"</label>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input id="stock" type="number" class="form-control" placeholder="Ingrese stock" require>
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de lotes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de lotes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Buscar lotes</h3>
                <div class="input-group">
                    <input id="buscar-lote" placeholder="Escriba el nombre del producto" type="text" class="form-control float-left">
                    <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                </div>
                </div>
                <div class="card-body">
                    <div id="lotes" class="row d-flex align-items-stretch">

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
<script src="../js/lote.js"></script>