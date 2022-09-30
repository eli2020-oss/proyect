<?php 
$codigo=$_POST['tickes_id'];
$emisor=$_POST["d_user"];
$mensaje=$_POST["d_descrip"];

include ("conexion.php");


                      $sql2="SELECT count(de.tickes_id) as c FROM bd_local.tbl_detalle as de 
                      inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                      // echo "SQL ".$sql2;
                      $contador=0;
                      $cod=0;
                    $result=mysqli_query($conexion,$sql2);
                              while($row=mysqli_fetch_assoc($result))
                              {
    
                                $contador=$row['c'];
                              } 
                              $cod=$contador+3; 

                      $consulta="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, 
                      `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) VALUES ('DLL-".$cod."', '".$codigo."', 
                      '', '".$emisor."', '".$mensaje."', concat(now()),
                       'ACTIVO', '".$emisor."', '');";
                       mysqli_query($conexion,$consulta) or die(mysqli_error());
                       mysqli_close($conexion);

  ?>