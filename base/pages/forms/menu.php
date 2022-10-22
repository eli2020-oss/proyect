<?php
//session_start();
include('conexion.php');
$nombre="";
$login= $_COOKIE["id"]."";
$avatar='';
$sql="SELECT  concat(us.f_name,' ',us.l_name) as nombre,
 au.acc_id as acid, ac.acc_nombre, ac.acc_id as acceso,avatar,estado,acc_estado
FROM  bd_local.tbl_user as us 
inner join bd_local.user_acceso as au 
inner join  bd_local.tbl_acceso as ac where au.acc_id=ac.acc_id 
and au.us_id=us.id and au.us_id='".$login."';";
//echo $sql;
  $result=mysqli_query($conexion,$sql);
      while($row=mysqli_fetch_assoc($result))
      {
        $nombre=$row["nombre"]."";
       $avatar=$row['avatar'];
      $_SESSION[$row["acceso"]]=isset($row["acid"])?$row["acid"]:"";
     // $_SESSION[$row["acc_estado"]]=isset($row["estado"])?$row["estado"]:"";
        
      }
$_SESSION['name']=$nombre;
$_SESSION['avatar']=$avatar;

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
    
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.php" class="brand-link">
      <img src="reportes/img/CEIBENA.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> 
      <span class="brand-text font-weight-light">Cooperativa Ceibeña</span>
    </a>

    <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img styte='max-width: 50px;' src='<?php echo $avatar ?>' class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="perfil.php" class="d-block"><?php echo $nombre; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php 
               $estado="";
               $sql="SELECT estado
               FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
               where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-1' and acc_estado='ACTIVO'";
              $result=mysqli_query($conexion,$sql);
              while($row=mysqli_fetch_assoc($result))
              { $estado=$row["estado"]; }
              if (isset($_SESSION["AC-1"])==true and isset($estado)=='ACTIVO' )
               { 
                ?>
               
           <?php  
            $estado="";
            $sql="SELECT estado
            FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
            where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-6' and acc_estado='ACTIVO'";
           $result=mysqli_query($conexion,$sql);
           while($row=mysqli_fetch_assoc($result))
           { $estado=$row["estado"]; }
           if (isset($_SESSION["AC-6"])==true and $estado=='ACTIVO')
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
          $estado="";
          $sql="SELECT estado
          FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
          where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-3' and acc_estado='ACTIVO'";
         $result=mysqli_query($conexion,$sql);
         while($row=mysqli_fetch_assoc($result))
         { $estado=$row["estado"]; }
        // echo $sql;
            if (isset($_SESSION["AC-3"])==true and $estado=='ACTIVO')
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
                  <p>Panel de control</p>
                </a>
              </li>
            </ul>
          </li>
          <?php 
          $estado="";
          $sql="SELECT estado
          FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
          where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-2' and acc_estado='ACTIVO'";
         $result=mysqli_query($conexion,$sql);
         while($row=mysqli_fetch_assoc($result))
         { $estado=$row["estado"]; }
        // echo $sql;
            if (isset($_SESSION["AC-2"])==true and $estado=='ACTIVO')
             {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Ajustes
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="control_filiales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de Filiales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="control_accesos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de Accesos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="control_tarea.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de Tareas</p>
                </a>
              </li>
              <?php  if (isset($_SESSION["AC-7"])==true and $estado=='ACTIVO')
             {?>
              <li class="nav-item">
                <a href="reasignacion.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Control de Tickets</p>
                </a>
              </li>
              <?php 
              }?>
            </ul>
          </li>
         <?php 
             }
        } 
        $estado="";
        $sql="SELECT estado
        FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
        where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-5' and acc_estado='ACTIVO'";
       $result=mysqli_query($conexion,$sql);
       while($row=mysqli_fetch_assoc($result))
       { $estado=$row["estado"]; }
            if (isset($_SESSION["AC-5"])==true and $estado=='ACTIVO')
             {
             ?>
               <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-envelope"></i>
              <p>
               Tickes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="bandeja.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bandeja de entrada</p>
                </a>
              </li>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="titecks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Tickes</p>
                </a>
              </li>
              <?php 
              $sql="SELECT estado
              FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
              where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-2' and acc_estado='ACTIVO'";
             $result=mysqli_query($conexion,$sql);
             while($row=mysqli_fetch_assoc($result))
             { $estado=$row["estado"]; }
            // echo $sql;
                if (isset($_SESSION["AC-2"])==true and $estado=='ACTIVO')
                 {
              ?>
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
          }
          $estado="";
          $sql="SELECT estado
          FROM bd_local.tbl_user as us inner join bd_local.user_acceso as au inner join bd_local.tbl_acceso as ac
          where au.acc_id=ac.acc_id and au.us_id=us.id and au.us_id='".$_COOKIE["id"]."' and ac.acc_id='AC-8' and acc_estado='ACTIVO'";
         $result=mysqli_query($conexion,$sql);
         while($row=mysqli_fetch_assoc($result))
         { $estado=$row["estado"]; }
            if (isset($_SESSION["AC-8"])==true and $estado=='ACTIVO')
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

