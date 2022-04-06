<?php
include("../displayerrors.php");
require('./rotate.php');
include("./getreportdata.php");


class PDF extends PDF_Rotate
{
function Header()
{
    $this->SetFont('Arial','B',15);
    $this->SetTextColor(255,192,203);
    $this->RotatedText(8,100,'A M B S   R E P O R T',90);
  
    // Logo
    // $this->Image('./img/logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Move to the right
    $this->SetFillColor(25,135,84);
    $this->SetTextColor(255,255,255);
    // Title
    $this->Cell(280,10,'Over all transction report',0,0,'C',true);
  // Line break
  $this->Ln(10);
   
}

function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(220,220,220);
    $this->SetTextColor(53,29,29);
    $this->SetDrawColor(108,108,108);
    $this->SetLineWidth(.1);
    $this->SetFont('Arial','B',9);
    // Header
    $w = array(40, 40, 40, 40,40,40,40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'L',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data current_acad_year,new_acad_year
    $fill = false;
    $totalcredits=0;
    $totalDebits=0;

    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row['firstname'].' '.$row['lastname'],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row['phonenumber'],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row['accn'],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row['transactiontype'],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row['amount'],'LR',0,'L',$fill);
        $this->Cell($w[5],6,$row['createdon'],'LR',0,'L',$fill);
        $this->Cell($w[6],6,$row['fullname'],'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
        if($row['transactiontype']=='deposit'){
            $totalDebits+=$row['amount'];
        }else {
            $totalcredits+=$row['amount'];
        }
    }
    $this->SetFont('Arial','B',8);
    $this->SetFillColor(220,220,220);
    $this->Cell(93.3,10,'Total credits amount: '.$totalcredits.' RWF','LR',0,'L',true);
    $this->Cell(93.3,10,'Total debits amount: '.$totalDebits.' RWF','LR',0,'L',true);
    $this->Cell(93.3,10,'All transactions amount: '.($totalDebits+$totalcredits).' RWF','LR',0,'L',true);
    // Closing line
    //$this->Cell(array_sum($w),0,'','T');
}


}


 $pdf = new PDF();

$header = array('Full name', 'Phone number', 'Account number','Transaction type','Amount','Done on','Created by');
$data = get_report_data();
$pdf->SetFont('Arial','',14);
$pdf->AddPage('O');
$pdf->Ln(10);
$pdf->FancyTable($header,$data);
$pdf->Output();
 ?>