<?php
session_start();
include('menu.php');
$login= $_SESSION["login"]."";
$codi=isset($_POST["codigo"])?$_POST["codigo"]:"";
$_SESSION['codigo']=isset($_POST["codigo"])?$_POST["codigo"]:"";
$direccion=isset($_POST["direccion"])?$_POST["direccion"]:"";
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
$accion="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inbox</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>
<script type="text/javascript">
 
  function ENVIAR()
  {
             document.getElementById("direccion").value="contestar.php";
              document.getElementById("accion").value="ss";
alert("llega");
    
      if(document.getElementById("codigo").value=="")
          {
           // 
            document.getElementById("codigo").value="<?php echo $codi;?>";
          }
          if(document.getElementById("codigo_tecni").value=="")
          {
           // alert(soporte);
            document.getElementById("codigo_tecni").value="<?php echo $soporte;?>";
          } 
          if(document.getElementById("cors").value=="")
          {
           
            document.getElementById("cors").value="<?php echo $cor;?>";
          } 
       document.getElementById("formulario").submit();  
       return   
      
  }
      
</script>
 

<body class="hold-transition sidebar-mini">
  <script type="text/javascript">
    function cargar1(ll)
      {
      //alert('funciona');
       document.getElementById("accion").value="ll";
      
        //document.getElementById("accion").value="Final";
        document.getElementById("direccion").value="muro.php";
       //  document.getElementById("codigo").value=codigo;
      // document.getElementById("formulario").submit();

         
      }   
</script>
<?php



 //echo "<script>alert(' accion ".$accion."');</script>";
          
$cor="hola";
$fecha="12/6/10";
$cate="";
$descrip="";
$soporte="";
 $sql="SELECT ti.tickes_id, em.em_nombre as nom,em.em_correo as correo,ti.tk_descripcion as descrip,ti.t_fechaini as fecha,ti.tic_estado,ti.us_id as soporte,ca.t_categoria as catego FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
 inner join bd_local.tbl_emple as em inner join bd_local.tbl_categoria as ca  
 inner join bd_local.categorias_user as cu where ti.o_us=us.us_id and us.em_id=em.em_id 
 and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria and ti.tickes_id='".$codi."'";
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                         // echo "<script>alert('hola');</script>";
                          $nombre_o=$row['nom']."";
                          $cor=$row['correo']."";
                          $fecha=$row['fecha']."";
                          $cate=$row['catego']."";
                          $descrip=$row['descrip']."";
                          $soporte=$row['soporte']."";
                          }
 ?>
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nombre del remitente: <?php echo  $nombre_o; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"> <a href="#">Control de Tickets</a></li>
              <li class="breadcrumb-item active">Mensaje</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="bandeja.php" class="btn btn-primary btn-block mb-3">Regresar a bandeja de entrada</a>

         
          <!-- /.card -->
          
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
             <input type="hidden" id="direccion" name="direccion" class="form-control" value='<?php echo $direccion ?> '>
              <form  name='formulario' id='formulario' method='Post' action='contestar.php' >
           <input type="hidden" id="codigo" name="codigo" class="form-control" value='"<?php echo $codi; ?> "'>
                <input type="hidden" id="codigo_tecni" name="codigo_tecni" class="form-control" value='"<?php echo $soporte; ?> "'>
                  <input type="hidden" id="cors" name="cors" class="form-control" value='"<?php echo $cor; ?> "'>
                    
               <input type="hidden" id="accion" name="accion" class="form-control" value='"<?php echo $accion; ?> "'>
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Detalle del ticket</h3>

              <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Apoyo al colaborador</h5>
                <h6>de: <?php echo  $cor; ?></h6>
                  <span class="mailbox-read-time float-right"><?php echo  $fecha; ?> </span></h6>
                  <br>
              </div>
              <!-- /.mailbox-read-info -->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>Necesito apoyo en: <?php echo  $cate; ?></p>

                <p><?php echo  $descrip; ?></p>
               <?php
               $nombre_so="";
               $correo_mante="";
               $user_destino="";
               $sql1="SELECT us_id,em_nombre, em_correo FROM bd_local.tbl_user as us inner join bd_local.tbl_emple as en where us.em_id=en.em_id and us_id='".$soporte."';"; 
                $result=mysqli_query($conexion,$sql1);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                         // echo "<script>alert('hola');</script>";
                          $nombre_so=$row['em_nombre']."";
                          $correo_mante=$row['em_correo']."";
                          $user_destino=$row['us_id']."";
                          }
               ?>
                <p>GRACIAS, <?php echo  $nombre_so; ?><br></p>
                <p><span class="mailbox-read-time float-right"><?php echo  $correo_mante; ?> </span></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            
         
            <div class="card-footer">
              <div class="float-right">
               
                <button  class="btn btn-default" ><i class="fas fa-reply" onclick="return ENVIAR();"></i> Responder</button>
                <div>
                   <!--      <button  class="btn btn-default" id="btn" onclick='return cargar1("ll");'>Chat</button>/.card-footer --> 
                </div>
              </div>

               
               <a href="reportes/correo.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- nuevo-->
        </div>
        <!-- /.col -->
       </form>
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
 
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
<!-- Summernote agrega la parte de las herramientas al texarea -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
</body>
</html>
