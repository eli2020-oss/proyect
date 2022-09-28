<?php
include('conexion.php');
$email=$_GET['email'];
$consulta ="SELECT * FROM bd_local.tbl_user where email=$email ";
//echo $consulta."";
$resultado= $conexion -> query($consulta);
while($fila=$resultado -> fetch_array())
{
    $datos[] = array_map('utf8_encode',$fila);
}
echo json_encode($datos);
$resultado -> close();
?>