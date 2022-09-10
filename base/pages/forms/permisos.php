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
  <title>ACCESOS | PERMISOS</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
=
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
 function cargar1(codigo)
      {
        // alert("Entra");
     //  localStorage.clear();
     document.getElementById("accion").value="desabilitar";
         document.getElementById("cc").value=codigo;
          //var getInput =codigo;
         alert(codigo);
         //localStorage.setItem("ab",getInput);
            document.getElementById("formulario").submit();
      } 
   
  
function cambiar(e,id,user)
		{
      //alert(id);
      $.ajax({
				type: 'POST',
				url: "cambio_estado.php",
				data: {ida:id,us:user,estado:e},
				success: function(data)
				{
				//	$("#example1").append(data);
          //alert(data);
         // document.getElementById("formulario").submit();

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
 <div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
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
              <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
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
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $vacio=(isset($_POST["cmbuser"])?$_POST["cmbuser"]:"");
                 //echo $_POST['cmbuser'];
                   if($vacio!="")
                   { $sql="SELECT 
                    a.acc_id as accesso_id,
                    a.acc_nombre as nacceso,
                    ifnull(u.estado,'INACTIVO')as access
                    FROM bd_local.tbl_acceso a
                    left outer join bd_local.user_acceso u on u.us_id='".$_POST["cmbuser"]."' and u.acc_id=a.acc_id
                    where a.acc_estado='ACTIVO'";
                    //echo $sql;
                    $result=mysqli_query($conexion,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "
                      <tr>
                        <td>".$row['accesso_id']."</td>
                        <td>".$row['nacceso']."</td>
                        <td>".$row['access']."</td>
                        <td class='project-actions text-right'>
                        <a class='btn btn-danger btn-sm' onclick='return cambiar(0,\"".$row["accesso_id"]."\",\"".$_POST["cmbuser"]."\")' >
                           DESABILITAR
                        </a>
                        <a class='btn btn-primary btn-sm'onclick='return cambiar(1,\"".$row["accesso_id"]."\",\"".$_POST["cmbuser"]."\")' >
                          HABILITAR
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
<!-- jQuery -->


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

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false;

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
  // DropzoneJS Demo Code End
</script>
</body>
</html>
