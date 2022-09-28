<?php
session_start();
include('menu.php');
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
$_SESSION["ticketid"]=$codigo;
$user="";
$estado="";
 // echo "<script>alert('".$_SESSION['ticketid']."');</script>";
      include("Conexion.php"); 
   $accion=isset($_POST["accion"])?$_POST["accion"]:"";
     $contador=0;
     $sql="SELECT concat(f_name,' ',l_name) as nombre FROM bd_local.tbl_user where id='".$_COOKIE["id"]."';";                       
     $result=mysqli_query($conexion,$sql);
         while($row=mysqli_fetch_assoc($result)){ $user=$row['nombre'];}
        // echo "<script>alert('".$user."');</script>"; 
        $sql="SELECT tic_estado FROM bd_local.tbl_ticketsc where tickes_id='".$codigo."';";                       
        $result=mysqli_query($conexion,$sql);
            while($row=mysqli_fetch_assoc($result)){ $estado=$row['tic_estado'];}
         // echo "<script>alert('".$estado."');</script>"; 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHAT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>


<body class="hold-transition sidebar-mini">
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Chat</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  
    <section class="content">
        <!-- Inicio de contenedor -->
        <div id="box">
        <h2>Click button to load new content inside DIV box</h2>
        </div>
      <!-- /.final del contenedor -->
                  <!-- /.card -->
                  <div class="card-footer">
                   <form name='chat' id='chat' method="POST">
                    <?php 
                    if($accion=="enviar")
                    {
                      //echo "<script>alert('.$codigo.');</script>"
                      $sql2="SELECT count(de.tickes_id) as c FROM bd_local.tbl_detalle as de 
                      inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                      // echo "SQL ".$sql2;
                      $contador=0;
                      $cod=0;
                    $result=mysqli_query($conexion,$sql2);
                              while($row=mysqli_fetch_assoc($result))
                              {
    
                                $contador=$row['c'];
                              } 
                              $cod=$contador+3; 
                      $sql="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, 
                      `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) VALUES ('DLL-".$cod."', '".$codigo."', 
                      '', '".$_COOKIE["id"]."', '".$_POST['message']."', concat(now()),
                       'ACTIVO', '".$_COOKIE['id']."', '');";
                      $result=mysqli_query($conexion,$sql);
                    }
                    ?>
                     <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                     
                      <div class="input-group">
                      <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
                        <input type="text" name="message" id="message" placeholder="hola gracias ...." class="form-control">
                        <span class="input-group-append">
                           <button type="button" class="btn btn-warning" id="btnguardar" onClick='return cargar();'>Enviar</button>
                          
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">

 function cargar()
      {
      //  alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="enviar";
        // document.getElementById("codigo").value=codigo;
            document.getElementById("chat").submit();
    
      } 
  $(document).ready(function(){
    document.getElementById("boton").click();
    $("button").click(function(){
        $("#box").load("control_muro.php");
    });
});
$(document).ready(function(){
        $("#box").load("control_muro.php");
});
</script>
</body>
</html>
