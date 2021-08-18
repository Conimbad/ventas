<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS DataTables -->
<link rel="stylesheet" href="../css/datatables.css">
<!-- CSSs personalizados -->
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/compra.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="../css/select2.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../css/sweetalert2.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="adm_catalogo.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <!-- Carrito de compras -->
      <li class="nav-item dropdown" id="cat-carrito" style="display: none">
          <img src="../img/carrito.png" class=" imagen-carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <span class="contador badge badge-danger" id="contador"></span>
          </img>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <table class="carro table table-hover text-nowrap p-0">
              <thead class="table-success">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Concentración</th>
                  <th>Detalles</th>
                  <th>Precio</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody id="lista">
              </tbody>
            </table>
            <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar compra</a>
            <a id="vaciar-carrito" href="#" class="btn btn-primary btn-block">Vaciar carrito</a>
          </ul>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a href="../controlador/Logout.php">Cerrar Sesion</a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../vista/adm_catalogo.php" class="brand-link">
      <img src="../img/logo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Zapatería</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img id="avatar_4" src="../img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?php
              //Nombre de usuario Logueado
                echo $_SESSION['nombre_us'];//Se trae de LoginControler, que es donde estan las sesiones iniciadas
              ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">Usuario</li>
          <li class="nav-item">
            <a href="editar_datos_personales.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Datos personales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="adm_usuario.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gesgion de usuarios
              </p>
            </a>
          </li>
          <li class="nav-header">Ventas</li>
          <li class="nav-item">
            <a href="adm_venta.php" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Listar ventas
              </p>
            </a>
          </li>
          <li class="nav-header">Almacen</li>
          <li class="nav-item">
            <a href="adm_producto.php" class="nav-link">
              <i class="nav-icon fas fa-shoe-prints"></i>
              <p>
                Gestión de producto
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="adm_atributo.php" class="nav-link">
              <i class="nav-icon fas fa-vials"></i>
              <p>
                Gestión atributo
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="adm_lote.php" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Gestión lote
              </p>
            </a>
          </li>
          <li class="nav-header">Compras</li>
          <li class="nav-item">
            <a href="adm_proveedor.php" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Gestión de proveedores
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>