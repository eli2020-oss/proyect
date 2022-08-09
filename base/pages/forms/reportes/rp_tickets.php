<?php
session_start();
include("../Conexion.php"); 

$login= $_SESSION["login"]."";
//$codi= $_SESSION["codigo"]."";
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
 $sql="SELECT ti.tickes_id as ids,em.em_nombre as nombre,ti.tk_descripcion as descrip, 
TIMESTAMPDIFF(DAY,ti.t_fechaini, ti.tfechafinal) AS dias_transcurridos ,ti.tic_estado as estado
                           FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                           inner join bd_local.tbl_emple as em inner join bd_local.tbl_categoria as ca  
                           inner join bd_local.categorias_user as cu where ti.o_us=us.us_id and us.em_id=em.em_id 
                           and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria and cu.estado='ACTIVO' 
                           and us.nuser='".$_SESSION['login']."'";
// echo $sql;
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                         // echo "<script>alert('hola');</script>";
                         $descrip=$row['descrip']."";
                         
                          $fecha=$row['dias_transcurridos']."";
                          $id=$row['ids']."";
                        
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
                  <h3 class="timeline-header"><?php echo $id;  ?></h3>

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
