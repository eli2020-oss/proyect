<?php
    
     require "conexion.php";
     $codigo=$_GET['tickes_id'];
     
   //  echo $codigo;
     $sql="select * from( select de.tickes_id as id, de.d_descrip as descri, fnc_fecha(de.fecha) as fecha , de.respuesta as quien, de.archivo as arc, 
     concat(u.f_name,' ',u.l_name) as nombre FROM bd_local.tbl_detalle as de inner join bd_local.tbl_user as u
     inner join bd_local.tbl_ticketsc as ti 
     where ti.tickes_id=de.tickes_id and u.id=de.respuesta and de.tickes_id=".$codigo." ORDER BY de.fecha DESC )t 
     order by fecha asc ";

   //echo "SENTENCIA DE SQL ".$sql;
    //  $result=mysqli_query($conexion,$sql);
    //  while($row=mysqli_fetch_assoc($result))
    //  {
       
    // // echo "<script>alert('hola');</script>";
    //  $descrip=$row['descri']."";
    //  $fecha=$row['fecha']."";
    //  $carpeta=$row['arc']."";
    //   if($row['quien']==$_COOKIE['id'])
    //   {
    //    $quien_es= 'YO';
    //   }
    //   else
    //   {
    //    $quien_es=$row['nombre'];
    //   }
    // }
     $resultado= $conexion -> query($sql);
     while($fila=$resultado -> fetch_array())
     {
         $datos[] = array_map('utf8_encode',$fila);
     }
     echo json_encode($datos);
    $resultado -> close();
     ?>
