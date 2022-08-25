<?php
session_start();
include('menu.php');
//$login= $_SESSION["login"]."";
$estado='ACTIVO';
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
//$direccion=isset($_POST["direccion"])?$_POST["direccion"]:""; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de Entradas | Salidas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<script type="text/javascript">
    function cargar(codigo)
      {
        //alert('codigo'.codigo);
        //document.getElementById("accion").value="llenar";
        document.getElementById("codigo").value=codigo;
        document.getElementById("accion").value="dd";
           document.getElementById("direccion").value="read-inbox.php";
          // alert("".document.getElementById("direccion"));
          <?php
          if($accion=="dd")
          {
          $direccion="read-inbox.php";
           }
          ?>
        document.getElementById("formulario").submit();

      }   
</script>
<script type="text/javascript">
    function cargar1()
      {
      //alert('codigo'.codigo);
 
       document.getElementById("formulario").submit();
         
      }   
</script>
<script type="text/javascript">
      function cambiar(e,id)
		  {
       // alert(id);
        //alert(e);
       $.ajax({
				type: 'POST',
				url: "core/controller_bandeja.php",
				data: {ida:id,estado:e},
				success: function(data)
				{
          if(e=='1')
          {
           // alert(data);
           document.getElementById("codigo").value=id;
           document.getElementById("formulario").submit();
            //location.href ="muro.php";
          }
					//$("#tabla").append(data);
          //alert(data);

				},
				error: function(error)
				{
					alert("Error");
				}
			});
			return false;
		}   
</script>

</head>
<body class="hold-transition sidebar-mini">
<?php
if($accion=='filtro2')
{$estado="FINALIZADO";}
if($accion=='filtro1')
{$estado="ACTIVO";}
?>
<body >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control de Tickets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Control de Tickets</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block mb-3">Tickets</a>
 <div class="card">
  
            <div class="card-header">
              <h3 class="card-title">Filtro</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link" onclick='return cargar3();'>
                    <i class="far fa-circle text-danger"></i>
                  FINALIZADO
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" onclick='return cargar2();'>
                    <i class="far fa-circle text-primary" ></i>
                   ACTIVOS
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lista de Tickes</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                <select  class="form-control select2" id="cmbuser" name="cmbuser" style="width: 100%;" >
                  <option></option>
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
                  <div class="input-group-append">
                  </div>
                </div>
              </div>

              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
         
               
                <div class="float-right">
                  <div class="btn-group">
                   
                  </div>
                   
                  <!-- /.final de controles de inbox -->
                </div>
                <!-- /.float-right -->
              </div> 
            
              <form  name='formulario' id='formulario' method='POST' action='muro.php' >
             <input type="hidden" id="codigo" name="codigo" class="form-control" value='<?php echo $codigo ?> '>
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
          
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <table  class="table table-head-fixed text-nowrap" name="table">
                  <tbody>
                         <?php
                         $permitir="";
                         $id="";
                          $consulta="
                          SELECT us.id as identi,estado FROM bd_local.categorias_user as cu inner join 
                          bd_local.tbl_user as us inner join bd_local.tbl_categoria as ca 
                           where cu.id_user=us.id and cu.id_categoria=ca.cate_id and estado='ACTIVO';";
                         //  echo $consulta;
                             $result=mysqli_query($conexion,$consulta);
                             while($row=mysqli_fetch_assoc($result))
                          {
                                if($row['identi']==$_COOKIE['id'])
                                {
                                  //SE IDENTIFICA QUE TIPO DE USUARIO ES
                                  $id=$row['identi']."";
                                  $permitir="ACTIVO";
                                 // echo $row['identi'];
                                }
                               
                          }
                          if ($permitir=='ACTIVO') 
                          {
                             //Usuario ADMINISTRADOR
                          $sql="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre,ti.titulo as descrip,ti.t_fechaini as fecha,
                          ti.tic_estado as estado FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca inner join 
                           bd_local.categorias_user as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id
                           and ti.cate_id=cu.id_categoria and ti.us_id='".$id."' and ti.tic_estado='".$estado."' ORDER BY ti.t_fechaini desc";
                        // echo $sql;
                         }
                         else 
                         {
                        // USUARIO BASE SIN PERMISOS
                         $sql="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre ,ti.titulo as descrip,ti.t_fechaini as fecha,ti.tic_estado as estado
                         FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca  inner join bd_local.categorias_user
                           as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria 
                           and us.id='".$_COOKIE['id']."' and ti.tic_estado='".$estado."' ORDER BY ti.t_fechaini desc";
                           //echo $sql;
                         }
                          $result=mysqli_query($conexion,$sql);
                          $data="";
                          while($row=mysqli_fetch_assoc($result))
                          {
                           
                          ?>
                            <tr>
                        
                   
                    <?php
                     
                     $es=$row["estado"]."";
                           echo "
                            <td>".$row["nombre"]."</td>
                            <td>".$row["descrip"]."</td>
                             <td>".$row["fecha"]."</td>
                               <td class='project-actions text-right'>
                     
                          <a class='btn btn-danger btn-sm' onclick='return cambiar(\"".'0'."\",\"".$row["ids"]."\")' >
                             FINALIZAR
                          </a>
                         
                          <a class=' btn btn-primary btn-sm'  onclick='return cambiar(\"".'1'."\",\"".$row["ids"]."\")' >
                        VER CHAT
                          </a>

                      </td>

                          ";
                             
                              // echo "<script>alert('".$data."');</script>";
                               ?>
                     
                  </tr>
                          <?php 
                          }
                    
                         ?>
                  </tr>
                 
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>

            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
               
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->

              </div>
            </div>
          </div>
        
              </form>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
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


  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
</script>
</body>
</html>
