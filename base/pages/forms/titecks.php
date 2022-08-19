<?php
session_start();
include('menu.php');
//$login= $_SESSION["login"]."";
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NUEVO TICKES</title>

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
  function Validar()
      {
        if(document.getElementById("txtnombre").value=="")
        {
          alert("No se reconoce el usuario");
          document.getElementById("txtnombre").focus();
        }
        else
        {
          if(document.getElementById("accion").value=="")
          {
            document.getElementById("accion").value="guardar";
          }
          document.getElementById("formulario").submit();
        }
        return false;
      }
         <?php
      include("Conexion.php"); 
    $accion=isset($_POST["accion"])?$_POST["accion"]:"";
    $estado="ACTIVO";
     //echo "<script>alert('Informacion Modificada Satisfactoriamente');</script>";
    ?>
  
</script>
<body class="hold-transition sidebar-mini">
<?php 
$fechaan="";
$fechanew="";
$contadord;
$orig="";
$consulta="SELECT fecha,concat(CURDATE()) as compa,id,concat(f_name,' ',l_name) 
as nombre,contador_transacciones FROM   bd_local.transacciones inner join bd_local.tbl_user";
 $resultado=mysqli_query($conexion,$consulta);
  while($row=mysqli_fetch_assoc($resultado))
      {
        $fechaan=$row["fecha"]."";
         $fechanew=$row["compa"]."";
         $contadord=$row["contador_transacciones"]."";

         
      }
if ($fechaan!=$fechanew) {
  //echo "<script>alert('Nuevo dia');</script>";


  $sql=" UPDATE `bd_local`.`transacciones` SET `fecha` = CURDATE(), `contador_transacciones` = '0' WHERE (`codigo` = '0');";
    //echo "<script>alert('Distintos');</script>";
        $resultado=mysqli_query($conexion,$sql);

}
else
{
  $cambio;
    for ($i = 0; $i <= $contadord; $i++) {
    $cambio=$i+1;
    }

    $fechande='0-0-0 0:0:0';
    if($accion=="guardar")
     {

              $sqlc="SELECT id_user as mante FROM bd_local.categorias_user as cu inner join bd_local.tbl_user as u 
          inner join bd_local.tbl_categoria as c where cu.id_user=u.us_id 
          and cu.id_categoria=c.cate_id and cu.id_categoria='".$_POST['cmbcategoria']."'"; 
          echo "SQL ".$sqlc;
          $resultado=mysqli_query($conexion,$sqlc);
          while($row=mysqli_fetch_assoc($resultado))
                {
                  $man=$row['mante']."";
                }
                echo "man  ".$man;
                
              $sql="INSERT INTO `bd_local`.`tbl_ticketsc` (`tickes_id`, `o_us`, `us_id`, `cate_id`, `tk_nivel`, `tk_descripcion`, `t_fechaini`, `tfechafinal`, `tic_estado`) VALUES ( concat(CURDATE()+0,'-".$cambio."'), '".$_COOKIE['id']."', '".$man."', '".$_POST['cmbcategoria']."', '".$_POST['cmbnivel']."', '".$_POST['textarea']."', now(), '".$fechande."', 'ACTIVO');";
                echo "SQL ".$sql;
                
                $sql1=" UPDATE `bd_local`.`transacciones` SET `contador_transacciones` = '".$cambio."' WHERE (`codigo` = '0');";
                  $resultado=mysqli_query($conexion,$sql);
                  $resultado=mysqli_query($conexion,$sql1);
                  $accion="";
                  echo "<script>alert('Informacion Guardada Satisfactoriamente');</script>";
              }
}
 
 ?>
  <!-- ENCABEZADO -->
  <div class="content-wrapper">
    <!-- DONDE ME ENCUENTRO -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CREAR TICKES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Crear Tickes</li>
            </ol>
          </div>
        </div>
      </div><!-- FINAL DEL ENCABEZADO  -->
    </section>

    <!-- ENABEZADO DE FORMULARIO -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Informacion</h3>
            <div class="card-tools">
            </div>
          </div>
          <!-- /FINAL-->
          <div class="card-body">
            <!-- Inicio de formulario-->
            <form name='formulario' id='formulario' class="principal" action="titecks.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
              <h5>Recoleccion de informacion</h5>
              <div class="row">
              <label for="inputEmail3" class="col-sm-2 col-form-label" >Nombre</label>
               <input class="form-control" type="text" name="txtnombre" id="txtnombre" value="<?php echo $nombre; ?>">
               <br>
             <div class="form-group">
                
                  <label>Ayuda con:</label>
                  <select class="form-control select2" id="cmbcategoria" name="cmbcategoria" style="width: 100%;">
                    <?php 
                      $sql="SELECT cate_id as codigo ,t_categoria as nombre  FROM 
                      tbl_categoria where cate_estado='ACTIVO'";
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
              <div class="form-group">
                   <label>NIVEL DE PRIORIDAD:</label>
                   <select class="form-control select2" id="cmbnivel" name="cmbnivel" style="width: 100%;">
                    <option selected="selected">[--SELECCIONE LO QUE SE LE INDICA--]</option>
                    <option>EMERGENCIA</option>
                    <option>ALTO</option>
                    <option>MEDIO</option>
                    <option>NORMAL</option>
                  </select>
                </div>
             <br>
                 <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" id="textarea" name="textarea" rows="3" ></textarea>
                      </div>
                    </div>
                           <div class="input-group-prepend">
                    <button type="button" class="btn btn-danger" id="btnguardar" onclick="return Validar();">Enviar</button>
                  </div>
          </div>
          <div class="card-footer">
          </div>
        </div>
            </section>
      </div>
    </form>
  <!-- FINAL DEL FORMULARIO-->
    <!-- INFERIOR DE PIE DE FORMULARIO-->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b> 
    </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>



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
