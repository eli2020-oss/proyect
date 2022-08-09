<?php
session_start();
include('menu.php');
  $_SESSION["login"];
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MODULO DE USER</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script type="text/javascript">
 function cargar1(codigo)
      {
        //alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="desabilitar";
         document.getElementById("cc").value=codigo;
          //var getInput =codigo;
         //localStorage.setItem("ab",getInput);
            document.getElementById("formulario").submit();
      } 
   
  
</script>
<script type="text/javascript">
 function cargar2(codigo)
      {
        //alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="habilitar";
         document.getElementById("cc").value=codigo;
          //
         //localStorage.setItem("ab",getInput);
            document.getElementById("formulario").submit();
      } 
   
  
</script>
<script type="text/javascript">
     function search(codigo)
      {
       alert("Entra");
       var getInput =codigo;
              document.getElementById("buscar").value=codigo;
            document.getElementById("formulario").submit();
      } 
  </script>
  <?php
  //  
  $variablephp="";
  $variablephp = "<script> document.write(getInput) </script>";
  //echo "<script>alert('".$variablephp."');</script>";
    $estado="ACTIVO";
    $nombre="";
    $id="";
    $empresa="";
    $consulta="SELECT em_nombre, em_id, emp_nombre FROM bd_local.tbl_emple inner join bd_local.tbl_empresa ";
     $result=mysqli_query($conexion,$consulta);
      while($row=mysqli_fetch_assoc($result))
      {
        $nombre=$row["em_nombre"]."";
         $id=$row["em_id"]."";
         $empresa=$row["emp_nombre"]."";
      }
    
if($accion=='desabilitar')
{
  //
  // 
   // echo "                  ".isset($_POST['cc']);
 $sql="UPDATE `bd_local`.`tbl_user` SET `u_estado` = 'INACTIVO' WHERE (`us_id` = '".$_POST['cc']."');";
//echo " el sql    ".$sql;
$result=mysqli_query($conexion,$sql);
}
if($accion=='habilitar')
{
  //$variablephp="";
 //$variablephp = "<script> document.write(getInput) </script>";
  // echo "<script>alert('PRIMERO');</script>";
   // echo "                  ".isset($_POST['cc']);
 $sql="UPDATE `bd_local`.`tbl_user` SET `u_estado` = 'ACTIVO' WHERE (`us_id` = '".$_POST['cc']."');";
//echo " el sql    ".$sql;
$result=mysqli_query($conexion,$sql);
}
    ?>
<body class="hold-transition sidebar-mini">
  <!-- ENCABEZADO -->
  <div class="content-wrapper">
    <!-- DONDE ME ENCUENTRO -->
      <form name='formulario' id='formulario' class="principal" action="user_mp.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
             <input type="hidden" name="buscar" id="buscar" value="<?php echo $buscar; ?>">
             <input type="hidden" name="cc" id="cc" value="<?php echo $cc; ?>">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>USUARIOS EN EXISTENCIA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios Existentes</li>
            </ol>
          </div>
        </div>
      </div><!-- FINAL DEL ENCABEZADO  -->
    </section>

    <!-- Main content -->
    <section class="content">
          
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de usuarios</h3>
           <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder='<?php echo $buscar; ?>'>

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" onclick='return search("<?php echo $_POST['table_search'] ?>")'>
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

        <div class="card-body">
           <div id="control-table" method="POST" action="#">
              <div class="card-body table-responsive p-0" style="height: 300px;">
           <table class="table table-head-fixed text-nowrap" name="table">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          ID
                      </th>
                      <th style="width: 20%">
                          Nombre
                      </th>
                      <th style="width: 30%">
                          Correo
                      </th>
                      
                      <th style="width: 8%" class="text-center">
                          Estado
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $sql="SELECT u.us_id as id, e.em_id as codigo,u_estado as estado, em_nombre as nombre,
                         em_correo as correo FROM bd_local.tbl_user as u inner join bd_local.tbl_emple as e where e.em_id=u.em_id;";
                    $result=mysqli_query($conexion,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                      //$estado="".$_POST['estado'];
                      echo "
                      <tr>
                         <tr>
                      <td>
                          ".$row["codigo"]."
                      </td>
                      <td>
                          <a>
                           " .$row["nombre"]."
                          </a>
                          <br/>
                      </td>
                      <td>
                        ".$row["correo"]."
                      </td>
                      
                       <td class='project-state'>

                          <span class=''>".$row["estado"]."</span>
                      </td>
                       <td class='project-actions text-right'>
                          <a class='btn btn-danger btn-sm' onclick='return cargar1(\"".$row["id"]."\")' >
                             DESABILITAR
                          </a>
                          <a class='btn btn-primary btn-sm' onclick='return cargar2(\"".$row["id"]."\")' >
                            HABILITAR
                          </a>
                    

                      </td>
                      "?>
                  </tr>
                 <?php  
                    }

                 ?>
                  
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
