<?php
session_start();
include('menu.php');
 // $_SESSION["login"];
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";
     $contador=0;
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHAT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script type="text/javascript">
     
    window.onload = localStorage.getItem("info");
   
   //alert( localStorage.info );
    //document.getElementById("codigo").value=localStorage.info;
  
</script>
<script type="text/javascript">
   function ENVIAR()
  {
    //alert("llega");
        if(document.getElementById("accion").value=="")
          {
          // alert('emtra');
            document.getElementById("accion").value="guardar";
           
          }
          document.getElementById("formulario").submit();
        
       return   
      
  }
  
</script>
<?php

$variablephp = "<script> document.write(localStorage.info) </script>";
//echo "variablephp = $variablephp";


   if($accion=="guardar")
     {
      $sql2="SELECT de.tickes_id FROM bd_local.tbl_detalle as de 
                  inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                  // echo "SQL ".$sql2;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {

                            $contador++;
                          } 
                          $contador=$contador+1; 
   //  echo "<script>alert('ingresa correctamente a la Informacion');</script>";
    // sql="";
                      
     }
?>
<body class="hold-transition sidebar-mini">
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Chat</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <?php 
         //echo "<script>alert('".$_POST['codigo']."');</script>";
       
         $descrip="";
                          $correo="";
                          $fecha="";
                          $origen="";
                          $salida="";
   
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
 
         
          

 $sql="SELECT de.tickes_id, de.d_descrip as descri, ti.o_us ou, ti.us_id as ud, en.em_correo as correo, de.fecha as fecha FROM bd_local.tbl_detalle as de inner join bd_local.tbl_ticketsc as ti inner join bd_local.tbl_emple as en inner join bd_local.tbl_user as us where ti.tickes_id=de.tickes_id and ti.o_us=de.o_user and ti.us_id=de.d_user and us.em_id=en.em_id and ti.us_id=us.us_id and de.tickes_id='".isset($variablephp)."'";

                          echo "SENTENCIA DE SQL ".$sql;
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                          echo "<script>alert('hola');</script>";
                          $descrip=$row['descri']."";
                          $correo=$row['correo']."";
                          $fecha=$row['fecha']."";
                          $origen=$row['ou']."";
                          $salida=$row['ud']."";
                          
 ?>
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i><?php echo $fecha; ?>
                   </span>
                  <h3 class="timeline-header"><?php echo $correo;  ?></h3>

                  <div class="timeline-body">
                   <?php echo $descrip; ?>
                  </div>
                  
                </div>
              </div>
             <?php } 
               if($accion=="guardar")
     {
      
        //echo "<script>alert('Guardar');</script>";
       $sql2="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, `d_descrip`, `fecha`, `estado`, `enviado`) VALUES ('DLL-".$contador."', '".isset($codi)."', '".$origen."', '".$salida."', '".$_POST['message']."', now(), 'ACTIVO', '".$_SESSION['login']."');";
         // echo " el sql".$sql;
           $result=mysqli_query($conexion,$sql2);

     }
              ?>
             <div class="timeline-footer">
                    <a class="btn btn-danger btn-sm" >AGREGAR IMG</a>
                  </div>
              <!-- END timeline item -->
              <!-- timeline time label -->
             
              <!-- /.timeline-label -->
             
             
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->
 

                 
                  <!-- /.card-body -->
                  <div class="card-footer">
                   <form name='formulario' id='formulario' class="principal" action="muro.php" method="POST">
                     <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                      <div class="input-group">
                        <input type="text" name="message" id="message" placeholder="hola gracias ...." class="form-control">
                        <span class="input-group-append">
                           <button type="button" class="btn btn-warning" id="btnguardar" onclick="return ENVIAR();">Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
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
