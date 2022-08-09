 <?php
session_start();
include('menu.php');
$login= $_SESSION["login"]."";

$codi=isset($_POST["codigo"])?$_POST["codigo"]:"";
$atencion=isset($_POST["codigo_tecni"])?$_POST["codigo_tecni"]:"";
$cor=isset($_POST["cors"])?$_POST["cors"]:""; 
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
$estado="ACTIVO";
//echo "<script>alert('".$codi."');</script>";
if($atencion=="")
{
  $codi="1";
}
 $contador=0;
 $sql2="SELECT de.tickes_id FROM bd_local.tbl_detalle as de 
                  inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                  // echo "SQL ".$sql2;
                $result=mysqli_query($conexion,$sql2);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $contador++;
                          } 
                          $contador=$contador+1; 
                        //  echo "<script>alert('".$contador."');</script>";
                           $nombre_so="";
                           $correo_mante="";
                          $user_origen="";
                           $sql1="";
               
                $sql1="SELECT en.em_nombre as nombre, en.em_correo as correo,ti.o_us as origen, ti.us_id as des FROM bd_local.tbl_user
                  as us inner join bd_local.tbl_emple as en inner join bd_local.tbl_ticketsc as ti 
                  where us.em_id=en.em_id and ti.us_id=us.us_id and ti.tickes_id=".$codi.""; 
                 // echo $sql1;
                   $log=$_SESSION['login']."";
                          $resultado=mysqli_query($conexion,$sql1);
                          while($row=mysqli_fetch_assoc($resultado))
                          {
 
                               $nombre_so=$row['nombre']."";
                               $correo_mante=$row['correo']."";
                               $user_origen=$row['origen']."";
                                
                          }
                           if($correo_mante==$log)
                              {
                                
                                $nombre_so=$cor."";
                              //  
                              } 

                      $sql="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, `d_descrip`, `fecha`, `estado`, `enviado`) VALUES ('DLL-".$contador."', ".$codi.", '".$user_origen."', ".$atencion.", '', now(), 'ACTIVO', '".$_SESSION['login']."');";
//echo " el sql".$sql;
 $result=mysqli_query($conexion,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Responder Solicitud</title>

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
 function cargar()
      {
        //alert('codigo');
        document.getElementById("accion").value="guardar";
       
        document.getElementById("formulario").submit();
        return false;
      } 
   
  
</script>
<script type="text/javascript">
      function cargar1()
      {
       // alert('entro a descartar');
        document.getElementById("accion").value="descartar";
       
        document.getElementById("formulario").submit();
        return false;
      } 
  
</script>
<?php
                
      if($accion=="guardar")
     {
      //echo "<script>alert('entra');</script>";

       $contador=$contador-1;
          $sql="UPDATE `bd_local`.`tbl_detalle` SET `d_descrip` = '".$_POST['compose-textarea']."' WHERE (`deta_id` = 'DLL-".$contador."');
";      
   //echo "<script>alert(' el codigo".$contador."');</script>";
           $result=mysqli_query($conexion,$sql);  
     }else if($accion=="descartar")
     {
      //echo "<script>alert('descartar');</script>";
       $contador=$contador-1;
          $sql="DELETE FROM `bd_local`.`tbl_detalle` WHERE (`deta_id` = 'DLL-".$contador."')";      
   //echo "<script>alert(' el codigo".$contador."');</script>";
           $result=mysqli_query($conexion,$sql);  
     }
     

   ?>
<body class="hold-transition sidebar-mini">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nuevo Mensaje</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="muro.php">Incio</a></li>
              <li class="breadcrumb-item active">Respuesta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <a href="bandeja.php" class="btn btn-primary btn-block mb-3">Regresar a bandeja de entrada</a>

            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           
          </div>
          <!-- /.col -->
          
          <form name='formulario' id='formulario' class="principal" action="contestar.php" method="POST">
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
             <div ng-show="formVisibility" class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Nuevo mensaje</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                <div class="form-group">
                    <textarea id="compose-textarea" name="compose-textarea" class="form-control" style="height: 300px">
                    </textarea>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="submit" class="btn btn-primary" id="btnguardar" onclick="return cargar();"><i class="far fa-envelope"></i> Enviar</button>
                </div>
                <button type="submit"  class="btn btn-default" onclick="return cargar1();"><i class="fas fa-times" ></i>  Descartar</button>
              </div>
              <!-- /.card-footer -->
            </div>
           

          </form>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
</body>
</html>
