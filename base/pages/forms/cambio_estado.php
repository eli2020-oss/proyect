<?php 
include("Conexion.php");

$idacceso=$_POST["ida"];
$iduser=$_POST["us"];
$estado=$_POST["estado"];
$estanombre='';
//echo $estado;
if($estado==0)
    $estanombre='INACTIVO';
else if($estado==1)
    $estanombre='ACTIVO';

//echo $estanombre;
$c=0;
//echo $idacceso." ".$iduser;
  $sql="SELECT count(*)as c FROM bd_local.user_acceso where us_id='".$iduser."' and acc_id='".$idacceso."'";
  $result=mysqli_query($conexion,$sql);
  while($row=mysqli_fetch_assoc($result)) 
  {
        $c=$row["c"];
  }
  //echo $c;
  if($c==0)
  {
    $sql="INSERT INTO `bd_local`.`user_acceso` (`us_id`, `acc_id`, `estado`) VALUES ('".$iduser."', '".$idacceso."', 'ACTIVO');    ";
   // echo " el sql    ".$sql;
   
      $result=mysqli_query($conexion,$sql);
  }
  else
  {
    $sql="UPDATE `bd_local`.`user_acceso` SET `estado` = '".$estanombre."' WHERE (`us_id` = '".$iduser."') and (`acc_id` = '".$idacceso."');    ";
  //  echo " el sql    ".$sql;
      $result=mysqli_query($conexion,$sql);
  }

?>