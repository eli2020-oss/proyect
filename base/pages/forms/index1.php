<?php 
require_once('config.php');
require_once('core/controller.Class.php');
include('Conexion.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <?php
  if(isset($_COOKIE["id"]) && isset($_COOKIE["sess"]))
  {
    $Controller = new Controller;
    if($Controller -> checkUserStatus($_COOKIE["id"],$_COOKIE["sess"])){
      $sql="SELECT id FROM bd_local.tbl_detalle_emple where id='".$_COOKIE['id']."'";
      $result=mysqli_query($conexion,$sql);
      $row=mysqli_fetch_assoc($result);
      
      if($row==$_COOKIE['id'])
      {
        header('Location: new_pass.php');
      }
      else
      {
        $resultado="";
        $sql="SELECT em_estado FROM bd_local.tbl_detalle_emple where id='".$_COOKIE['id']."'";
        $result=mysqli_query($conexion,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
          $resultado=$row["em_estado"];
        }
        //echo "<script>alert('".$resultado."');</script>";
        if($resultado=='ACTIVO')
        {
         header('Location: inicio.php');}
         else{
          echo "La cuenta esta inactiva";
         }
      }
    }
    else
    {
      //echo "error";
     // header('Location: new_pass.php');
    }
  }else
  {
  ?> 
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1">Coopererativa Ceibeña</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicio de sesion</p>

      <form name='formulario' id='formulario' method='Post' action="Comprobar_Login.php">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="exampleInputEmail1" name='exampleInputEmail1' placeholder="ejemplo@outlook.hn">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="exampleInputPassword1" name='exampleInputPassword1' placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            </div>
          </div>
          <div class="col-4">
            <button type="submit" value="Login" class="btn btn-primary btn-block" class="btn float-right login_btn">Login</button>
          </div>
        </div>
            <div class="social-auth-links text-center mt-2 mb-3">
      
        <a  type="submit" class="btn btn-block btn-danger" onclick="window.location = '<?php echo $login_url;  ?>'">
          <i class="fab fa-google-plus mr-2"></i> Registrarse con Google+
        </a>
      </div>
      </form>

      <!-- /.social-auth-links -->
      <!-- <p class="mb-1">
        <a href="forgot_password.php">No recuerdo mi contraseña </a>
      </p> -->
    </div>
  </div>
  <?php
  } 
      ?> 
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
