<?php
    session_start();
    if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){ 
        include_once 'layouts/header.php';
?>
  <title>Adm | Atributo</title>
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
        <div id="edit" style="display: none;" class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>Cambio de logo correcto!</span>
        </div>
        <div id="no-edit" style="display: none;" class="alert alert-danger text-center">
            <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
        </div>
        <form id="form-logo" enctype="multipart/form-date">
            <div class="input-group mb-3 ml-5 mt-2">
                <input type="file" name="foto" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id-logo-lab" id="id-logo-lab">
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
            <!-- ALERT PARA AGREGAR USUARIO-->
            <div id="added-lab" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Laboratorio agregado correctamente</span>
            </div>
            <div id="noadded-lab" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El laboratorio ya existe</span>
            </div>
            <!-- ALERT PARA EDITAR USUARIO-->
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
<!-- Content Wrapper. Contains page content -->
<div class="modal fade" id="crear-tipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear tipo</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR TIPO-->
            <div id="added-tipo" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Tipo agregado correctamente</span>
            </div>
            <div id="noadded-tipo" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>El tipo ya existe</span>
            </div>
            <!-- ALERT PARA EDITAR TIPO-->
            <div id="edited-tipo" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Tipo editado correctamente</span>
            </div>
              <form id="form-crear-tipo">
                <div class="form-group">
                    <label for="nombre-tipo">Nombre</label>
                    <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese tipo" required>
                    <input type="hidden" id="editar-tipo">
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
<!-- Content Wrapper. Contains page content -->
<div class="modal fade" id="crear-pres" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Crear Presentación</h3>
              <button class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
            <!-- ALERT PARA AGREGAR PRESENTACIóN-->
            <div id="added-pres" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Presentación agregada correctamente</span>
            </div>
            <div id="noadded-pres" style="display: none;" class="alert alert-danger text-center">
              <span><i class="fas fa-times m-1"></i>La presentacion ya existe</span>
            </div>
            <!-- ALERT PARA EDITAR PRESENTACIóN-->
            <div id="edited-pres" style="display: none;" class="alert alert-success text-center">
              <span><i class="fas fa-check m-1"></i>Presentación editada correctamente</span>
            </div>
              <form id="form-crear-pres">
                <div class="form-group">
                    <label for="nombre-pres">Nombre</label>
                    <input id="nombre-pres" type="text" class="form-control" placeholder="Ingrese Presentación" required>
                    <input type="hidden" id="editar-pres">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de atributos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestión de atributos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                                <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                                <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="laboratorio">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar laboratorios <button type="button" data-toggle="modal" data-target="#crear-lab" class="btn bg-primary btn-sm m-2">Crear laboratorio</button></div>
                                            <div class="input-group">
                                                <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-success">
                                              <tr>
                                                <th>Laboratorio</th>
                                                <th>Logo</th>
                                                <th>Acción</th>
                                              </tr>
                                            </thead>
                                            <tbody id="laboratorios" class="table-active"></tbody>
                                          </table>
                                        </div>
                                        <div class="card-footer">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tipo">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar tipo <button type="button" data-toggle="modal" data-target="#crear-tipo" class="btn bg-primary btn-sm m-2">Crear tipo</button>
                                        </div>
                                            <div class="input-group">
                                                <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-success">
                                              <tr>
                                                <th>Tipos</th>
                                                <th>Acción</th>
                                              </tr>
                                            </thead>
                                            <tbody id="tipos" class="table-active"></tbody>
                                          </table>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="presentacion">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar presentación
                                            <button type="button" data-toggle="modal" data-target="#crear-pres" class="btn bg-primary btn-sm m-2">Crear presentación</button>
                                            </div>
                                            <div class="input-group">
                                                <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                          <table class="table table-hover text-nowrap">
                                            <thead class="table-success">
                                              <tr>
                                                <th>Presentación</th>
                                                <th>Acción</th>
                                              </tr>
                                            </thead>
                                            <tbody id="presentaciones" class="table-active"></tbody>
                                          </table>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php
include_once 'layouts/footer.php';
}else{
    header('Location: ../index.php');
}
?>
<script src="../js/laboratorio.js"></script>
<script src="../js/tipo.js"></script>
<script src="../js/presentacion.js"></script>