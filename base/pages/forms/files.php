<?php
 include("Conexion.php");
 $emisor=$_COOKIE["id"];
 $cc=isset($_POST["cmbuser"]);
 $titulo=$_POST["titulo"];
 $categoria=$_POST["cmbcategoria"];
 $prioridad=$_POST['cmbprioridad'];
 $filial=$_POST["cmbfilial"];
 $area=$_POST["cmbarea"];
$descripcion=$_POST["textarea"];

 //echo $emisor." ".$cc." ".$titulo." ".$categoria." ".$prioridad." ".$filial." ".$area." ".$descripcion;
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
     //  echo "Consulta 1 ".$consulta;
 if ($fechaan!=$fechanew) 
 {
        //Renovar contador de tickets
        $sql=" UPDATE `bd_local`.`transacciones` SET `fecha` = CURDATE(), `contador_transacciones` = '0' WHERE (`codigo` = '0');";
         $resultado=mysqli_query($conexion,$sql);  
       //  echo "         renovoar contador de tockets ".$sql; 
 }
 else
 {
         $cambio;
        // for ($i = 0; $i <= $contadord; $i++) {
        // $cambio=$i+1;
        // }
        $cambio=$contadord+1;
        ///echo "Cambio      ".$cambio;
       $fechande='0-0-0 0:0:0';
 
              //CATEGORIA Y ASIGNACION DE USUARIO DE ATENCION DE TICKET
               $sqlc="SELECT u.id as mante FROM bd_local.categorias_user as cu inner join bd_local.tbl_user as u inner join
               bd_local.tbl_categoria as c where cu.id_user=u.id and cu.id_categoria=c.cate_id and cu.id_categoria='".$categoria."'  ORDER BY RAND() limit 1"; 
          // echo "CATEGORIA Y ASIGNACION DE USUARIO DE ATENCION DE TICKET  ".$sqlc;
          
           $resultado=mysqli_query($conexion,$sqlc);
           while($row=mysqli_fetch_assoc($resultado))
                 {

                   $man=$row['mante']."";
                 }
                 $sql2="SELECT count(de.tickes_id) as contador FROM bd_local.tbl_detalle as de 
                  inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                  // echo "SQL donde esta man ".$sql2;
                  // echo "man ".$man;
                  $contador=0;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {

                            $contador=$row['contador'];
                          } 
                         
                //echo "pRIMERO  ".$contador;
               $contador=$contador+3; 
          //    echo "sEGUNDO   ".$contador;
                  // echo "<script>alert('".$contador."');</script>";
                if($_FILES["archivo"]["error"]>0){

                 //   echo "no hay archivo";
                }else 
                {
                    $permitidos= array("image/jpng","image/png","application/pdf");
                    $limite_kb = 10000;
                    if(in_array($_FILES["archivo"]["type"],$permitidos) && $_FILES["archivo"]["size"]<= $limite_kb * 124){
                       $ruta = 'files/'.$fechanew."-".$cambio."_".$_COOKIE["id"].'/';
                       $archivo =$ruta.$_FILES["archivo"]["name"];
                       if(!file_exists($ruta))
                       {
                        mkdir($ruta);
                       }
                       if(!file_exists($archivo))
                       {
                        $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo);
                        if($resultado)
                        {
                           // echo "Archivo guardado";
                        }else{
                            echo "error al guardar archivo";
                        }
                       }
                    }else
                    {
                    echo "Archivo no permitido p excede el size";
                    }
                }
              $sql="INSERT INTO `bd_local`.`tbl_ticketsc` 
              (`tickes_id`, `o_us`, `us_id`, `cate_id`, `tk_nivel`, `titulo`, `tk_descripcion`, 
              `t_fechaini`, `tfechafinal`, `cc`,`tk_filial`,`tk_area`, `tic_estado`) VALUES (concat(CURDATE()+0,'-".$cambio."'), '".$_COOKIE["id"]."', 
              '".$man."', '".$categoria."', '".$prioridad."', '".$titulo."', '".$descripcion."', 
              concat(now()) , '".$fechande."', '".$cc."','".$filial."','". $area."', 'ACTIVO');";
               // echo "Insertar ticket ".$sql;
             $resultado=mysqli_query($conexion,$sql);
             $sql2="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, 
             `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) VALUES ('DLL-".$contador."', concat(CURDATE()+0,'-".$cambio."'), 
             '".$_COOKIE["id"]."', '".$man."', '".$descripcion."', concat(now()),
              'ACTIVO', '".$_COOKIE['id']."', '".$ruta."');";
               $result=mysqli_query($conexion,$sql2);
              // echo "Insertar detalle ".$sql2;
                 $sql1=" UPDATE `bd_local`.`transacciones` SET `contador_transacciones` = '".$cambio."' WHERE (`codigo` = '0');";
                  $resultado=mysqli_query($conexion,$sql1);
                //  echo "uptualizacion de transaccion ".$sql2;
              header("Location:inicio.php");
 }
  
?>
