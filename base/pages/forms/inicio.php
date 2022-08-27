<?php
session_start();
include('menu.php');
$login= $_COOKIE['id']."";
include('Conexion.php');
$c=0;
$sql="SELECT count(*)as c  FROM bd_local.tbl_detalle_emple where id='".$_COOKIE["id"]."';";
                 $result=mysqli_query($conexion,$sql);
                while($row=mysqli_fetch_assoc($result))
                   {
                    $c=$row["c"];
                   }
                   if($c==0)
                   {
                   // echo "<script>alert('insert');</script>";
                    $sql="INSERT INTO `bd_local`.`tbl_detalle_emple` (`id`, `em_estado`) VALUES ('".$login."', 'ACTIVO');                   ";
                    echo " el sql    ".$sql;
                      $result=mysqli_query($conexion,$sql);
                    $sql="INSERT INTO `bd_local`.`user_acceso` (`us_id`, `acc_id`, `estado`) VALUES ('".$login."', 'AC-5', 'ACTIVO');                    ";
                    $result=mysqli_query($conexion,$sql);
                    header("location: cambio_pass.php");
                   }
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
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
         
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monitoreo</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                
                  <!-- /.col -->
                  <div class="col-md-10">
                    <p class="text-center">
                      <strong>Monitereo General de usuario</strong>
                    </p>
                     <?php
                      $Porcentaje="";
                      $activos="";
                      $inactivos="";
                      $porcentajeinac="";
                      $total="";
                      $sql="select  count(tic_estado)*100/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where us_id='".$_COOKIE["id"]."'  ) as porcentaje, 
                      count(tic_estado) as activos,(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where  us_id='".$_COOKIE["id"]."' ORDER BY ti.t_fechaini  BETWEEN date_add(NOW(), INTERVAL -30 DAY) AND now())  as total,
                       MONTHNAME(t_fechaini) as Mes ,( SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where us_id='".$_COOKIE["id"]."' and tic_estado='FINALIZADO') as  inactivo,
                       ( SELECT count(tic_estado)*100/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where us_id='".$_COOKIE["id"]."' )  FROM bd_local.tbl_ticketsc  where us_id='".$_COOKIE["id"]."' and tic_estado='FINALIZADO') as inaporcentaje 
                       FROM  bd_local.tbl_user as u
                       inner join bd_local.tbl_ticketsc as ti where ti.us_id='".$_COOKIE["id"]."' 
                       and u.id=ti.us_id and tic_estado='ACTIVO' ORDER BY ti.t_fechaini  BETWEEN date_add(NOW(), INTERVAL -3 DAY) AND now()";
                       //echo "sentencia ".$sql;
                       $result=mysqli_query($conexion,$sql);
                       while($row=mysqli_fetch_assoc($result))
                       {
                         
                   //   echo "<script>alert('hola');</script>";
                       $porcentaje=$row['porcentaje']."";
                       $activos=$row['activos']."";
                       $inactivos=$row['inactivo']."";
                      $porcentajeinac=$row['inaporcentaje']."";
                      $total=$row["total"];
                       }
                   ?>
                    <div class="progress-group">
                      Tickets sin atender en rango
                      <span class="float-right"><b><?php echo $activos; ?></b>/<?php echo $total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style='width: <?php echo $porcentaje; ?>%'></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Finalizados</span>
                      <span class="float-right"><b><b><?php echo $inactivos; ?></b>/<?php echo $total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $porcentajeinac; ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo $porcentajeinac; ?>%</span>
                      <h5 class="description-header"><?php echo $inactivos; ?></h5>
                      <span class="description-text">TOTAL FINALIZADO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?php echo $porcentaje; ?>%</span>
                      <h5 class="description-header"><?php echo $activos; ?></h5>
                      <span class="description-text">TOTAL DE TICKETS SIN ATENDER</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 100%</span>
                      <h5 class="description-header"><?php echo $total; ?></h5>
                      <span class="description-text">TOTAL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-6">
            <!-- MAP & BOX PANE -->
            <div class="card">
              
              <!-- /.card-header -->
          
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Monitorieo de tickets</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                 
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Orden id</th>
                      <th>Descripcion</th>
                      <th>Estado</th>
                      <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $id="";
                    $descripcion="";
                    $estado="";
                    $fecha="";
                    $color="";
                  $sql="select * from( select ti.tickes_id as id, ti.titulo as titulo, ti.t_fechaini as fecha ,concat(u.f_name,' ',u.l_name) 
                  as nombre, tic_estado FROM  bd_local.tbl_user as u
                   inner join bd_local.tbl_ticketsc as ti where ti.us_id='".$_COOKIE['id']."' 
                   and u.id=ti.us_id  ORDER BY ti.t_fechaini BETWEEN date_add(NOW(), INTERVAL -3 DAY) AND now() DESC limit 5 )t 
                   order by fecha asc";
                   $result=mysqli_query($conexion,$sql);
                   while($row=mysqli_fetch_assoc($result))
                   {
                     
               //   echo "<script>alert('hola');</script>";
                   $descripcion=$row['titulo']."";
                   $fecha=$row['fecha']."";
                   $id=$row['id']."";
                  $estado=$row['tic_estado']."";
                   if($estado='ACTIVO')
                   {
                    $color="badge badge-succes";
                   }
                   else
                   {
                    $color="badge badge-danger";
                   }
                  ?>
                    <tr>
                      <td><a href="pages/examples/invoice.html"><?php echo $id; ?></a></td>
                      <td><?php echo $descripcion; ?></td>
                      <td><span class='<?php echo $color; ?>'><?php echo $estado; ?></span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $fecha; ?></div>
                      </td>
                    </tr>
                   <?php 
                   }
                   ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="titecks.php" class="btn btn-sm btn-info float-left">Nuevo</a>
                <a href="registro_ticks.php" class="btn btn-sm btn-secondary float-right">Ver historial</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
                <span class="info-box-number">5,200</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mentions</span>
                <span class="info-box-number">92,050</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Downloads</span>
                <span class="info-box-number">114,381</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Direct Messages</span>
                <span class="info-box-number">163,921</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
                  </section>     
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
