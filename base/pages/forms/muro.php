<?php
session_start();
include('menu.php');
$codigo=isset($_POST["codigo"])?$_POST["codigo"]:""; 
$_SESSION["ticketid"]=$codigo;
$cc=isset($_POST["cc"])?$_POST["cc"]:"";
$ca=isset($_POST["ca"])?$_POST["ca"]:"";
$user="";
$ruta="";
$estado="";
 // echo "<script>alert('".$_SESSION['ticketid']."');</script>";
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
       //  echo "<script>alert('".$estado."');</script>"; 
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
  <link rel="stylesheet" href="../../dist/css/estilo.css">
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
</head>
<script type="text/javascript">
    function cargar1(logitud,latitud)
      {
    // 
   // document.getElementById("accion").value="lleno";
   //alert( 'llega');
   document.getElementById("rep").value=1;
   document.getElementById("cc").value=latitud;
     document.getElementById("ca").value=logitud;
    
    document.getElementById("chat").submit();
      }   
</script>

<body class="hold-transition sidebar-mini">
<?php 
   $rep=isset($_POST["rep"])?$_POST["rep"]:"";
   if($rep=="1")
   {
   // $_SESSION
   //echo "<script>alert('".$_POST['ca']."');</script>";
    $v1=base64_encode($_POST["ca"]);
    $v2=base64_encode($_POST['cc']);
 //   ;
// 
    echo "<script>window.open('map.php?var1=$v1&var2=$v2','_blank');</script>";

   }
  ?>
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

  
    <section class="content">
        <!-- Inicio de contenedor -->
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
             <?php 
             $origen="";
             $titulo="";
             $inicial="";
             $categoria="";
             $fechain="";
             $latitud="";
             $longitud="";
             $sql="select
             ti.tickes_id as ids,
             concat(u.f_name,' ',u.l_name) nombre,
             fnc_fecha(t_fechaini) as fecha,
             ti.titulo as titulo,ti.tk_descripcion as inicial,ct.t_categoria as cate, ti.latitud as latitud,ti.longitud as longitud
             from
             bd_local.tbl_ticketsc ti
             inner join bd_local.tbl_user u on u.id=ti.o_us
             inner join bd_local.tbl_categoria ct on ct.cate_id=ti.cate_id
             inner join bd_local.tbl_user usat on usat.id=ti.us_id  and ti.tickes_id='".$_SESSION["ticketid"]."' and ti.tic_estado='ACTIVO'
             ";
             $result=mysqli_query($conexion,$sql);
             while($row=mysqli_fetch_assoc($result))
             {
              $origen=$row["nombre"];
              $fechain=$row["fecha"];
              $titulo=$row["titulo"];
              $categoria=$row["cate"];
              $inicial=$row["inicial"];
              $latitud=$row["latitud"];
              $longitud=$row["longitud"];
             }
             ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <?php if($origen!=$user)
              {?>
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>   <?php echo $titulo; ?>
                    <small class="float-right">Fecha: <?php echo $fechain; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De:
                  <address>
                    <strong><?php echo $origen; ?>.</strong><br>
                    <?php echo $inicial; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para:
                  <address>
                    <strong><?php echo $user; ?></strong><br>
                    <?php echo $categoria; ?>
                  </address>
                </div>
                <!-- /.col -->
                <?php 
              }else
              {
                $destino="";
                $sql="select
                concat(u.f_name,' ',u.l_name) nombre
               from
                bd_local.tbl_ticketsc ti
                inner join bd_local.tbl_user u on u.id=ti.us_id
                inner join bd_local.tbl_categoria ct on ct.cate_id=ti.cate_id
                inner join bd_local.tbl_user usat on usat.id=ti.us_id  and ti.tickes_id='".$_SESSION["ticketid"]."' and ti.tic_estado='ACTIVO'
                ";                       
                $result=mysqli_query($conexion,$sql);
                    while($row=mysqli_fetch_assoc($result)){ $destino=$row['nombre'];}
                ?>
                 <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>   <?php echo $titulo; ?>
                    <small class="float-right">Fecha: <?php echo $fechain; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De:
                  <address>
                    <strong><?php echo $origen; ?>.</strong><br>
                    <?php echo $inicial; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para:
                  <address>
                    <strong><?php echo $destino; ?></strong><br>
                    <?php echo $categoria; ?>
                  </address>
                </div>
                <?php
              }
                if($longitud=="")
                {

                }
                else{
                ?>
                <div class="col-sm-4 invoice-col">
                  Creado desde aplicacion movil:
                  <address>
                    <strong>  <a  class="d-block" onClick ="return cargar1('<?php echo $longitud;?>','<?php echo $latitud;?>'); ">Ubicacion</a></strong><br>
                  </address>
                </div>
                <!-- /.col -->
                <?php } ?>
              </div>
             
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>
        <div id="box">
        <div class="contenedor">   
        <h2>Click button to load new content inside DIV box</h2>
