<?php 
session_start();
include("Conexion.php");
$codigo=$_SESSION['ticketid'];
//echo "<script>alert('".$codigo."');</script>";
?> 
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../../dist/css/estilo.css">
<div class="container-fluid">
<div class="card-body">
                <!-- Conversations are loaded here -->
 <div class="direct-chat-messages">
          <?php 
 //echo "<script>alert('".$_POST['codigo']."');</script>";
                  $descrip="";
                  $quien_es="";
                  $fecha="";
                  $carpeta="";
                  $avatar="";
                  $sql="select * from( select de.tickes_id, de.d_descrip as descri, fnc_fecha(de.fecha) as fecha, de.respuesta as quien, de.archivo as arc, 
                  concat(u.f_name,' ',u.l_name) as nombre , u.avatar as avatar FROM bd_local.tbl_detalle as de inner join bd_local.tbl_user as u
                  inner join bd_local.tbl_ticketsc as ti 
                  where ti.tickes_id=de.tickes_id and u.id=de.respuesta and de.tickes_id='".$codigo."' ORDER BY de.fecha DESC )t 
                  order by fecha asc ";

                 //echo "SENTENCIA DE SQL ".$sql;
                  $result=mysqli_query($conexion,$sql);
                  while($row=mysqli_fetch_assoc($result))
                  {
                    
                 // echo "<script>alert('hola');</script>";
                 $avatar=$row['avatar'];
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
             
                <!-- /.card-header -->
           
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                    <?php if($quien_es=="YO")
                      {?>
                      <span class="direct-chat-name float-left"><?php echo $quien_es; ?></span>
                      <span class="direct-chat-timestamp float-right"><?php echo $fecha; ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src='<?php echo $avatar ?>' alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    <?php echo $descrip; ?>
                    </div>
                    <!-- /.direct-chat-text -->
                    <?php
                      }
                    ?>
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                    <?php
                        if($quien_es!="YO")
                      {?>
                      <span class="direct-chat-name float-right"><?php echo $quien_es; ?></span>
                      <span class="direct-chat-timestamp float-left"><?php echo $fecha; ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src='<?php echo $avatar ?>' alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    <?php echo $descrip; ?>
                    </div>
                    <!-- /.direct-chat-text -->
                    <?php }
                ?>
                  </div>
                  <!-- /.direct-chat-msg -->
                  <?php 
                }?>
                </div>
                <!--/.direct-chat-messages-->
               
              </div>
             
               
          </div>
</html>