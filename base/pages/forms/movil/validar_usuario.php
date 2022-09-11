<?php
include('conexion.php');
$email=$_POST['usuario'];
$password=$_POST['password'];

// $email='elygutierrez2015001@gmail.com';
//  $password='123456789';

$sentencia=$conexion-> prepare("select * from bd_local.tbl_user where email=? and password=?");
$sentencia->bind_param('ss',$email,$password);
$sentencia->execute();

$resultado = $sentencia->get_result();
if($fila = $resultado-> fetch_assoc()){
    echo json_encode($fila,JSON_UNESCAPED_UNICODE);
}
$sentencia->close();
$conexion->close();
?>