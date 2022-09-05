<?php
session_start();
include('menu.php');
  //$_SESSION["login"];
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TAREAS | USUARIO</title>

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
        
          document.getElementById("formulario").submit();
           return false;
      } 
   
  
</script>

<?php
 $contador=0;
 $sql2="SELECT count(id) as conta FROM bd_local.categorias_user;"; 
                  // echo "SQL ".$sql2;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $contador=$row['conta'];
                          } 
                          $contador++; 
                        // echo "<script>alert('".$contador."');</script>";
               if ($accion=="agregar") 
               {
                            //Echo "<script>alert('NO deberia entrar');</script>";
                            $temporal=isset($_POST['estado']);
                            $final;
                            if($temporal=='on')
                               $final='ACTIVO';
                            else
                               $final='INACTIVO';
                            //echo "<script>alert('".$final."');</script>";
                                    $cate_id="";
                                    $t_categoria="";
                                    $sql1="";
                        
                            $sql1="SELECT cate_id as cate,t_categoria as des FROM bd_local.tbl_categoria  where cate_id='".$_POST["cmbtareas"]."'"; 
                            //  echo $sql1;
                          //  $log=$_SESSION['login']."";
                          $resultado=mysqli_query($conexion,$sql1);
                          while($row=mysqli_fetch_assoc($resultado))
                          {
 
                               $cate_id=$row['cate']."";
                               $t_categoria=$row['des']."";
                                
                          }
                          $sql="SELECT id_categoria as cate, u.id as id,concat(u.f_name,' ',u.l_name) as nombre
                          FROM bd_local.categorias_user  inner join bd_local.tbl_user as u where u.id=id_user";
                          $existir; 
                          $user='';
                        $resultado=mysqli_query($conexion,$sql);
                        while($row=mysqli_fetch_assoc($resultado))
                        {
                            if($row['cate']==$_POST['cmbtareas'] && $row['id']==$_POST['cmbuser'])
                            {
                                $existir=true;
                                
                                 $user=$row['nombre'];
                            }
                            else if($row['cate']!=$_POST['cmbtareas'] && $row['id']!=$_POST['cmbuser'])
                            {
                                $existir=false;
                               
                            }
                          
                        }
                        if($existir==true)
                        {
                            echo "<script>alert('La tarea ya fue asignada a el usuario ".$user."');</script>";
                        }else if($existir==false)
                        {
                            $sql="INSERT INTO `bd_local`.`categorias_user` (`id`, `id_user`, `id_categoria`, `t_descripcion`, `estado`) VALUES ('CU-".$contador."', '".$_POST['cmbuser']."', '".$_POST['cmbtareas']."', '".$t_categoria."', '".$final."');";
                             //  echo " el sql    ".$sql;
                                 $result=mysqli_query($conexion,$sql);
                                
                        }
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
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="tareas.php">Tareas</a></li>
              <li class="breadcrumb-item active">Asignacion</li>
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
          <div class="card-header">
            <h3 class="card-title">Asignacion de tarea</h3>
          </div>
          <!-- /.card-header -->
           <form name='formulario' id='formulario' class="principal" action="asignar_tarea.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
             <input type="hidden" name="cc" id="cc" value="<?php echo $cc; ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Usuario</label>
                  <select  class="form-control select2" id="cmbuser" name="cmbuser" style="width: 100%;" >
                 <?php 
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
                <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Estado de la asginacion</h3>
              </div>
              <div class="card-body">
                <input type="checkbox"  name="estado" id="estado"  checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
              </div>
            </div>
                <!-- /.form-group -->
              
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tareas</label>
                  <select class="form-control select2" id="cmbtareas" name="cmbtareas"  style="width: 100%;">
                     <?php 
                      $sql="SELECT cate_id as codigo,t_categoria as nombre FROM bd_local.tbl_categoria where cate_estado='ACTIVO';";
                      $result=mysqli_query($conexion,$sql);
                      while($row=mysqli_fetch_assoc($result)) 
                      {
                        $opcion=($row["nombre"]==$cmbtarifas?"selected=selected":"");
                        echo "<option value='".$row['codigo']."' ".$opcion.">".$row['nombre']."</option>";
                      }
                    ?>
                   
                  </select>
                </div>
              </div>
              <!-- /.col -->
              <div class="btn-group w-100">
                      <span class="btn btn-success col fileinput-button" onclick="return cargar();">
                        <i class="fas fa-plus"></i>
                        <span>Agregar tarea</span>
                      </span>
            </div>
            <!-- /.row -->
          </div>
          <br>
        
    
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
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
