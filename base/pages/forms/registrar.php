<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NUEVA CUENTA</title>

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
        if(document.getElementById("txtnombre").value=="")
        {
          alert("No se reconoce el usuario");
          document.getElementById("txtnombre").focus();
        }
        else if(document.getElementById("txtcorreo").value=="")
        {
          alert("No se a ingresado el correo");
          document.getElementById("txtcorreo").focus();
        }
        else if(document.getElementById("txtpass").value=="")
        {
          alert("Ingrese una contrase;a");
          document.getElementById("txtpass").focus();
        }
        if(document.getElementById("txtpassconf").value=="")
        {
          alert("Confirmar contrase;a");
          document.getElementById("txtpassconf").focus();
        }
        else
        {
          if(document.getElementById("accion").value=="")
          {
            document.getElementById("accion").value="guardar";
          }
          document.getElementById("formulario").submit();
        }
        return false;
      }
         <?php
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";
    $estado="ACTIVO";
    //echo "<script>alert('Informacion Modificada Satisfactoriamente');</script>";
    ?>
  
</script>
<body class="hold-transition register-page">
  <?php 
       $contadord=0;
       $contra1="";
       $contra2="";
     
       if($accion=="guardar")
       {
        if($_POST["txtpass"]==$_POST["txtpassconf"])
        {
        $consulta="SELECT em_id FROM bd_local.tbl_emple;";
          $resultado=mysqli_query($conexion,$consulta);
            while($row=mysqli_fetch_assoc($resultado))
            {
               $contadord++;
            }
         //
        $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $sql="INSERT INTO `bd_local`.`tbl_emple` (`em_id`, `em_nombre`, `em_correo`, `em_ip`, `em_estado`) VALUES ('EM-".$contadord."', '".$_POST["txtnombre"]."', '".$_POST["txtcorreo"]."', '".$ip."', 'ACTIVO');";
        $sql1="INSERT INTO `bd_local`.`tbl_user` (`us_id`, `em_id`, `nuser`, `pass`, `u_estado`) VALUES ('US-".$contadord."', 'EM-".$contadord."', '".$_POST["txtcorreo"]."', '".$_POST["txtpass"]."', 'ACTIVO');";    
        // echo "SQL ".$sql; 
        $resultado=mysqli_query($conexion,$sql);
         $resultado1=mysqli_query($conexion,$sql1);
        $accion="";
       echo "<script>alert('Informacion Guardada Satisfactoriamente');</script>";
       }
       else
       {
          echo "<script>alert('Contrase;a distintas ');</script>";
       }
      }
 ?>
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="muro.php" class="h1">Cooperativa Ceibena</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Formulario de registro</p>

      <form name='formulario' id='formulario' class="principal" action="registrar.php" method="POST">
        <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="txtnombre" id="txtnombre" placeholder="Nombre Completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="txtcorreo" id="txtcorreo" placeholder="micorreo@outlook.hn">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="txtpass" id="txtpass" placeholder="Contrase;a">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="txtpassconf" id="txtpassconf" placeholder="Confirmar contrase;a">
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
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" value="Login" class="btn btn-primary btn-block" onclick="return Validar();">Guardar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="index1.php" class="text-center">Ya poseo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
