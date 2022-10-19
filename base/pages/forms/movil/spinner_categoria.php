<?php
include('conexion.php');
//$codigo=$_GET['cate_id'];

// $consulta ="SELECT id_categoria,t_descripcion,cate_estado
// FROM bd_local.categorias_user inner join bd_local.tbl_categoria where id_categoria=cate_id and cate_estado='ACTIVO'
// and estado='ACTIVO'; ";
$consulta="SELECT  DISTINCT id_categoria ,t_descripcion,cate_estado
FROM bd_local.tbl_categoria as c 
inner join bd_local.categorias_user cu on c.cate_id=cu.id_categoria 
where id_categoria=cate_id and cate_estado='ACTIVO'
and estado='ACTIVO';";
$resultado= $conexion -> query($consulta);
while($row=$resultado -> fetch_array())
{
    $datos[] = array_map('utf8_encode',$row);
}
echo json_encode($datos);
$resultado -> close();
?>
