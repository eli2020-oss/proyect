<?php
session_start();
include('menu.php');
//$login= $_SESSION["login"]."";
$estado='ACTIVO';
$accion=isset($_POST["accion"])?$_POST["accion"]:"";
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
$direccion=isset($_POST["direccion"])?$_POST["direccion"]:""; 
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
    function cargar1(codigo)
      {
      //alert('codigo'.codigo);
        document.getElementById("accion").value="Final";
         document.getElementById("direccion").value="bandeja.php";
         document.getElementById("codigo").value=codigo;
       document.getElementById("formulario").submit();
         
      }   
</script>
<script type="text/javascript">
    function cargar2()
      {
     // alert("ACTIVO");
        document.getElementById("accion").value="filtro1";
      document.getElementById("direccion").value="bandeja.php";
         //document.getElementById("codigo").value=codigo;
     document.getElementById("formulario").submit();
         
      } 
        function cargar3()
      {
     // alert("FINALIZADO");
        document.getElementById("accion").value="filtro2";
       document.getElementById("direccion").value="bandeja.php";
         //document.getElementById("codigo").value=codigo;
      document.getElementById("formulario").submit();
         
      }     
</script>
</head>
<?php
if($accion=='Final')
{
  
// echo "<script>alert('LLEGA');</script>";
 $direccion="";
 //  echo "<script>alert('".$_POST['ca']."');</script>";
  $sql="UPDATE `bd_local`.`tbl_ticketsc` SET `tfechafinal` = now(), `tic_estado` = 'FINALIZADO' WHERE (`tickes_id` = '".$_POST['codigo']."');";
//echo " el sql    ".$sql;
 $result=mysqli_query($conexion,$sql);
}
if($accion=='filtro2')
{$estado="FINALIZADO";}
if($accion=='filtro1')
{$estado="ACTIVO";}

  ?>
<body class="hold-transition sidebar-mini">
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
              <li class="breadcrumb-item"><a href="muro.php">Inicio</a></li>
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
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
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
                <input type="hidden" id="direccion" name="direccion" class="form-control" value='<?php echo $direccion ?> '>
              <form  name='formulario' id='formulario' method='Post' action='<?php echo $direccion ?> ' >
             <input type="hidden" id="codigo" name="codigo" class="form-control" value='<?php echo $codigo ?> '>
            <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
          
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table  class="table table-bordered table-striped" name="table">
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
                          $sql="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre,ti.tk_descripcion as descrip,ti.t_fechaini as fecha,
                          ti.tic_estado as estado FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca inner join 
                           bd_local.categorias_user as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id
                           and ti.cate_id=cu.id_categoria and ti.us_id='".$id."' and ti.tic_estado='".$estado."' ";
                        // echo $sql;
                         }
                         else 
                         {
                        // USUARIO BASE SIN PERMISOS
                         $sql="SELECT ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre ,ti.tk_descripcion as descrip,ti.t_fechaini as fecha,ti.tic_estado as estado
                         FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
                          inner join bd_local.tbl_categoria as ca  inner join bd_local.categorias_user
                           as cu where ti.o_us=us.id  and ca.cate_id= ti.cate_id and ti.cate_id=cu.id_categoria 
                           and us.id='".$_COOKIE['id']."' and ti.tic_estado='".$estado."' ";
                         //   echo $sql;
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
                     
                          <a class='btn btn-danger btn-sm' onclick='return cargar1(\"".$row["ids"]."\")' >
                             FINALIZAR
                          </a>
                  
                          <a class='btn btn-primary btn-sm' onclick='return cargar(\"".$row["ids"]."\")' >
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
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-right"></i>
                    </button>
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
</body>
</html>
