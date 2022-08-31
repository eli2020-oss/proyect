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
   /* $busqueda="SELECT deta_id FROM bd_local.tbl_detalle where tickes_id='".$idticket."';";
    $result=mysqli_query($conexion,$busqueda);
    while($row=mysqli_fetch_assoc($result)) 
    {
          $detallec=$row["deta_id"];

    }*/
    //echo $detallec; 
 //   header('Location: ../bandeja.php');
}
else if($estado=='1')
{
  $_SESSION["ticket"]=$idticket;
  echo ''.$_SESSION["ticket"];
  //echo "<script>alert(Primero'".$_SESSION["ticket"]."');</script>";
}
?>