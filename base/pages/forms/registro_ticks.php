<?php
session_start();
include('menu.php');
$login= $_SESSION["login"]."";
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
  function Validar()
      {
       
         <?php
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";
    $estado="ACTIVO";
    $nombre="";
    $consulta="SELECT em_nombre FROM bd_local.tbl_emple;";
  $result=mysqli_query($conexion,$consulta);
      while($row=mysqli_fetch_assoc($result))
      {
        $nombre=$row["em_nombre"]."";
      }

    $sql="";
    //echo "<script>alert('Informacion Modificada Satisfactoriamente');</script>";
    ?>
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
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
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
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID TICKETS</th>
                    <th>HECHO POR</th>
                    <th>DESCRIPCION</th>
                    <th>FECHA DE CREACION DE TICKETS</th>
                    <th>ESTADO</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                          $sql="SELECT ti.tickes_id as ids,em.em_nombre as nombre,ti.tk_descripcion as descrip,ti.t_fechaini as fecha,ti.tic_estado as estado
                           FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                           inner join bd_local.tbl_emple as em inner join bd_local.tbl_categoria as ca  
                           inner join bd_local.categorias_user as cu where ti.o_us=us.us_id and us.em_id=em.em_id 
                           and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria and us.nuser='".$_SESSION['login']."'";
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                           echo "
                      <tr>
                         <tr>
                      <td>
                          ".$row["ids"]."
                      </td>
                      <td>
                          <a>
                           " .$row["nombre"]."
                          </a>
                         
                      </td>
                      <td>
                           " .$row["descrip"]."
                      </td>
                      <td>
                        " .$row["fecha"]."
                      </td>
                      <td>
                       ".$row["estado"]."
                      </td>
                      ";
                          }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>ID TICKETS</th>
                    <th>HECHO POR</th>
                    <th>DESCRIPCION</th>
                    <th>FECHA DE CREACION DE TICKETS</th>
                    <th>ESTADO</th>
                  </tr>
                  </tfoot>
                </table>
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
</div>
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
</body>
</html>
