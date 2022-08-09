<?php
include("Conexion.php");
session_start();
//$_SESSION['iden']=$_POST['id'];
$login=isset($_POST["login"])?$_POST["login"]:"";
$pass=isset($_POST["pass"])?$_POST["pass"]:"";
$_SESSION['login']=$login;

$confirma=false;
$sql="select
nuser, pass
from tbl_user where nuser='".$_SESSION["login"]."' and pass='".$pass."'";
$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_assoc($result))
	{
	$confirma=true;
	//echo "<script>alert('Entra');</script>";
	echo $sql;
	echo $_SESSION;
 	}
if ($confirma)
{
	header("Location:inicio.php");
}else

	header("Location:index1.php");

?>
