<?php
session_start();

$login= $_COOKIE["id"]."";
//echo "<script>alert('".$login."');</script>";
include('Conexion.php');
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cambio de contraseña</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script type="text/javascript">
  function Validar()
      {
        if(document.getElementById("pass").value=="")
        {
          alert("Ingrese un dato ");
          document.getElementById("pass").focus();
        }
        if(document.getElementById("confpass").value=="")
        {
          alert("confirme la contraseña");
          document.getElementById("confass").focus();
        }
       else
       {
        if(document.getElementById("accion").value=="")
          {
            //alert('si llega');
            document.getElementById("accion").value="guardar";
          }
          document.getElementById("formulario").submit();
       }
       
        return false;
      }
   
</script>
<body class="hold-transition login-page">
<?php 
  // echo "<script>alert('Nuevo dia');</script>";

  if($accion=="guardar")
   {
   
 
    $sql1="UPDATE `bd_local`.`tbl_user` SET `password` = '".$_POST['pass']."' WHERE (`id` = '".$_COOKIE['id']."')";
       $resultado=mysqli_query($conexion,$sql1);
      $accion="";
      //echo "<script>alert('Informacion Guardada Satisfactoriamente');</script>";
      header('Location: inicio.php');
   }

?>
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Cooperativa </b>Ceibeña</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Cambio de contraseña</p>
      <form name='formulario' id='formulario' class="principal" action="new_pass.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
        <div class="input-group mb-3">
          <input type="password" name='pass' id='pass' class="form-control" placeholder="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name='confpass' id='confpass' class="form-control" placeholder="Confirmar Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button  class="btn btn-primary btn-block" onclick="return Validar();" >Aceptar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
