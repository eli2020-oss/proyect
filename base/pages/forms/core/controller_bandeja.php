<?php
include("../Conexion.php");
$estado=$_POST["estado"];
$idticket=$_POST["ida"];
$detallec="";
//echo $idticket;
if($estado=='0')
{
    //echo 'finalizar ticket abierto';
    $sql="UPDATE `bd_local`.`tbl_ticketsc` SET `tfechafinal` = now(), `tic_estado` = 'FINALIZADO' WHERE (`tickes_id` = '".$idticket."');";
    $result=mysqli_query($conexion,$sql);
   
}
else if($estado=='1')
{
  $_SESSION["ticket"]=$idticket;
  echo ''.$_SESSION["ticket"];
 
}
?>