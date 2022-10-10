<?php
session_start();
include('menu.php');
//$login= $_SESSION["login"]."";
$estado='ACTIVO';
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
//$direccion=isset($_POST["direccion"])?$_POST["direccion"]:""; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de Entradas | Salidas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

<script type="text/javascript">
   function enviados()
		  {
     
        $("#box").load("filtros_inbox/sent.php");
     return false;
    }
    function recibidos()
    {
      $("#box").load("control_bandeja.php");
      return false;
    }
    function emergencia()
    {
      $("#box").load("filtros_inbox/emergencia.php");
      return false;
    }
    function media()
    {
      $("#box").load("filtros_inbox/media.php");
      return false;
    }
    function normal()
    {
      $("#box").load("filtros_inbox/normal.php");
      return false;
    }
</script>

</head>
<body class="hold-transition sidebar-mini">
 <?php 
 //echo "<script> alert(".$accion.");</script>";
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control de Tickets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Control de Tickets</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="titecks.php" class="btn btn-primary btn-block mb-3">Nuevo</a>
             <div class="card">
             
          <div class="card-header">
              <h3 class="card-title">Filtros</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <?php
              $permiso=false;
               $consulta="SELECT count(us_id)  as permitir FROM bd_local.user_acceso where us_id='".$_COOKIE['id']."' and estado='ACTIVO' and acc_id='AC-2' ;";
              //  echo $consulta;
                  $result=mysqli_query($conexion,$consulta);
                  while($row=mysqli_fetch_assoc($result))
               {
                   if($row['permitir']==1)
                   {
                    $permiso=true;
                   }
               }
               if($permiso==true)
               {
              ?>
              <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                  <a href="" class="nav-link" onClick="return recibidos();">
                    <i class="fas fa-inbox"></i>
                 RECIBIDOS
                  </a>
                </li>
                <li class="nav-item">
                  <a href="registro_ticks.php" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                  FINALIZADO
                  </a>
                </li>
               
                <?php
               }
              ?>
               <li class="nav-item">
                  <a href="" class="nav-link" onClick="return enviados();">
                    <i class="far fa-envelope"></i>
                 ENVIADOS
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onClick="return emergencia();">
                    <i class="far fa-circle text-danger"></i>
                  EMEGERCIA
                  </a>
                  <li class="nav-item">
                  <a href="#" class="nav-link" onClick="return media();">
                    <i class="far fa-circle text-warning" ></i> MEDIO
                  </a></li>
                  <li class="nav-item">
                  <a href="#" class="nav-link" onClick="return normal();">
                    <i class="far fa-circle text-primary"></i>
                   NORMAL
                  </a>
                </li>
              </ul>
             
            </div>
           
          
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lista de Tickes</h3>
 

              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
         
               
                <div class="float-right">
                  <div class="btn-group">
                   
                  </div>
                   
                  <!-- /.final de controles de inbox -->
                </div>
                <!-- /.float-right -->
              </div> 
            
              <form  name='formulario' id='formulario' method='POST' action='muro.php' >
             <input type="hidden" id="codigo" name="codigo" class="form-control" value='<?php echo $codigo ?> '>
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
          
    

            <div id="box">
              <div class="card-body table-responsive p-0" style="height: 300px;">
         
              <!-- /.mail-box-messages -->
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
               
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->

              </div>
            </div>
          </div>
        
              </form>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">

 function cargar()
      {
      //  alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="enviar";
        // document.getElementById("codigo").value=codigo;
            document.getElementById("chat").submit();
    
      } 
//   $(document).ready(function(){
//     document.getElementById("boton").click();
//     $("boton").click(function(){
//         $("#box").load("control_bandeja.php");
//     });
// });
$(document).ready(function(){
        //alert("recarga");
        $("#box").load("control_bandeja.php");
});

</script>
</body>
</html>
