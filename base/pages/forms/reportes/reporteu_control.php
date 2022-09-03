<?php
session_start();
require('fpdf184/fpdf.php');
include("../Conexion.php");
//$cc=isset($_POST["cc"])?$_POST["cc"]:""; 
//echo "<script>alert('".$cc."');</script>";
$v1=base64_decode($_GET["var1"]);
$v2=base64_decode($_GET["var2"]);
//echo "<script>alert('".$v1."');</script>";
//echo "<script>alert('".$v2."');</script>";
$mes="";
$cantidad="";
$finalizados="";
$activos="";
$sql="no modifica ";
if($v1=="AC-5")
     {
    //   echo "<script>alert('ACTIVIDAD GENERAL DE USUARIO".$v1."');</script>";
       $sql=" SELECT (  select   count(tickes_id) as cant_creados  from bd_local.tbl_ticketsc where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
       and o_us='".$v2."' ) as cant_creados,(select count(tickes_id) from bd_local.tbl_ticketsc where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
     and   tic_estado='FINALIZADO'  and o_us='".$v2."'    ) as finalizados,  
     (select count(tickes_id) from bd_local.tbl_ticketsc where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
     and   tic_estado='ACTIVO'  and o_us='".$v2."') as activo, MONTHNAME(t_fechaini) as namemes
     FROM bd_local.tbl_ticketsc inner join bd_local.tbl_user as u where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate()) 
      and o_us='".$v2."' and o_us=id limit 1";
     }
 else if($V1=="AC-6")
       {
    //   echo "<script>alert('REPORTE DE FRECUENCIA DE CREACION DE TICKETS".$v1."');</script>";
       $sql="";
        }
 else if($v1=="AC-2")
  {
   echo "<script>alert('TIEMPO DE ATENCION".$v1."');</script>";
   $sql="";
   }
       //echo $mes;
        
       $result=mysqli_query($conexion,$sql);
      while($row=mysqli_fetch_assoc($result))
          {
            //echo "<script>alert('ACTIVIDAD GENERAL DE USUARIO".$v1."');</script>";
             $mes=$row["namemes"]."";
              $finalizados=$row["finalizados"]."";
              $activos=$row["activo"]."";
             $cantidad=$row["cant_creados"]."";
        }
class PDF extends FPDF
{
    
// Cabecera de página
function Header()
{
        $this->SetFont('Times','',20);
        $this->Image('img/CEIBENA.png',140,10,50);
        $this->setXY(50,25);
        $this->Cell(50,8,"REPORTE DE FUNCION DE USUARIO",0,0,'C',0);//r para derecha, l para izquierda 
        $this->Ln(40);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
  //  // Número de página
  $this->Cell(170,10,'Cooperativa ceibena sistema de control de tickets',0,0,'C',0);//r para derecha, l para izquierda 
   $this->Cell(25,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
}
// --------------------METODO PARA ADAPTAR LAS CELDAS------------------------------
var $widths;
var $aligns;

function SetWidths($w) {
    //Set the array of column widths
    $this->widths = $w;
}

function SetAligns($a) {
    //Set the array of column alignments
    $this->aligns = $a;
}

function Row($data, $setX) //yo modifique el script a  mi conveniencia :D
{
    //Calculate the height of the row
    $nb = 0;
    for ($i = 0; $i < count($data); $i++) {
        $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    }

    $h = 8 * $nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h, $setX);
    //Draw the cells of the row
    for ($i = 0; $i < count($data); $i++) {
        $w = $this->widths[$i];
        $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
        //Save the current position
        $x = $this->GetX();
        $y = $this->GetY();
        //Draw the border
        $this->Rect($x, $y, $w, $h, 'DF');
        //Print the text
        $this->MultiCell($w, 8, $data[$i], 0, $a);
        //Put the position to the right of the cell
        $this->SetXY($x + $w, $y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h, $setX) {
    //If the height h would cause an overflow, add a new page immediately
    if ($this->GetY() + $h > $this->PageBreakTrigger) {
        $this->AddPage($this->CurOrientation);
        $this->SetX($setX);

        //volvemos a definir el  encabezado cuando se crea una nueva pagina
        $this->SetFont('Helvetica', 'B', 15);
        $this->Cell(10,8,'N',1,0,'C',0);
        $this->Cell(40,8,'Numero 1',1,0,'C',0);
        $this->Cell(40,8,'Numero 2',1,0,'C',0);
        $this->Cell(40,8,'Numero 3',1,0,'C',0);
        $this->Cell(40,8,'total',1,1,'C',0);
        $this->SetFont('Arial', '', 12);

    }

    if ($setX == 100) {
        $this->SetX(100);
    } else {
        $this->SetX($setX);
    }

}

function NbLines($w, $txt) {
    //Computes the number of lines a MultiCell of width w will take
    $cw = &$this->CurrentFont['cw'];
    if ($w == 0) {
        $w = $this->w - $this->rMargin - $this->x;
    }

    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
    $s = str_replace("\r", '', $txt);
    $nb = strlen($s);
    if ($nb > 0 and $s[$nb - 1] == "\n") {
        $nb--;
    }

    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $nl = 1;
    while ($i < $nb) {
        $c = $s[$i];
        if ($c == "\n") {
            $i++;
            $sep = -1;
            $j = $i;
            $l = 0;
            $nl++;
            continue;
        }
        if ($c == ' ') {
            $sep = $i;
        }

        $l += $cw[$c];
        if ($l > $wmax) {
            if ($sep == -1) {
                if ($i == $j) {
                    $i++;
                }

            } else {
                $i = $sep + 1;
            }

            $sep = -1;
            $j = $i;
            $l = 0;
            $nl++;
        } else {
            $i++;
        }

    }
    return $nl;
}
// -----------------------------------TERMINA---------------------------------
}
//termina 

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10); //MARGENES
$pdf->SetAutoPageBreak(true, 20);
//$pdf->SetAutoPageBreak(0);
$pdf->SetFont('Times','',20);
$pdf->Image('img/CEIBENA.png',140,10,50);
$pdf->setXY(50,15);
 
$pdf->Ln(40);
$pdf->setXY(130,33);
$pdf->Cell(10,8,$mes,0,0,'R',0);
$pdf->Ln(25);
$pdf->SetX(30);
$pdf->SetFont('Times','',15);
$pdf->Cell(40,8,'Informacion general de creacion',0,1,'C',0);
$pdf->setX(15);
$pdf->SetFont('Helvetica', 'B', 14);
 $pdf->Cell(40,8,'Cantidad ',1,0,'C',0);
 $pdf->Cell(40,8,'N. Casos',1,0,'C',0);
 $pdf->Cell(40,8,'Finalizados',1,1,'C',0);
 $pdf->SetFont('Arial', '', 12);
 $pdf->SetWidths(array(40, 40, 40,40));
 $pdf->setX(15);
$pdf->Cell(40,8, $cantidad,1,0,'C',0);
 $pdf->Cell(40,8,$activos,1,0,'C',0);// el uno hace que rellene el color 
 $pdf->Cell(40,8,$finalizados,1,1,'C',0);
 $pdf->SetX(15);
 $pdf->setXY(50,100);
 $pdf->SetFont('Times','',15);
 $pdf->Cell(40,8,'Desglose de tickets',0,1,'C',0);
 $pdf->setX(15);

//$pdf->Ln(25);
// $pdf->setXY(30,60);
$pdf->setX(15);

