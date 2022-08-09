<?php
session_start();
include("../Conexion.php"); 

$login= $_SESSION["login"]."";
$codi= $_SESSION["codigo"]."";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Imprimir</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

 

<body class="hold-transition sidebar-mini">
<?php

          
$cor="hola";
$fecha="12/6/10";
$cate="";
$descrip="";
$soporte="";
 $sql="SELECT de.tickes_id, de.d_descrip as descri, ti.o_us ou, ti.us_id as ud, de.enviado as correo, de.fecha as fecha FROM bd_local.tbl_detalle as de inner join bd_local.tbl_ticketsc as ti inner join bd_local.tbl_emple as en inner join bd_local.tbl_user as us where ti.tickes_id=de.tickes_id and ti.o_us=de.o_user and ti.us_id=de.d_user and us.em_id=en.em_id and ti.us_id=us.us_id and de.tickes_id='".$_SESSION['codigo']."'";
// echo $sql;
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                         // echo "<script>alert('hola');</script>";
                         $descrip=$row['descri']."";
                          $correo=$row['correo']."";
                          $fecha=$row['fecha']."";
                          $origen=$row['ou']."";
                          $salida=$row['ud']."";
                        
 ?>
<body>
<div class="wrapper">
  <!-- Main content -->
 <div class="card-body p-0">
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
            </div>
            </div>
          <?php }  ?>
          </div>
        </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
