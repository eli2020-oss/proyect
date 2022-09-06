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
$sql="SELECT count(c.id) as con FROM bd_local.categorias_user as c 
inner join bd_local.tbl_user as u where c.id_user='".$_COOKIE["id"]."'";
//echo $sql;
$con="";
 $result=mysqli_query($conexion,$sql);
 while($row=mysqli_fetch_assoc($result))
    {
     $con=$row["con"];
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
          <?php
           if($con!=0)
           {
           
           
          ?>
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
                    <?php
                      $porc_mesa="";
                      $porc_sin="";
                      $porc_aten="";
                      $porc_mesi="";
                      $total="";
                      $rango="";
                      $mes="";
                      $fuera="";
                      $rango_si="";
                      $rango_aten="";
                      $atendidos_mes="";
                      $sql="SELECT MONTHNAME(t_fechaini) as namemes,count(tic_estado) as delmes,
                       (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='US-zw260US-6' and tic_estado='ACTIVO') as rango_sin,
                      (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='US-zw260US-6' and tic_estado='FINALIZADO') as rango_aten,
                    (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='US-zw260US-6') as rango,
                    (count(tic_estado) -(SELECT  count(tickes_id) FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='".$_COOKIE['id']."' and tic_estado='ACTIVO')) as fuera
                      , (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='".$_COOKIE['id']."' and tic_estado='ACTIVO')/(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='".$_COOKIE['id']."')*100 as porcen_sin
                      ,(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='".$_COOKIE['id']."' and tic_estado='FINALIZADO')/(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now() and us_id='".$_COOKIE['id']."')*100 as porcen_atendidos
                      ,(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where  us_id='".$_COOKIE['id']."' and tic_estado='ACTIVO' and MONTH(t_fechaini) =MONTH(curdate()))/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
                      and us_id='".$_COOKIE['id']."')*100 as porcen_sin_mes
                      ,(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where  us_id='".$_COOKIE['id']."' and tic_estado='FINALIZADO' and MONTH(t_fechaini) =MONTH(curdate()))/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
                      and us_id='".$_COOKIE['id']."')*100 as porcen_atendido_mes,
                      (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where  us_id='".$_COOKIE['id']."' and tic_estado='FINALIZADO' and MONTH(t_fechaini) =MONTH(curdate())) as atendido_mes
                      FROM  bd_local.tbl_ticketsc where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
                      and us_id='".$_COOKIE['id']."';";
                       //echo "sentencia ".$sql;
                       $result=mysqli_query($conexion,$sql);
                       while($row=mysqli_fetch_assoc($result))
                       {
                         
                   //   echo "<script>alert('hola');</script>";
                       $porc_mesa=$row['porcen_sin_mes']."";
                       $porc_mesi=$row['porcen_atendido_mes']."";
                       $porc_sin=$row['porcen_sin']."";
                       $porc_aten=$row['porcen_atendidos']."";
                       $mes=$row['namemes']."";
                       $rango=$row['rango']."";
                       $fuera=$row['fuera']."";
                      $total=$row["delmes"];
                      $rango_sin=$row['rango_sin']."";
                      $rango_aten=$row['rango_aten']."";
                      $atendidos_mes=$row['atendido_mes']."";
                       }
                   ?>
                      <strong>Monitereo General de usuario <b><?php echo $mes; ?></b></strong>
                    </p>
                    <div class="progress-group">
                      Tickets en rango
                      <span class="float-right"><b><?php echo $rango_sin; ?></b>/<?php echo $rango; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style='width: <?php echo $porc_sin; ?>%'></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Tickets del mes 
                      <span class="float-right"><b><?php echo $atendidos_mes; ?></b>/<?php echo $total ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php echo $porc_mesi ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Atendidos</span>
                      <span class="float-right"><b><b><?php echo   $rango_aten; ?></b>/<?php echo $rango; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $porc_aten; ?>%"></div>
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
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo  $porc_aten; ?>%</span>
                      <h5 class="description-header"><?php echo $rango_aten; ?></h5>
                      <span class="description-text">TOTAL FINALIZADO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?php echo  $porc_mesa; ?>%</span>
                      <h5 class="description-header"><?php echo  $fuera; ?></h5>
                      <span class="description-text">TOTAL DE TICKETS SIN ATENDER</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo  $porc_mesi; ?>%</span>
                      <h5 class="description-header"><?php echo $atendidos_mes; ?></h5>
                      <span class="description-text">TOTAL DE TICKETS ATENDIDOS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 100%</span>
                      <h5 class="description-header"><?php echo  $total; ?></h5>
                      <span class="description-text">TOTAL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <?php
           }else if($con==0)
           {
            ?>
               <div class="col-md-12">
            <div class="card">
        <div class="card-header">
          <h3 class="card-title">Control de tickets</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Envia tu solicitudes de apoyo tecnico!
        </div>
           </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
            <?php
           }
           
           
          ?>    
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
                      <td><a href="bandeja.php"><?php echo $id; ?></a></td>
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
