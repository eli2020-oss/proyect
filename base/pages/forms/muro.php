<?php
session_start();
include('menu.php');
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
$user="";
$estado="";
//  echo "<script>alert('".$codigo."');</script>";
      include("Conexion.php"); 
   $accion=isset($_POST["accion"])?$_POST["accion"]:"";
     $contador=0;
     $sql="SELECT concat(f_name,' ',l_name) as nombre FROM bd_local.tbl_user where id='".$_COOKIE["id"]."';";                       
     $result=mysqli_query($conexion,$sql);
         while($row=mysqli_fetch_assoc($result)){ $user=$row['nombre'];}
        // echo "<script>alert('".$user."');</script>"; 
        $sql="SELECT tic_estado FROM bd_local.tbl_ticketsc where tickes_id='".$codigo."';";                       
        $result=mysqli_query($conexion,$sql);
            while($row=mysqli_fetch_assoc($result)){ $estado=$row['tic_estado'];}
         // echo "<script>alert('".$estado."');</script>"; 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHAT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<script type="text/javascript">
      function cambiar()
		  {
       alert('hola');
        //alert(e);
      //  id.value=document.getElementById("codigo");
       $.ajax({
				type: 'POST',
				url: "core/control_muro.php",
				data: {ida:id},
				success: function(data)
				{
         
					//$("#tabla").append(data);
          alert(data);

				},
				error: function(error)
				{
					alert("Error");
				}
			});
			return false;
		}   
</script>

<body class="hold-transition sidebar-mini">
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Chat</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <?php 
         //echo "<script>alert('".$_POST['codigo']."');</script>";
                          $descrip="";
                          $quien_es="";
                          $fecha="";
                          $carpeta="";
                          $sql=" select de.tickes_id, de.d_descrip as descri, de.fecha as fecha , de.respuesta as quien, 
                          de.archivo as arc, concat(u.f_name,' ',u.l_name) as nombre FROM bd_local.tbl_detalle as de inner join bd_local.tbl_user as u
                          inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id and u.id=de.respuesta and de.tickes_id='".$codigo."'";

                        //  echo "SENTENCIA DE SQL ".$sql;
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_assoc($result))
                          {
                            
                         // echo "<script>alert('hola');</script>";
                          $descrip=$row['descri']."";
                          $fecha=$row['fecha']."";
                          $carpeta=$row['arc']."";
                           if($row['quien']==$_COOKIE['id'])
                           {
                            $quien_es= 'YO';
                           }
                           else
                           {
                            $quien_es=$row['nombre'];
                           }
                            
 ?>
        <div class="row">
         <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">  
              <div>
               <i class="fas fa-envelope bg-blue"></i>
               <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i><?php echo $fecha; ?> </span>
                        <h3 class="timeline-header"><?php echo $quien_es; ?></h3>

                        <div class="timeline-body"><?php echo $descrip; ?></div>
                        <div>
                          <?php 
                         
                           $listar=null;
                           $directorio=opendir($carpeta);
                          // echo $directorio."";
                           if($carpeta=='')
                           {}
                           else{
                           while($elemento= readdir($directorio))
                           {
                           // echo "hola 1";
                            if($elemento !='.' && $elemento !='..')
                            {
                              $direc=$carpeta.''.$elemento;
                             // echo is_dir($direc)."";
                             echo "<a class='cal-md-6' href='$direc' target='_blank'> $elemento</a><br>";
                             
                            }
                           }
                           }
                          ?> 
                        </div>
                      </div>
                </div>
                <?php 
                          }
                ?>
                  <div class="timeline-footer">
                  <a class="btn btn-danger btn-sm" >AGREGAR IMG</a>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->
 
      
                 
                  <!-- /.card-body -->
                  <div class="card-footer">
                   <form name='formulario' id='formulario' class="principal" action="muro.php" method="POST">
                     <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                      <div class="input-group">
                        <input type="text" name="message" id="message" placeholder="hola gracias ...." class="form-control">
                        <span class="input-group-append">
                           <button type="button" class="btn btn-warning" id="btnguardar" onclick='return cambiar();'>Enviar</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
  </footer>

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
</body>
</html>
