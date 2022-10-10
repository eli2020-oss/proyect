<?php
session_start();
include('menu.php');
$accion="";
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

<script src="js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">
 function Validar()
      {
       // alert("Entra");
       if(document.getElementById("cmbcategoria").value=="[--SELECCIONE LO QUE SE LE INDICA--]")
        {
          alert("Seleccione el tipo de problema que presenta");
          document.getElementById("cmbcategoria").focus();
        }
        else if(document.getElementById("cmbprioridad").value=="[--SELECCIONE LO QUE SE LE INDICA--]")
        {
          alert("Seleccione el nivel de prioridad de el ticket");
          document.getElementById("cmbprioridad").focus();
        } 
        else if(document.getElementById("cmbfilial").value=="[--SELECCIONE LO QUE SE LE INDICA--]")
        {
          alert("Selecccione la filial a la que pertenece");
          document.getElementById("cmbfilial").focus();
        } 
        else if(document.getElementById("cmbarea").value=="[--SELECCIONE LO QUE SE LE INDICA--]")
        {
          alert("Selecccione la filial a la que pertenece");
          document.getElementById("cmbarea").focus();
        }
        else if(document.getElementById("textarea").value=="[--SELECCIONE LO QUE SE LE INDICA--]")
        {
          alert("Selecccione la filial a la que pertenece");
          document.getElementById("textarea").focus();
        }
        else 
        {
          document.getElementById("formulario").submit();
        }
       return false;
      } 
   
  
</script>
<body class="hold-transition sidebar-mini">
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
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Reasignar Ticket</li>
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
                <form class="form-horizontal" action="files.php" enctype="multipart/form-data" id="formulario" name="formulario" method="POST">
               <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
              <div class="row">
              <label for="inputEmail3" class="col-sm-2 col-form-label" >Nombre: </label>
               <input class="form-control" type="text" name="txtnombre" id="txtnombre" disabled="disabled" value="<?php echo $nombre; ?>">
               <div class="form-group">
                        <label>Descripcion del problema</label>
                        <textarea class="form-control" id="textarea" name="textarea" rows="3" ></textarea>
                      </div>
                      
               <br>
              
                  <label> CC: </label>
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
                
               <label for="inputEmail3" class="col-sm-2 col-form-label" >Titulo:</label>
               <input class="form-control" type="text" name="titulo" id="titulo" value="">
               <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>NIVEL DE PRIORIDAD:</label>
                  <select class="form-control select2" id="cmbprioridad" name="cmbprioridad" style="width: 100%;">
                  <option selected="selected">[--SELECCIONE LO QUE SE LE INDICA--]</option>
                    <option>EMERGENCIA</option>
                    <option>MEDIO</option>
                    <option>NORMAL</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              
                <!-- /.form-group -->
            
                <!-- /.form-group -->
              
              <!-- /.col -->
                 <div class="col-sm-6">
                      <!-- textarea -->
                   
                 </div>
                 <div class="col-md-12">
            <div class="card card-default">
         
              <div class="card-body">
                <div id="actions" class="row">
                  <div class="col-lg-6">
                    <div class="col-md-4 col-md-offset-4">
                    <input multiple type="file" class="form-control" id="archivo" name="archivo" >   
                    <button type="submit" class="btn btn-danger" id="btnEnviar" onclick="return Validar();">Enviar</button>
                 
                  </div>
                </div>
              </div>
             </div>
              <!-- /.card-body -->
            </div>
            <div class="input-group-prepend">
                         </div>
            <!-- /.card -->
          </div>
                         
          </div>
        </div>
        </form>
      </section>

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


  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
</script>
<script type="text/javascript">

    function subir()
    {

        var Form = new FormData($('#filesForm')[0]);
        $.ajax({

            url: "core/files.php",
            type: "post",
            data : Form,
            processData: false,
            contentType: false,
            success: function(data)
            {
                alert(data);
            }
        });
    }

</script>
</body>
</html>
