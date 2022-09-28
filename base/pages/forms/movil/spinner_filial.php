<?php
include('conexion.php');
$consulta ="SELECT * FROM bd_local.tbl_filial where estado='ACTIVO';";
//echo $consulta."";
$resultado= $conexion -> query($consulta);
while($row=$resultado -> fetch_array())
{
    $datos[] = array_map('utf8_encode',$row);
}
echo json_encode($datos);
$resultado -> close();
?>