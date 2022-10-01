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
  <link rel="stylesheet" href="../../dist/css/estilo.css">
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
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
             
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>
        <div id="box">
        <div class="contenedor">   
        <h2>Click button to load new content inside DIV box</h2>
</div>
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
        if(document.getElementById("message").value=="")
        {
         // alert("vacio");
          document.getElementById("message").focus();
        }
        else
        {
         document.getElementById("accion").value="enviar";
       
            document.getElementById("chat").submit();
        }
    
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
