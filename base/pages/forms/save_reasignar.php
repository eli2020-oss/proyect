<?php
 include("Conexion.php");
 $emisor=$_COOKIE["id"];
 $cc=isset($_POST["cmbuser"]);
 //$titulo=$_POST["titulo"];
 $prioridad=$_POST['cmbprioridad'];
//$descripcion=$_POST["textarea"];

echo $emisor." ".$cc." ".$prioridad;
if($_FILES["archivo"]["error"]>0){

 echo "no hay archivo";
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
   $sql="UPDATE `bd_local`.`tbl_ticketsc` SET `us_id` = 'cambio', `tk_nivel` = 'cambio' 
   
   WHERE (`tickes_id` = '20221011-1');
   ";
?>
