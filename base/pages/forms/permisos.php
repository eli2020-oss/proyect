<?php
 include("Conexion.php");
 include('menu.php');
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACCESOS | USUARIO</title>

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
 function cargar()
      {
         if(document.getElementById("accion").value=="")
          {
            document.getElementById("accion").value="agregar";
          }
          else if(document.getElementById("accion").value=="agregar")
          {
            document.getElementById("accion").value="guardar";
          }
          document.getElementById("formulario").submit();
           return false;
      } 
   
  
</script>
<script type="text/javascript">
 function cargar1(codigo,codigoa)
      {
        alert("Entra");
     //  localStorage.clear();
         document.getElementById("accion").value="desabilitar";
         document.getElementById("cc").value=codigo;
         document.getElementById("ca").value=codigoa;
          //var getInput =codigo;
         //localStorage.setItem("ab",getInput);
            document.getElementById("formulario").submit();
      } 
   
  
</script>
<?php
 $contador=0;
 $sql2="SELECT id FROM bd_local.categorias_user;"; 
                  // echo "SQL ".$sql2;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $contador++;
                          } 
                          $contador=$contador+1; 
                        //  echo "<script>alert('".$contador."');</script>";
               if ($accion=="agregar") 
               {
              // Echo "<script>alert('');</script>";
                   
                           

                      $sql="INSERT INTO `bd_local`.`user_acceso` (`us_id`, `acc_id`, `estado`) VALUES ('".$_POST["cmbuser"]."', '".$_POST["cmbaccesos"]."', 'ACTIVO');";
//echo " el sql    ".$sql;
 $result=mysqli_query($conexion,$sql);
}
if($accion=='desabilitar')
{
  //$variablephp="";
 //$variablephp = "<script> document.write(getInput) </script>";
  // echo "<script>alert('".$_POST['cc']."');</script>";
 //  echo "<script>alert('".$_POST['ca']."');</script>";
   // echo "                  ".isset($_POST['cc']);
  $sql="UPDATE `bd_local`.`user_acceso` SET `estado` = 'INACTIVO' WHERE (`us_id` = '".$_POST["cc"]."') and (`acc_id` = '".$_POST['ca']."');";
//echo " el sql    ".$sql;
 $result=mysqli_query($conexion,$sql);
}
  ?>
<body class="hold-transition sidebar-mini">
 <div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">tareas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
        
          <!-- /.card-header -->
           <form name='formulario' id='formulario' class="principal" action="permisos.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
             <input type="hidden" name="cc" id="cc" value="<?php echo $cc; ?>">
             <input type="hidden" name="ca" id="ca" value="<?php echo $ca; ?>">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Permisos</h3>
              </div>
              <!-- /.card-header -->
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
             
                  <tr>
                    <td>Gecko</td>
                    <td>Netscape Browser 8</td>
                    <td>Win 98SE+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Netscape Navigator 9</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.0</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.1</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.1</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.2</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.2</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.3</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.3</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.4</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.4</td>
                    <td>A</td>
                  </tr>
                 
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
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
