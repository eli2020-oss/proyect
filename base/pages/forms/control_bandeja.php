<?php 
session_start();
include("Conexion.php");

$estado='ACTIVO';
?> 
<!DOCTYPE html>
<html>
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
          else
          {
            $("#box").load("control_bandeja.php");
          }
				
				},
				error: function(error)
				{
					alert("Error");
				}
			});
			return false;
		}   
   
</script>
<div class="container-fluid">
<table  class="table table-head-fixed text-nowrap" name="table">
                  <tbody>
                         <?php
                         $verboton=True;
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
                          $sql="select
                          ti.tickes_id as ids,
                          concat(u.f_name,' ',u.l_name) nombre,
                          fnc_fecha(t_fechaini) as fecha,
                          ti.titulo as titulo,ti.tic_estado as estado
                          from
                          bd_local.tbl_ticketsc ti
                          inner join bd_local.tbl_user u on u.id=ti.o_us
                          inner join bd_local.tbl_categoria ct on ct.cate_id=ti.cate_id
                          inner join bd_local.tbl_user usat on usat.id=ti.us_id 
                          inner join bd_local.categorias_user catu on catu.id_categoria=ti.cate_id 
                          and catu.id_user='".$id."' and catu.estado='ACTIVO' and ti.tic_estado='ACTIVO'";
                        // echo "administrador". $_SESSION["mis"];
                         }
                         else 
                         {
                          $verboton=false;
                        // USUARIO BASE SIN PERMISOS
                         $sql="select
                         ti.tickes_id as ids,
                         concat(u.f_name,' ',u.l_name) nombre,
                         fnc_fecha(t_fechaini) as fecha,
                         ti.titulo as titulo,ti.tic_estado as estado
                         from
                         bd_local.tbl_ticketsc ti
                         inner join bd_local.tbl_user u on u.id=ti.o_us
                         inner join bd_local.tbl_categoria ct on ct.cate_id=ti.cate_id
                         inner join bd_local.tbl_user usat on usat.id=ti.us_id 
                         inner join bd_local.categorias_user catu on catu.id_categoria=ti.cate_id  and ti.o_us='".$_COOKIE["id"]."' 
                         and catu.estado='ACTIVO' and ti.tic_estado='ACTIVO' ";
                           //echo $sql;
                           //echo "sin permisos".$sql;
                         }
                          $result=mysqli_query($conexion,$sql);
                          $data="";
                          while($row=mysqli_fetch_assoc($result))
                          {
                           
                          ?>
                            <tr>
                        
                   
                    <?php
                     
                     $es=$row["estado"]."";
                     if($verboton==true)
                     {
                        //VISTA DE USUARIO ADMINISTRADOR 
                           echo "
                            <td>".$row["nombre"]."</td>
                            <td>".$row["titulo"]."</td>
                             <td>".$row["fecha"]."</td>
                               <td class='project-actions text-right'>
                         
                          <a id='boton' name='boton' class='btn btn-danger btn-sm' onclick='return cambiar(\"".'0'."\",\"".$row["ids"]."\")' >
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
                          else{
                            //VISTA DE USUARIO BASE 
                           // echo "viendo";
                           ?>
                           <?php
                           echo "
                           <td>".$row["nombre"]."</td>
                           <td>".$row["titulo"]."</td>
                            <td>".$row["fecha"]."</td>
                              <td class='project-actions text-right'>
                        
                     
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
                        } 
                
                         ?>
                  </tr>
                 
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
</div>
</html>