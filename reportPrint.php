<?php

include_once("database.php");

require 'fpdf.php';

/**
 * 
 */
class myPDF extends FPDF
{
  
  


function header(){
  // $this->Image('images/img.jpg',10,6);
  $this->SetFont('Arial','B',14);
  $this->Cell(276,5,'CUSTOMERS ORDER DETAILS',0,0,'C');
  $this->Ln();
  $this->SetFont('Arial','',12);
  $this->Cell(276,5,'Ekeng Electronics P.O.BOX,111',0,0,'C');
}


function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',8);
	$this->Cell(0,10,'Page'.$this->PageNo(). '/{nb}',0,0,'C');

}


function headerTable(){
	$this->SetY(40);
	$this->SetFont('Times','B',12);
	$this->Cell(20,10,'ID',1,0,'C');
	$this->Cell(50,10,'Full Name',1,0,'C');
	$this->Cell(30,10,'Index No.',1,0,'C');
	$this->Cell(40,10,'Institution Type',1,0,'C');
	$this->Cell(40,10,'Institution Name',1,0,'C');
	$this->Cell(30,10,'Amount Paid',1,0,'C');
	$this->Cell(30,10,'E-zwich',1,0,'C');
	$this->Cell(40,10,'Order Date',1,0,'C');

	$this->Ln();
}


function viewTable(){
  global $conn;

  $getReport="SELECT * FROM orderreport WHERE user_payments_statusid='2'";
  $run_getReport=mysqli_query($conn,$getReport);
  while($row=mysqli_fetch_array($run_getReport)){
  	$fname=$row["fname"];
  	$sname=$row["sname"];
  	$id=$row["id"];
  	$institutionType=$row["institutionType"];
  	$institutionName=$row["institutionName"];
  	$AmountPaid=$row["AmountPaid"];
  	$ezwich=$row["ezwich"];
  	$orderDate=$row["orderDate"];
    $customerId=$row["customerId"];
    $fullName=$fname.  "  " .$sname;

    $getPaymentDetails="SELECT SUM(paymentAmount) AS sumPaymentAmount FROM userpayments WHERE customerId ='$customerId' AND statusid='2'";
    $run_getPaymentDetails=mysqli_query($conn,$getPaymentDetails);
    $row=mysqli_fetch_array($run_getPaymentDetails);
    $sumpayment=$row['sumPaymentAmount']; 


    $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
    $run_getCustomer=mysqli_query($conn,$getCustomer);
    while ($row=mysqli_fetch_array($run_getCustomer)) {
    	# code...
    	$studentId=$row['studentId'];
    }
  
	$this->SetFont('Times','',12);
	$this->Cell(20,10,$id,1,0,'C');
	$this->Cell(50,10,$fullName,1,0,'C');
	$this->Cell(30,10,$studentId,1,0,'C');
	$this->Cell(40,10,$institutionType,1,0,'C');
	$this->Cell(40,10,$institutionName,1,0,'C');
	$this->Cell(30,10,$sumpayment,1,0,'C');
	$this->Cell(30,10,$ezwich,1,0,'C');
	$this->Cell(40,10,$orderDate,1,0,'C');
	$this->Ln();
}
}

}
$pdf = new myPDF();

$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();



?>