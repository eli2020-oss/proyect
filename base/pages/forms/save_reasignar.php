<?php
 include("Conexion.php");
 
 $cc=$_POST["cmbuser"];

 $prioridad=$_POST['cmbprioridad'];
 $descripcion=$_POST["accion"];
 $id=$_POST["id"];
//echo "ID ticket ".$id." ".$cc." ".$prioridad." ".$descripcion;
$fechaan="";
$fechanew="";
$contadord;
$orig="";
$consulta="SELECT concat(CURDATE()) as compa FROM   bd_local.transacciones inner join bd_local.tbl_user";
 $resultado=mysqli_query($conexion,$consulta);
  while($row=mysqli_fetch_assoc($resultado))
      {
    
         $fechanew=$row["compa"]."";
      }
if($_FILES["archivo"]["error"]>0){

echo "no hay archivo";
   }else 
   {
       $permitidos= array("image/jpng","image/png","application/pdf");
       $limite_kb = 10000;
       if(in_array($_FILES["archivo"]["type"],$permitidos) && $_FILES["archivo"]["size"]<= $limite_kb * 124){
          $ruta = 'files/'.$fechanew."-".$id."_".$cc.'/';
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
   $sql="UPDATE `bd_local`.`tbl_ticketsc` SET `us_id` = '".$cc."', `tk_nivel` = '".$prioridad."' 
   
   WHERE (`tickes_id` = '".$id."');
   ";
   $resultado=mysqli_query($conexion,$sql);
   $iddetalle="";
   $sql="SELECT MAX(deta_id),deta_id FROM bd_local.tbl_detalle where tickes_id='".$id."'";
   $result=mysqli_query($conexion,$sql);
   while($row=mysqli_fetch_assoc($result))
   {
      $iddetalle=$row["deta_id"];
   }
 //  echo $iddetalle;
   $sql="UPDATE `bd_local`.`tbl_detalle` SET `archivo` = '".$ruta."' WHERE (`deta_id` = '".$iddetalle."');";
   $resultado=mysqli_query($conexion,$sql);
   header("Location:inicio.php");
?>
