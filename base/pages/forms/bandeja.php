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
    function cargar(codigo)
      {
        //alert('codigo'.codigo);
        //document.getElementById("accion").value="llenar";
        document.getElementById("codigo").value=codigo;
        document.getElementById("accion").value="dd";
           document.getElementById("direccion").value="read-inbox.php";
          // alert("".document.getElementById("direccion"));
          <?php
          if($accion=="dd")
          {
          $direccion="read-inbox.php";
           }
          ?>
        document.getElementById("formulario").submit();

      }   
</script>
<script type="text/javascript">
    function cargar1()
      {
      //alert('codigo'.codigo);
 
       //document.getElementById("formulario").submit();
         
      }   
</script>
<script type="text/javascript">
      function cambiar(e,id)
		  {
       // alert(id);
        //alert(e);
       $.ajax({
				type: 'POST',
				url: "core/controller_bandeja.php",
				data: {ida:id,estado:e},
				success: function(data)
				{
          if(e=='1')
          {
           // alert(data);
           document.getElementById("codigo").value=id;
           document.getElementById("formulario").submit();
            //location.href ="muro.php";
          }
          else
          {
            
          }
					//$("#tabla").append(data);
          //alert(data);

				},
				error: function(error)
				{
					alert("Error");
				}
			});
			return false;
		}   
</script>

</head>
<body class="hold-transition sidebar-mini">
<?php
if($accion=='filtro2')
{$estado="FINALIZADO";}
if($accion=='filtro1')
{$estado="ACTIVO";}
?>
<body >
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
              <h3 class="card-title">Filtro</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <?php
              $permiso=false;
               $consulta="SELECT count(us_id)  as permitir FROM bd_local.user_acceso where us_id='".$_COOKIE['id']."' and estado='ACTIVO' and acc_id='AC-6' ;";
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
                  <a href="registro_ticks.php" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                  FINALIZADO
                  </a>
                </li>
                <?php
               }
              ?>
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
<!-- ./wrapper -->

<!-- jQuery -->
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
  $(document).ready(function(){
    document.getElementById("boton").click();
    $("boton").click(function(){
        $("#box").load("control_bandeja.php");
    });
});
$(document).ready(function(){
        $("#box").load("control_bandeja.php");
});

</script>
</body>
</html>
