<?php
require('fpdf184/fpdf.php');
include('../Conexion.php');
$mes="";
$tiecketstotales="";
$sin_atender="";
$atendidos="";
$total_sin="";
$total_atendido="";
$sql="SELECT MONTHNAME(t.t_fechaini) as namemes,count(t.tic_estado) as delmes,(count(tic_estado) -(SELECT  count(tickes_id) FROM bd_local.tbl_ticketsc where t_fechaini between (NOW() - INTERVAL 2 day) and now()  and tic_estado='ACTIVO')) as fuera
    ,(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where tic_estado='ACTIVO' and MONTH(t_fechaini) =MONTH(curdate()))/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate()))*100 as porcen_sin_mes
    ,(SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where  tic_estado='FINALIZADO' and MONTH(t_fechaini) =MONTH(curdate()))/(SELECT count(tic_estado) FROM bd_local.tbl_ticketsc  where YEAR(t_fechaini) =YEAR(curdate()) and MONTH(t_fechaini) =MONTH(curdate()))*100 as porcen_atendido_mes,
     (SELECT  count(tickes_id)  FROM bd_local.tbl_ticketsc where tic_estado='FINALIZADO' and MONTH(t_fechaini) =MONTH(curdate())) as atendido_mes
     FROM  bd_local.tbl_ticketsc as t inner join bd_local.tbl_user as u where YEAR(t.t_fechaini) =YEAR(curdate()) and MONTH(t.t_fechaini) =MONTH(curdate())
     and t.us_id=u.id;";
      $result=mysqli_query($conexion,$sql);
      while($row=mysqli_fetch_assoc($result))
         {
            $mes=$row["namemes"]."";
            $tiecketstotales=$row["delmes"]."";
            $total_atendido=$row["atendido_mes"]."";
            $sin_atender=$row["porcen_sin_mes"]."";
            $atendidos=$row["porcen_atendido_mes"]."";
         }
class PDF extends FPDF
{
    
// Cabecera de página
function Header()
{
        $this->SetFont('Times','',20);
        $this->Image('img/CEIBENA.png',140,10,50);
        $this->setXY(50,25);
        $this->Cell(50,8,"REPORTE DE DATOS GENERALES MES",0,0,'C',0);//r para derecha, l para izquierda 
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
        $this->Cell(40,8,'Codigo',1,0,'C',0);
         $this->Cell(40,8,'Creado',1,0,'C',0);
        $this->Cell(40,8,'Fecha',1,0,'C',0);
        $this->Cell(40,8,'Estado',1,1,'C',0);
        $this->SetFillColor(255,255,255);//color de fondo
        $this->SetDrawColor(65,61,61);//color de linea 
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
$pdf->SetX(15);
$pdf->SetFont('Helvetica', 'B', 15);
$pdf->Cell(10,8,'N',1,0,'C',0);
$pdf->Cell(40,8,'Codigo',1,0,'C',0);
 $pdf->Cell(40,8,'Creado',1,0,'C',0);
$pdf->Cell(40,8,'Fecha',1,0,'C',0);
$pdf->Cell(40,8,'Estado',1,1,'C',0);
$pdf->SetFillColor(255,255,255);//color de fondo
$pdf->SetDrawColor(65,61,61);//color de linea 
$pdf->SetFont('Arial', '', 12);
$pdf->SetWidths(array(10, 40, 40, 40,40));
//$pdf->Ln(25);
// $pdf->setXY(30,60);
$i=1;
$sql="SELECT  ti.tickes_id as ids,concat(f_name,' ',l_name ) as nombre,ti.titulo as titulo,ti.t_fechaini as fecha,
ti.tic_estado as estado, us_id
 FROM bd_local.tbl_ticketsc as ti inner join bd_local.tbl_user as us 
inner join bd_local.tbl_categoria as ca inner join 
 bd_local.categorias_user as cu where  ti.o_us=us.id  and ca.cate_id= ti.cate_id
 and ti.cate_id=cu.id_categoria and YEAR(ti.t_fechaini) =YEAR(curdate()) and MONTH(ti.t_fechaini) =MONTH(curdate())";
  $result=mysqli_query($conexion,$sql);
  while($row=mysqli_fetch_assoc($result))
     {
        $i++;
        $pdf->Row(array($i,$row["ids"],$row['nombre'],utf8_decode($row["fecha"]),$row["estado"]),15);
     }
     $pdf->setX(15);
     $pdf->SetFont('Times','',15);
     $pdf->Cell(40,8,'Datos Generales',0,1,'C',0);
     $pdf->setX(15);
     $pdf->SetFont('Helvetica', 'B', 14);
      $pdf->Cell(40,8,'Tickets creados',1,0,'C',0);
      $pdf->Cell(40,8,'Resueltos %',1,0,'C',1);// el uno hace que rellene el color 
       $pdf->Cell(40,8,'Sin Resolver %',1,0,'C',0);
      $pdf->Cell(40,8,'Finalizados',1,1,'C',0);
      $pdf->SetFont('Arial', '', 12);
      $pdf->SetWidths(array(40, 40, 40,40));
      $pdf->setX(15);
      $pdf->Cell(40,8, $tiecketstotales,1,0,'C',0);
      $pdf->Cell(40,8,$atendidos,1,0,'C',1);// el uno hace que rellene el color 
       $pdf->Cell(40,8,$sin_atender,1,0,'C',0);
      $pdf->Cell(40,8,$total_atendido,1,1,'C',0);
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