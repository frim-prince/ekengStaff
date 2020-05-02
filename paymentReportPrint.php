<?php
include_once("config.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();

  
}


   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
 
    
}else{
    include_once("login.php");
}

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
  $this->Cell(200,5,'CUSTOMERS ORDER DETAILS',0,0,'C');
  $this->Ln();
  $this->SetFont('Arial','',12);
  $this->Cell(200,5,'Ekeng Electronics P.O.BOX,111',0,0,'C');
}


function footer(){
	$this->SetY(-15);
	$this->SetFont('Arial','',8);
	$this->Cell(0,10,'Page'.$this->PageNo(). '/{nb}',0,0,'C');

}



function payments(){
	global $conn;
if(isset($_GET["id"])){
  $id=$_GET["id"];
  $payments="SELECT * FROM userpayments WHERE customerId ='$id'";
  $run_payments=mysqli_query($conn,$payments);
  while ($row=mysqli_fetch_array($run_payments)) {
    # code...
    $id=$row["id"];
        $paymentAmount=$row["paymentAmount"];
        $customerId =$row["customerId"];
        $statusid=$row["statusid"];
        $paymentDate=$row["paymentDate"];
        $statusid =$row["statusid"];


           $getCustomers="SELECT * FROM customer WHERE id='$customerId'";
     $run_getCustomers=mysqli_query($conn,$getCustomers);
  
    while ($row=mysqli_fetch_array($run_getCustomers)) {
        $fname=$row["fname"];
        $uid=$row["id"];
        $customerId=$row["customerId"];
        $sname=$row["sname"];
        $ezwich_num=$row["ezwich_num"];
        $contact=$row["contact"];
        $email=$row["email"];
        $cardTypeId=$row["cardTypeId"];
        $id_number=$row["id_number"];
        $institutionId=$row["institutionId"];
        $institutionName=$row["institutionName"];
        $yearId=$row["yearId"];
        $startDate=$row["startDate"];
        $lastUpdated=$row["lastUpdated"];
        $fullName=$row["fullName"];
        }
      

       $getInstitution="SELECT * FROM institution WHERE id='$institutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


       $getCustomer_Order="SELECT * FROM checkout WHERE customerId='$uid'";
       $run_customerorder=mysqli_query($conn,$getCustomer_Order);
       while ($row=mysqli_fetch_array($run_customerorder)) {
         $paymentOptionId=$row['paymentOptionId'];
          $paymentPlanid=$row['paymentPlan'];
           $paymentTypeId=$row['paymentTypeId'];
             $orderdate=$row['orderdate'];
             $totalPrice=$row['totalPrice'];

       }
        

           $paymentoption="SELECT * FROM paymentoption WHERE id='$paymentOptionId'";
            $run_paymentoption=mysqli_query($conn,$paymentoption);
            while ($row=mysqli_fetch_array($run_paymentoption)) {
              $paymentoption=$row['optionName'];
            }


           


            $paymenttype="SELECT * FROM paymenttype WHERE id='$paymentTypeId'";
            $run_paymenttype=mysqli_query($conn,$paymenttype);
            while ($row=mysqli_fetch_array($run_paymenttype)) {
              $paymenttype=$row['name'];
            }

              $getuserpayment="SELECT sum(paymentAmount) AS sum_payment FROM userpayments WHERE customerId='$uid'";
         $run_getuserpayment=mysqli_query($conn,$getuserpayment);
          while($row=mysqli_fetch_array($run_getuserpayment)) {
           $SumpaymentAmount=$row["sum_payment"];
           
         } 

          $paymentStatus="SELECT * FROM user_payments_status WHERE id='$statusid'";
            $run_paymentStatus=mysqli_query($conn,$paymentStatus);
            while ($row=mysqli_fetch_array($run_paymentStatus)) {
              $paymentStatus=$row['name'];
            }


            
                 
         $this->Cell(30,5,'Payment :' ,0,0,'C');
        $this->Cell(30,5,$paymentAmount ,0,0,'C');
        $this->Cell(35,5,'Payment Status :' ,0,0,'C');
        $this->Cell(35,5,$paymentStatus,0,0,'C'); 
        $this->Cell(30,5,'Payment Date :' ,0,0,'C');
        $this->Cell(30,5,$paymentDate,0,0,'C'); 
        $this->Ln();      
           

  }
}

}
	




}

