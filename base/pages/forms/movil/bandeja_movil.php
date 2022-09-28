<?php
include('conexion.php');
$email=$_GET['email'];
$arre="";
$id="";
$consulta=" SELECT us.id as identi,estado,email FROM bd_local.categorias_user as cu inner join 
                          bd_local.tbl_user as us inner join bd_local.tbl_categoria as ca 
                           where cu.id_user=us.id and cu.id_categoria=ca.cate_id and estado='ACTIVO';";
                          //echo $consulta;
                              $result=mysqli_query($conexion,$consulta);
                              while($row=mysqli_fetch_assoc($result))
                           {
                             $arre="'".$row['email']."'";
                                 if($arre==$_GET['email'])
                                 {
                                   //SE IDENTIFICA QUE TIPO DE USUARIO ES
                                   $id=$row['identi']."";
                                 $permitir="ACTIVO";
                                  //echo $row['identi']."  ";
                                }
                               // echo $row['email']." ".$_GET['email'];
                          }
                          //$permitir='ACTIVO';
                         // $id='US-zw260US-6';
                          if ($permitir=='ACTIVO') 
                          {
                             //Usuario ADMINISTRADOR 
                             $consulta="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre,ti.titulo as descrip, fnc_fecha(ti.t_fechaini) as fecha,
                          ti.tic_estado as estado FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca inner join 
                           bd_local.categorias_user as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id
                           and ti.cate_id=cu.id_categoria and ti.us_id='".$id."' and ti.tic_estado='ACTIVO' ORDER BY ti.t_fechaini desc";
                         //echo $sql;
                         }
                         else 
                         {
                          $verboton=false;
                        // USUARIO BASE SIN PERMISOS
                        $consulta="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre ,ti.titulo as descrip,ti.tic_estado as estado
                         , fnc_fecha(ti.t_fechaini) as fecha FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca  inner join bd_local.categorias_user
                           as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria 
                           and us.id='".$id."' and ti.tic_estado='ACTIVO' ORDER BY ti.t_fechaini desc";
                           //echo $sql;
                         }
// $consulta ="SELECT * FROM bd_local.tbl_user where email=$email ";
//echo $consulta."";
$resultado= $conexion -> query($consulta);
 while($fila=$resultado -> fetch_array())
 {
     $datos[] = array_map('utf8_encode',$fila);
 }
 echo json_encode($datos);
$resultado -> close();
?>