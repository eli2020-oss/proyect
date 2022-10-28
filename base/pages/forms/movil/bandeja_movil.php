<?php
include('conexion.php');
$email=$_GET['email'];
$arre="";
$id="";
$consulta="SELECT id ,email FROM  
bd_local.tbl_user where email='".$email."' ";
                         // echo $consulta;
                              $result=mysqli_query($conexion,$consulta);
                              while($row=mysqli_fetch_assoc($result))
                           {
                            
                                   //SE IDENTIFICA QUE TIPO DE USUARIO ES
                                   $id=$row['id']."";
                                 $permitir="ACTIVO";
                                  //echo $row['identi']."  ";
                                
                               // echo $row['email']." ".$_GET['email']
                          }
                          //$permitir='ACTIVO';
                         // $id='US-zw260US-6';
                         $consulta="
                         select
                                                  ti.tickes_id as ids,
                                                  ti.titulo nombre,
                                                  fnc_fecha(t_fechaini) as fecha,
                                                 ti.tic_estado as estado
                                                  from
                                                  bd_local.tbl_ticketsc ti
                                                  inner join bd_local.tbl_user u on u.id=ti.o_us
                                                  inner join bd_local.tbl_categoria ct on ct.cate_id=ti.cate_id
                                                  inner join bd_local.tbl_user usat on usat.id=ti.us_id 
                                                  inner join bd_local.categorias_user catu on catu.id_categoria=ti.cate_id  and ti.o_us='".$id."' 
                                                  and catu.estado='ACTIVO' and ti.tic_estado='ACTIVO' group by  ti.tickes_id 
                          ";
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