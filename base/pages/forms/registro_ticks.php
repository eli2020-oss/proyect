<?php
session_start();
include('menu.php');
include('Conexion.php');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TICKES REGISTRADOS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script type="text/javascript">
function cambiar(e,id,user)
		{
      $.ajax({
				type: 'POST',
				url: "cambio_estado.php",
				data: {ida:id,us:user,estado:e},
				success: function(data)
				{
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
<script type="text/javascript">
 function cambio()
      {
       /// alert("Entra");
   
           document.getElementById("formulario").submit();
      } 
      
  
</script>

<body class="hold-transition sidebar-mini">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Tickes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Registro de tickes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Historial de tickes</h3>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <form name='formulario' id='formulario' class="principal" action="registro_ticks.php" method="POST">
                <label>Usuario</label>
                  <select  class="form-control select2" id="cmbuser" name="cmbuser" style="width: 100%;" onchange="return cambio();" >
                 <?php 
                    echo "<option value=''>[----SELECCIONE UN USUARIO----]</option>";
                      $sql="SELECT u.id as codigo,concat(u.f_name,' ',u.l_name) as nombre FROM bd_local.tbl_user as u 
                      inner join  bd_local.tbl_detalle_emple as e where u.id=e.id and e.em_estado='ACTIVO'";
                      $result=mysqli_query($conexion,$sql);
                      while($row=mysqli_fetch_assoc($result)) 
                      {
                        $opcion=($row["nombre"]==$cmbtarifas?"selected=selected":"");
                        echo "<option value='".$row['codigo']."' ".$opcion.">".$row['nombre']."</option>";
                      }
                    ?>
                  </select>
                  
                </div>
                <!-- /.form-group -->
              
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               
              </div>
              <!-- /.col -->
              <div class="btn-group w-100">
                      
            </div>
            <!-- /.row -->
          </div>
          <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Titulo</th>
                    <th>Fecha de finalizacion</th>
                    <th>Accion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $vacio=(isset($_POST["cmbuser"])?$_POST["cmbuser"]:"");
                 //echo $_POST['cmbuser'];
                   if($vacio!="")
                   { 
                    $sql="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre,
                    ti.titulo as descrip,ti.tfechafinal as fecha, ti.tic_estado as estado 
                    FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                    inner join bd_local.tbl_categoria as ca inner join bd_local.categorias_user as cu
                     where  ti.o_us=us.id and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria and 
                     ti.o_us='".$_POST["cmbuser"]."' and ti.tic_estado='FINALIZADO' ORDER BY ti.t_fechaini desc ";
                    //echo $sql;
                    $result=mysqli_query($conexion,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "
                      <tr>
                        <td>".$row['ids']."</td>
                        <td>".$row['descrip']."</td>
                        <td>".$row['fecha']."</td>
                        <td>
                        <a class=' btn btn-primary btn-sm'  onclick='return cambiar(\"".'1'."\",\"".$row["ids"]."\")' >
                        VER CHAT
                          </a>
                        </td>
                      </tr>
                      ";
                   }
                  }?>
                  </tbody>
                
                </table>
              </div>
                  
              <!-- /.card-body -->
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

                </form>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  
  });

  
</script>
</body>
</html>
