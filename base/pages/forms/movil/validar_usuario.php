<?php
include('conexion.php');
$email_usuario=$_POST['usuario'];
$pass_usuario=$_POST['password'];

// $email_usuario='elygutierrez2015001@gmail.com';
// $pass_usuario='123456789';

$sentencia=$conexion-> prepare("select * from bd_local.tbl_user where email=? and password=?");
$sentencia->bind_param('ss',$email_usuario,$pass_usuario);
$sentencia->execute();

$resultado = $sentencia->get_result();
if($fila = $resultado-> fetch_assoc()){
    echo json_encode($fila,JSON_UNESCAPED_UNICODE);
}
$sentencia->close();
$conexion->close();
?>