global $conn;

if(isset($_GET["id"])){
	$id=$_GET["id"];
	$payments="SELECT * FROM userpayments WHERE customerId ='$id'";
	$run_payments=mysqli_query($conn,$payments);
	while ($row=mysqli_fetch_array($run_payments)) {
		# code...
		$id=$row["id"];
        $paymentAmount=$row["paymentAmount"];
        $customerId =$row["customerId"];
        $statusid=$row["statusid"];
        $paymentDate=$row["paymentDate"];


           $getCustomers="SELECT * FROM customer WHERE id='$customerId'";
     $run_getCustomers=mysqli_query($conn,$getCustomers);
  
    while ($row=mysqli_fetch_array($run_getCustomers)) {
        $fname=$row["fname"];
        $uid=$row["id"];
        $customerId=$row["customerId"];
        $sname=$row["sname"];
        $ezwich_num=$row["ezwich_num"];
        $contact=$row["contact"];
        $email=$row["email"];
        $cardTypeId=$row["cardTypeId"];
        $id_number=$row["id_number"];
        $institutionId=$row["institutionId"];
        $institutionName=$row["institutionName"];
        $yearId=$row["yearId"];
        $startDate=$row["startDate"];
        $lastUpdated=$row["lastUpdated"];
        $fullName=$row["fullName"];
        }
      

       $getInstitution="SELECT * FROM institution WHERE id='$institutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


       $getCustomer_Order="SELECT * FROM checkout WHERE customerId='$uid'";
       $run_customerorder=mysqli_query($conn,$getCustomer_Order);
       while ($row=mysqli_fetch_array($run_customerorder)) {
         $paymentOptionId=$row['paymentOptionId'];
          $paymentPlanid=$row['paymentPlan'];
           $paymentTypeId=$row['paymentTypeId'];
             $orderdate=$row['orderdate'];
             $totalPrice=$row['totalPrice'];

       }
        

           $paymentoption="SELECT * FROM paymentoption WHERE id='$paymentOptionId'";
            $run_paymentoption=mysqli_query($conn,$paymentoption);
            while ($row=mysqli_fetch_array($run_paymentoption)) {
              $paymentoption=$row['optionName'];
            }


           


            $paymenttype="SELECT * FROM paymenttype WHERE id='$paymentTypeId'";
            $run_paymenttype=mysqli_query($conn,$paymenttype);
            while ($row=mysqli_fetch_array($run_paymenttype)) {
              $paymenttype=$row['name'];
            }

              $getuserpayment="SELECT sum(paymentAmount) AS sum_payment FROM userpayments WHERE customerId='$uid'";
         $run_getuserpayment=mysqli_query($conn,$getuserpayment);
          while($row=mysqli_fetch_array($run_getuserpayment)) {
           $SumpaymentAmount=$row["sum_payment"];
           
         } 


 
           

	}
}

$pdf = new myPDF();

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetY(45);
$pdf->SetFont('Times','',12);
$pdf->Cell(55,5,'Customer ID :' ,0,0,'C');
$pdf->Cell(58,5,$customerId ,0,0,'C');
$pdf->Cell(25,5,'Order Date :' ,0,0,'C');
$pdf->Cell(52,5,$orderdate ,0,1,'C');
$pdf->Ln();

$pdf->Cell(55,5,'Item Amount :' ,0,0,'C');
$pdf->Cell(58,5,$totalPrice ,0,0,'C');
$pdf->Cell(25,5,'Amount Paid :' ,0,0,'C');
$pdf->Cell(52,5,$SumpaymentAmount ,0,1,'C');
$pdf->Ln();



$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();




	$pdf->Line(10, 80, 200, 80);
	$pdf->payments();

   
    $pdf->Ln();

   $pdf->Line(10, 120, 200, 120);
   
   
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
     $pdf->Ln();

    $pdf->Cell(50,10,'Paid By :' ,0,0,'C');
    $pdf->Cell(58,10,$fullName ,0,0,'C');

    $pdf->Line(155, 155, 195, 155);
    $pdf->Ln();
     $pdf->Ln();
      $pdf->Ln();
       $pdf->Ln();
    $pdf->Cell(140,5,'' ,0,0,'C');
    $pdf->Cell(50,5,' Signature' ,0,1,'C');


$pdf->Output();



?>