<?php 
session_start();
include("Conexion.php");
$codigo=$_SESSION['ticketid'];
//echo "<script>alert('".$codigo."');</script>";
?> 
<!DOCTYPE html>
<html>
<div class="container-fluid">

<!-- Timelime example  -->
          <?php 
 //echo "<script>alert('".$_POST['codigo']."');</script>";
                  $descrip="";
                  $quien_es="";
                  $fecha="";
                  $carpeta="";
                  $sql="select * from( select de.tickes_id, de.d_descrip as descri, de.fecha as fecha , de.respuesta as quien, de.archivo as arc, 
                  concat(u.f_name,' ',u.l_name) as nombre FROM bd_local.tbl_detalle as de inner join bd_local.tbl_user as u
                  inner join bd_local.tbl_ticketsc as ti 
                  where ti.tickes_id=de.tickes_id and u.id=de.respuesta and de.tickes_id='".$codigo."' ORDER BY de.fecha DESC LIMIT 4)t 
                  order by fecha asc";

                 // echo "SENTENCIA DE SQL ".$sql;
                  $result=mysqli_query($conexion,$sql);
                  while($row=mysqli_fetch_assoc($result))
                  {
                    
                 // echo "<script>alert('hola');</script>";
                  $descrip=$row['descri']."";
                  $fecha=$row['fecha']."";
                  $carpeta=$row['arc']."";
                   if($row['quien']==$_COOKIE['id'])
                   {
                    $quien_es= 'YO';
                   }
                   else
                   {
                    $quien_es=$row['nombre'];
                   }
                  ?>
    <div class="row">
       <div class="col-md-12">
    <!-- The time line -->
       <div class="timeline">  
            <div>
         <i class="fas fa-envelope bg-blue"></i>
          <!-- INICIO DE MENSAJE -->
           <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i><?php echo $fecha; ?> </span>
                <h3 class="timeline-header"><?php echo $quien_es; ?></h3>

                <div class="timeline-body"><?php echo $descrip; ?></div>
                <div>
                  <?php 
                 
                  // $listar=null;
                   $directorio=opendir($carpeta);
                // echo $directorio."";
                   if($carpeta=='')
                   {}
                   else{
                   while($elemento= readdir($directorio))
                   {
                   // echo "hola 1";
                    if($elemento !='.' && $elemento !='..')
                    {
                      $direc=$carpeta.''.$elemento;
                     // echo is_dir($direc)."";
                     echo "<a class='cal-md-6' href='$direc' target='_blank'> $elemento</a><br>";
                     
                    }
                   }
                   }
                  ?> 
                </div>
              </div>
        </div>
        <?php 
                  }
        ?>
        
    </div>
  </div>
  <!-- /.col -->
</div>
</html>