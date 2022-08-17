<?php
session_start();
include('menu.php');
$login= $_COOKIE['id']."";
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inicio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
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
                <h3 class="card-title">Inicio</h3>
              </div>
              <!-- /.card-header -->
               <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <?php 
                  $contadort=0;
                 $sql="SELECT tickes_id FROM bd_local.tbl_ticketsc inner join bd_local.tbl_user as u inner join bd_local.tbl_emple as e
 WHERE t_fechaini BETWEEN date_add(NOW(), INTERVAL -3 DAY) AND now() and  e.em_id=u.em_id and 
 tic_estado='ACTIVO' and id='".$_COOKIE["id"]."';";
                  $result=mysqli_query($conexion,$sql);
                 while($row=mysqli_fetch_assoc($result))
                    {
                      $contadort=$contadort+1;
                    }


                 ?>
                <h3><?php echo $contadort;  ?></h3>

                <p>Nuevo Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="titecks.php" class="small-box-footer">Mas<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0</sup></h3>

                <p>Finalizados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php 
                  $contador=0;
                 $sql="SELECT us_id FROM bd_local.tbl_user where u_estado='ACTIVO';";
                  $result=mysqli_query($conexion,$sql);
                 while($row=mysqli_fetch_assoc($result))
                    {
                      $contador=$contador+1;
                    }


                 ?>
                <h3><?php echo $contador;  ?></h3>

                <p>Usuarios registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="user_mp.php" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                 <?php 
                  $contadore=0;
                 $sql="SELECT tickes_id FROM bd_local.tbl_ticketsc where tk_nivel='EMERGENCIA' and tic_estado='ACTIVO';";
                  $result=mysqli_query($conexion,$sql);
                 while($row=mysqli_fetch_assoc($result))
                    {
                      $contadore=$contadore+1;
                    }


                 ?>
                <h3><?php echo $contadore;  ?></h3>

                <p>Emergencias</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
            <!-- /.card -->

            <!-- Vertical grouping -->
   
               
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
<script>
  document.getElementById('sweetalert').addEventListener('click',function(){
    const {value : pass} =  Swal.fire({
        title:'IMPORTANTE!',
         text:'Por favor cambiar la contraseña temporal. ',
    
         icon:'warning',
       
         padding:'1rem',
        
         backdrop:true,
        
         position:'center',
         allowOutsideClick: false,
         allowEscapeKey: false, 
         allowEnterKey: false,
         stopKeydownPropagation: false,
    
         input: 'password',
         inputPlaceholder: '123' ,
        inputValue:'',
     
         showConfirmButton:true,
         confirmButtonColor:'#dc3545',
         confirmButtonAriaLabel:'Confirmar'
    
       
    });
  })
</script>

</body>
</html>
