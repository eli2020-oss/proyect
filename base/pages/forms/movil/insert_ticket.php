<?php 
include ("conexion.php");
 $emisor=$_POST["id"];
// //$cc=isset($_POST["cmbuser"]);
 $titulo=$_POST["titulo"];
 $categoria=$_POST["categoria"];
// //$prioridad=$_POST['cmbprioridad'];
$filial=$_POST["filial"];
// //$area=$_POST["cmbarea"];
$descripcion=$_POST["mensaje"];
$latitud=$_POST["latitud"];
 $longitud=$_POST["longitud"];

// $emisor='US-BAyA6';
// //$cc=isset($_POST["cmbuser"]);
// $titulo='Prueba editar';
// $categoria='C-0001';
// //$prioridad=$_POST['cmbprioridad'];
// $filial='3';
// //$area=$_POST["cmbarea"];
// $descripcion='prueba detalle';
// $latitud='11111';
// $longitud='222222';

$fechaan="";
 $fechanew="";
 $contadord;
 $orig="";
 $consulta="SELECT fecha,concat(CURDATE()) as compa,id,concat(f_name,' ',l_name) 
 as nombre,contador_transacciones FROM   bd_local.transacciones inner join bd_local.tbl_user";
  $resultado=mysqli_query($conexion,$consulta);
   while($row=mysqli_fetch_assoc($resultado))
       {
         $fechaan=$row["fecha"]."";
          $fechanew=$row["compa"]."";
          $contadord=$row["contador_transacciones"].""; 
       }
 if ($fechaan!=$fechanew) 
 {
        //Renovar contador de tickets
        $sql=" UPDATE `bd_local`.`transacciones` SET `fecha` = CURDATE(), `contador_transacciones` = '0' WHERE (`codigo` = '0');";
         $resultado=mysqli_query($conexion,$sql);  
 }
 else
 {
         $cambio;
        for ($i = 0; $i <= $contadord; $i++) {
        $cambio=$i+1;
        }
       $fechande='0-0-0 0:0:0';
 
              //CATEGORIA Y ASIGNACION DE USUARIO DE ATENCION DE TICKET
               $sqlc="SELECT u.id as mante FROM bd_local.categorias_user as cu inner join bd_local.tbl_user as u inner join
               bd_local.tbl_categoria as c where cu.id_user=u.id and cu.id_categoria=c.cate_id and cu.id_categoria='".$categoria."'  AND cu.estado='ACTIVO'"; 
       //    echo "SQL ".$sqlc;
           $resultado=mysqli_query($conexion,$sqlc);
           while($row=mysqli_fetch_assoc($resultado))
                 {
                   $man=$row['mante']."";
                 }
                 $sql2="SELECT count(de.tickes_id) as contador FROM bd_local.tbl_detalle as de 
                  inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                  // echo "SQL ".$man;
                  $contador=0;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {

                            $contador=$row['contador'];
                          } 
                        }
               // echo "pRIMERO  ".$contador;
               $contador=$contador+3; 
               $consulta="INSERT INTO `bd_local`.`tbl_ticketsc` (`tickes_id`, `o_us`, `us_id`, 
               `cate_id`, `tk_nivel`, `titulo`, `tk_descripcion`, `t_fechaini`, `tfechafinal`,
                `cc`, `tk_filial`, `tk_area`, `latitud`, `longitud`, `tic_estado`) VALUES (concat(CURDATE()+0,'-".$cambio."'),
                 '".$emisor." ', '".$man."', '".$categoria."', 'MEDIO', '".$titulo."', '".$descripcion."',
                 concat(now()), '".$fechande."', 'NO ASIGNADO', '".$filial."', 'NO DEFINIDA', '".$latitud."', '".$longitud."', 
                  'ACTIVO');
               ";
            
                //echo "SQL ".$consulta;
                mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
              
            
               // echo $sql;
                  $sql1=" UPDATE `bd_local`.`transacciones` SET `contador_transacciones` = '".$cambio."' WHERE (`codigo` = '0');";
                   $resultado=mysqli_query($conexion,$sql1);

                   $sql="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, 
                   `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) VALUES ('DLL-".$contador."', concat(CURDATE()+0,'-".$cambio."'), 
                   '".$emisor."', '".$man."', '".$descripcion."', concat(now()),
                    'ACTIVO', '".$emisor."', '".$ruta."');";
                    echo $sql;
                     $result=mysqli_query($conexion,$sql);
                     mysqli_close($conexion);

           
          
              
?>