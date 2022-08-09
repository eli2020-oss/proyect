<?php
//session_start();

$nombre="";
$login= $_COOKIE["id"]."";
$nom="";
$accodigo="";
$acestado="";
$aceuser="";

?>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="inicio.php" class="nav-link">Inicio</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Todo los mensajes</a>
        </div>
      </li>
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
    <a href="inicio.php" class="brand-link">
      <!-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Cooperativa Ceibena</span>
    </a>

    <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="inicio.php" class="d-block"><?php echo $login; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php 
              if (isset($_SESSION["AC-1"])==true)
               { 
                ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
                <i class="right fas fa-angle-left">
                </i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Elegir Cual</p>
                </a>
              </li>
            </ul>
          </li>
           <?php  
           
           if (isset($_SESSION["AC-6"])==true)
            { ?>
             <li class="nav-item">
            <a href="user_mp.php" class="nav-link">
              
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Control de usuarios
                <i class="right fas fa-angle-left">
                </i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user_mp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bloqueo de usuario</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="permisos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accesos y permisos</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tareas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asignacion de tarea</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } 
          }
            if (isset($_SESSION["AC-3"])==true)
             {
              ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="control_tickets.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de tickets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de estado</p>
                </a>
              </li>
            </ul>
          </li>
         <?php 
        } 
           if (isset($_SESSION["AC-4"])==true) {
            ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
               Tickes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <?php  
            if (isset($_SESSION["AC-5"])==true)
             {
             ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="bandeja.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bandeja de entrada</p>
                </a>
              </li>
            <?php }  ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="titecks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Tickes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="registro_ticks.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial</p>
                </a>
              </li>
            </ul>
          </li>
          <?php 
          }
            if (isset($_SESSION["AC-8"])==true)
            {
             ?>
         <li class="nav-header">OTROS</li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                hola
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                ..
              </p>
            </a>
          </li>
           <?php }  ?>
        </ul>

      </nav>
      <!-- /.fin menu -->
    </div>
    <!-- /.fin menu -->
  </aside>

