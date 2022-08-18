<?php
include("Conexion.php");
session_start();
//$_SESSION['iden']=$_POST['id'];
$login=isset($_POST["exampleInputEmail1"])?$_POST["exampleInputEmail1"]:"";
$pass=isset($_POST["exampleInputPassword1"])?$_POST["exampleInputPassword1"]:"";
$_SESSION['login']=$login;
	
$confirma=false;
$sql="select email,password,session,u.id,avatar,em_estado from bd_local.tbl_user as u 
inner join bd_local.tbl_detalle_emple as e
 where u.id=e.id and email='".$login."' and password='".$pass."'";
//echo $sql;
$estado;
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
	{
	$confirma=true;
	// $_COOKIE['session']=$row['session'];
	// $_COOKIE['id']=$row['id'];
	setcookie("id",$row["id"],time()+60*60*24*30,"/",NULL);
    setcookie("sess",$row["session"],time()+60*60*24*30,"/",NULL);
		//echo "<script>alert('Entra');</script>";
	$estado=$row['em_estado']."";
	//echo $_SESSION;

}
if ($confirma)
{
     if($estado=='ACTIVO')
	 {
		ECHO 'ACTIVO';
		header("Location:inicio.php");
	 }
	 else 
	 {
		//echo 'INACTIVO';
		header("Location:inactivo.php");
	 }
	
}else
// echo "<script>alert('".$id."');</script>";
// echo "<script>alert('".$session."');</script>";
	header("Location:index1.php");

?>
