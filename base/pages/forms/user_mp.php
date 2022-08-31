<?php
session_start();
include('menu.php');
 // $_SESSION["login"];
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MODULO DE USER</title>
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
 function cargar1(codigo)
      {
        //alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="desabilitar";
         document.getElementById("cc").value=codigo;
          //var getInput =codigo;
         //localStorage.setItem("ab",getInput);
            document.getElementById("formulario").submit();
      } 
   
  
</script>
<script type="text/javascript">
 function cargar2(codigo)
      {
        
         document.getElementById("accion").value="habilitar";
         document.getElementById("cc").value=codigo;
         
            document.getElementById("formulario").submit();
      } 
   
  
</script>
  <?php    
      //MANEJO DEL ESTADO DE LOS USUARIOS 
        if($accion=='desabilitar')
        {  
          $sql="UPDATE `bd_local`.`tbl_detalle_emple` SET `em_estado` = 'INACTIVO' WHERE (`id` = '".$_POST['cc']."');";
          //echo " el sql    ".$sql;
          $result=mysqli_query($conexion,$sql);
        }
        if($accion=='habilitar')
        {
          
          $sql="UPDATE `bd_local`.`tbl_detalle_emple` SET `em_estado` = 'ACTIVO' WHERE (`id` = '".$_POST['cc']."');";
          //echo " el sql    ".$sql;
          $result=mysqli_query($conexion,$sql);
        }
    ?>
<body class="hold-transition sidebar-mini">
  <!-- ENCABEZADO -->
  <div class="content-wrapper">
    <!-- DONDE ME ENCUENTRO -->
      <form name='formulario' id='formulario' class="principal" action="user_mp.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
             <input type="hidden" name="buscar" id="buscar" value="<?php echo $buscar; ?>">
             <input type="hidden" name="cc" id="cc" value="<?php echo $cc; ?>">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>USUARIOS EN EXISTENCIA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios Existentes</li>
            </ol>
          </div>
        </div>
      </div><!-- FINAL DEL ENCABEZADO  -->
    </section>

    <!-- Main content -->
    <section class="content">
          
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de usuarios</h3>
           <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 300px;">
                  </div>
            </div>
        </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Habilitado</th>
                    <th></th>
                  </tr>
                  </thead>
                 
                    <tbody>
                    <?php 
                    $sql="SELECT u.id,concat(f_name,' ',l_name) as nombre,email,e.em_estado as estado 
                    FROM bd_local.tbl_user  as u inner join bd_local.tbl_detalle_emple as e where u.id=e.id;";
                    $result=mysqli_query($conexion,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "
                      <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nombre']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['estado']."</td>
                        <td class='project-actions text-right'>
                        <a class='btn btn-danger btn-sm' onclick='return cargar1(\"".$row["id"]."\")' >
                           DESABILITAR
                        </a>
                        <a class='btn btn-primary btn-sm' onclick='return cargar2(\"".$row["id"]."\")' >
                          HABILITAR
                        </a>
                  

                    </td>
                      </tr>
                      ";
                   }?>
                  </tbody>
                
                </table>
              </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