 $pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(7,8,'N',1,0,'C',0);
$pdf->Cell(25,8,'Codigo',1,0,'C',0);
$pdf->Cell(30,8,'titulo',1,0,'C',0);
$pdf->Cell(25,8,'Tipo',1,0,'C',0);
$pdf->Cell(30,8,'Filial',1,0,'C',0);
$pdf->Cell(30,8,'Resuelto en',1,0,'C',0);
$pdf->Cell(30,8,'Estado',1,1,'C',0);
$pdf->SetFillColor(255,255,255);//color de fondo
$pdf->SetDrawColor(65,61,61);//color de linea 
$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(7, 25, 30, 25,30,30,30));
$i=1;
if($v1=="AC-5")
     {
       // echo "<script>alert('ACTIVIDAD GENERAL DE USUARIO".$v1."');</script>";
       $sql="
       select  tickes_id as codigo, DATEDIFF(tfechafinal,t_fechaini) as fecha,tic_estado as estado,titulo,nombre as filial,tk_area as area,t_categoria as categoria
       from bd_local.tbl_ticketsc as t inner join bd_local.tbl_user inner join bd_local.tbl_filial inner join 
       bd_local.tbl_categoria as c where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate())
       and o_us='".$v2."' and o_us=id and tk_filial=id_filial and t.cate_id=c.cate_id";
     }
 else if($V1=="AC-6")
       {
       // echo "<script>alert('REPORTE DE FRECUENCIA DE CREACION DE TICKETS".$v1."');</script>";
       $sql="";
        }
 else if($v1=="AC-2")
  {
   // echo "<script>alert('TIEMPO DE ATENCION".$v1."');</script>";
   $sql="";
   }
   $i="";
 $result=mysqli_query($conexion,$sql);
   while($row=mysqli_fetch_assoc($result))
      {
       $i++;
                $pdf->Row(array($i,$row["codigo"],utf8_decode($row["titulo"]),$row["categoria"],$row['filial'],$row["fecha"],$row["estado"]),15);
      }
   
// for($i=1;$i<=50;$i++)
//  {
//     //$pdf->setX(15);
//    // $pdf->Row(array($i,$mes,"h",utf8_decode("un texto super largo que no se sabe que hacer con el "),"177"),15);
//  }
$pdf->Output();
//    $pdf->setX(15);
    //  $pdf->Cell(10,8,$i,1,0,'C',0);
    //  $pdf->Cell(40,8,'Numero 1',1,0,'C',0);
    //  $pdf->Cell(40,8,'Numero 2',1,0,'C',1);// el uno hace que rellene el color 
    //  $pdf->Cell(40,8,'Numero 3',1,0,'C',0);
    //  $pdf->Cell(40,8,'total',1,1,'C',0);
     //celda(ancho,largo,contenido,borde,salto de linea)
?>