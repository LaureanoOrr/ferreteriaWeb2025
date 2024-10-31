<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>sistema gestion de ventas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- libreria sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- jQuery -->
  <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">SISTEMA DE STOCK Y GESTION DE VENTAS</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $URL;?>" class="brand-link">
      <img src="<?php echo $URL;?>/public/images/carrito.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin-Ventas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $URL;?>/public/images/usuario.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombres_sesion;?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- USUARIOS -->
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/usuarios" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/usuarios/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación usuarios</p>
                </a>
              </li>
            </ul>
          </li>



         <!-- ROLES  -->
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/roles/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de roles</p>
                </a>
              </li>
            </ul>
          </li>


          <!-- CATEGORIAS  -->
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Categorias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/categorias" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de categorias</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- PRODUCTOS -->
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/almacen" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/almacen/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/almacen/productos_inactivos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos inactivos</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- COMPRAS -->
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/compras" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $URL;?>/compras/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar compra</p>
                </a>
              </li>
            </ul>
          </li>


            <!-- PROVEEDORES -->
            <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/proveedores" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de proveedores</p>
                </a>
              </li>
            </ul>
            </li>

               <!-- VENTAS -->
               <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $URL;?>/ventas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de ventas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $URL;?>/ventas/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realizar venta</p>
                </a>
              </li>
            </ul>
            </li>


            
         





           <!-- CERRAR SESION  -->
          <li class="nav-item">
            <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="nav-link" style=" background-color: #CF2F2F ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Cerrar sesión
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>