</div>
        </div>
      <!-- /.final del contenedor -->
                  <!-- /.card -->
                  <div class="card-footer">
                   <form name='chat' id='chat' enctype="multipart/form-data" method="POST">
                    <?php 
                    if($accion=="enviar")
                    {
                      //echo "<script>alert('.$codigo.');</script>"
                      $sql2="SELECT count(de.tickes_id) as c FROM bd_local.tbl_detalle as de 
                      inner join bd_local.tbl_ticketsc as ti where ti.tickes_id=de.tickes_id"; 
                      // echo "SQL ".$sql2;
                      $contador=0;
                      $cod=0;
                        $result=mysqli_query($conexion,$sql2);
                              while($row=mysqli_fetch_assoc($result))
                              {
    
                                $contador=$row['c'];
                              } 
                              $cod=$contador+1; 
                             $fechanew="121022";
                              if($_FILES["archivo"]["error"]>0){

                                //   echo "no hay archivo";
                               }else 
                               {
                                   $permitidos= array("image/jpng","image/png","application/pdf");
                                   $limite_kb = 10000;
                                   if(in_array($_FILES["archivo"]["type"],$permitidos) && $_FILES["archivo"]["size"]<= $limite_kb * 124){
                                      $ruta = 'files/'.$fechanew."-".$cod."_".$_COOKIE["id"].'/';
                                      $archivo =$ruta.$_FILES["archivo"]["name"];
                                      if(!file_exists($ruta))
                                      {
                                       mkdir($ruta);
                                      }
                                      if(!file_exists($archivo))
                                      {
                                       $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo);
                                       if($resultado)
                                       {
                                          // echo "Archivo guardado";
                                       }else{
                                           echo "error al guardar archivo";
                                       }
                                      }
                                   }
                                   else
                                   {
                                   echo "Archivo no permitido p excede el size";
                                   }
                     
                      
                                  }

                                  $sql="INSERT INTO `bd_local`.`tbl_detalle` (`deta_id`, `tickes_id`, `o_user`, `d_user`, 
                                  `d_descrip`, `fecha`, `estado`, `respuesta`, `archivo`) VALUES ('DLL-".$cod."', '".$codigo."', 
                                  '', '".$_COOKIE["id"]."', '".$_POST['message']."', concat(now()),
                                   'ACTIVO', '".$_COOKIE['id']."', '".$ruta."');";
                                  $result=mysqli_query($conexion,$sql);
                                 // echo "<script>alert('ver');</script>";
                             // echo $sql;
                                }
                    ?>
                     <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                     <?php 
                     if($estado=="FINALIZADO")
                     {

                     }else{
                     ?>
                      <div class="input-group">
                      <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
                      <input type="hidden" name="cc" id="cc" value="<?php echo $cc; ?>">
                      <input type="hidden" name="ca" id="ca" value="<?php echo $ca; ?>">
                      <input type="hidden" name="rep" id="rep" value="">
                        <input type="text" name="message" id="message" placeholder="hola gracias ...." class="form-control">
                        <span class="input-group-append">
                           <button type="button" class="btn btn-warning" id="btnguardar" onClick='return cargar();'>Enviar</button>
                            <input multiple type="file" class="form-control" id="archivo" name="archivo" >   
                        </span>
                      </div>
                      <?php }?>
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
<script type="text/javascript">

 function cargar()
      {
        if(document.getElementById("message").value=="")
        {
         // alert("vacio");
          document.getElementById("message").focus();
        }
        else
        {
         document.getElementById("accion").value="enviar";
       
            document.getElementById("chat").submit();
        }
    
      } 
  $(document).ready(function(){
    document.getElementById("boton").click();
    $("button").click(function(){
        $("#box").load("control_muro.php");
    });
});
$(document).ready(function(){
        $("#box").load("control_muro.php");
});
</script>
</body>
</html>
