<?php 
include("../Conexion.php");

$mensaje=$_POST['message'];
$codigo=$_POST['codigo'];

$sql="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) 
VALUES ('DL-8', '".$codigo."', '', '".$mensaje."', now(), 'ACTIVO', '".$_COOKIE['id']."', 'todavia no');
";
echo '';
//echo mysqli_query($conexion,$sql);
?> 