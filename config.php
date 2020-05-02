<?php
include_once('database.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();

  
}
function login(){

    global $conn;
	if(isset($_POST['login'])){
		 $username = trim($_POST["username"]);
         $password = trim($_POST["password"]);
   
   
        // Prepare a select statement
        $sql = "SELECT * FROM staff WHERE username='$username' and password='$password'";
       if ($stmt=mysqli_query($conn, $sql)){
            $rowCount=mysqli_num_rows($stmt);
            
            while ($row=mysqli_fetch_array($stmt)) {
            	$id=$row["id"];
            	$name=$row['name'];
            	$groupId=$row['groupId'];
            	
            }

        if ($rowCount==1) {
        	
        	 
            // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION['id']=$id;
              $_SESSION["name"]=$name;
              $_SESSION["username"] = $username; 
              $_SESSION["groupId"] = $groupId;


           

           echo "<script>
                 const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})


               </script>";

      
    echo "<script>window.open('index.php','_self')</script>";



        }else{
        	echo "<div class='alert alert-danger' role='alert'>
                        Username or password does not exist 
                   </div>";
        }

    }else{
    	echo "<div class='alert alert-danger' role='alert'>
                        Oops! Something went wrong. Please try again later. 
                   </div>";
    }
          
          
  }
	}








function getnewOrder(){
	global $conn;

  if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $neworder="SELECT * FROM `checkout` WHERE orderStatus ='1' AND orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $neworder="SELECT * FROM `checkout` WHERE orderStatus ='1' AND (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}
  

	

	$run_neworder=mysqli_query($conn,$neworder);

    $count=mysqli_num_rows($run_neworder);
    
    if($count>0){
           while ($row=mysqli_fetch_array($run_neworder)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];


            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>

                       <a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px;'>process</button></a>
                      
                      
                  
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
    	echo "<div class='alert alert-danger' role='alert'>
                        No New order! 
                   </div>";
    }
}


function getOrders($startDate,$endDate){
  global $conn;

if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $order="SELECT * FROM `checkout` WHERE orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $order="SELECT * FROM `checkout` WHERE (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}
  
  
 

  $run_order=mysqli_query($conn,$order);

    $count=mysqli_num_rows($run_order);
    
    if($count>0){
           while ($row=mysqli_fetch_array($run_order)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];
            

            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>";

                      if($orderStatus1==1 || $orderStatus1==4){
                          echo "<a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px; margin-left:4px;'>Process</button></a>";
                      }elseif($orderStatus1==2){
                        echo "<a href='?deliver=$id'><button class='btn btn-info' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Deliver</button></a>";
                      }

                      echo "
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
                        No  order! 
                   </div>";
    }
}


function countnewoder(){
  global $conn;
   
   $neworder="SELECT * FROM `checkout` WHERE orderStatus ='1'";
   $run_neworder=mysqli_query($conn,$neworder);
   $count=mysqli_num_rows($run_neworder);

   echo "$count";

}







// view customer details

function viewcustomerdetails(){
  global  $conn;

 if (isset($_GET['view'])) {
    $id=$_GET['view'];

     $neworder="SELECT * FROM `checkout` WHERE id='$id'";
     $run_oder=mysqli_query($conn,$neworder);
     
     if($run_oder){
      while ($row=mysqli_fetch_array($run_oder)) {
          
            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $modelId=$row['modelId'];
            $id=$row['id'];
            $paymentOptionId=$row['paymentOptionId'];
            $paymentPlanId=$row['paymentPlan'];
            $paymentTypeId =$row['paymentTypeId'];
            $totalPrice=$row['totalPrice'];
            $AmountLeft=$row['AmountLeft'];
            $orderdate=$row['orderdate'];
            $initialAmount=$row['initialAmount'];



             $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fname=$row['fname'];
              $sname=$row['sname'];
              $DOB=$row['DOB'];
              $contact=$row['contact'];
              $email=$row['email'];
              $cardTypeId=$row['cardTypeId'];
              $id_number=$row['id_number'];
              $studentId=$row['studentId'];
              $yearId =$row['yearId'];
              $ezwich_num=$row['ezwich_num'];
             


            }

           
            $getModel="SELECT * FROM models WHERE id='$modelId'";
            $run_getModel=mysqli_query($conn,$getModel);
            while($row=mysqli_fetch_array($run_getModel)) {
              $product_name=$row['product_name'];

            }
            
            $getIdType="SELECT * FROM id_type WHERE id='$cardTypeId'";
            $run_getIdType=mysqli_query($conn,$getIdType);
            while($row=mysqli_fetch_array($run_getIdType)) {
              $cardname=$row['name'];

            }

            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
            }


           $paymentoption="SELECT * FROM paymentoption WHERE id='$paymentOptionId'";
            $run_paymentoption=mysqli_query($conn,$paymentoption);
            while ($row=mysqli_fetch_array($run_paymentoption)) {
              $paymentoption=$row['optionName'];
            }


            $paymentplan="SELECT * FROM paymentplan WHERE id='$paymentPlanId'";
            $run_paymentplan=mysqli_query($conn,$paymentplan);
            while ($row=mysqli_fetch_array($run_paymentplan)) {
              $paymentplan=$row['paymentYear'];
            }


            $paymenttype="SELECT * FROM paymenttype WHERE id='$paymentTypeId'";
            $run_paymenttype=mysqli_query($conn,$paymenttype);
            while ($row=mysqli_fetch_array($run_paymenttype)) {
              $paymenttype=$row['name'];
            }




            echo "
                <form method='post'>
                   <div class=' row-fluid'>
                       <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>First Name:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$fname' placeholder='First Name' class='span8'>
                        
                      </div>
                   </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Surname:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$sname' placeholder='Surname' class='span8'>
                        
                      </div>
                </div>

                
                       </div>

                        <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Date of Birth:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$DOB' placeholder='Date of Birth' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>


                      <div class=' row-fluid'>
                       <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Tel No:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$contact' placeholder='phone number' class='span8'>
                        
                      </div>
                </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Email:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$email' placeholder='Email Address' class='span8'>
                        
                      </div>
                </div>

                
                       </div>

                        <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>ID type:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$cardname' placeholder='ID type' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>



                      <div class=' row-fluid'>
                       <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>ID NO:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$id_number' placeholder='ID NO:' class='span8'>
                        
                      </div>
                </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Institution Type:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$institutionType' placeholder='Institution Type' class='span8'>
                        
                      </div>
                </div>

                
                       </div>

                        <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Institution Name:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$institutionName' placeholder='Institution Name' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>



                      


                      <div class=' row-fluid'>
                       <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Student ID:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput value='$studentId' placeholder='Student ID' class='span8'>
                        
                      </div>
                </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Academic Year:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$yearId' placeholder='Academic Year' class='span8'>
                        
                      </div>
                </div>
 vbc
                 vbc
                       </div> vbc
 vbc
                        <div class='span4'> vbc
                         vbc
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Ezwich:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$ezwich_num' placeholder='Ezwich' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>

                   <div class=' row-fluid'>
                       <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Model:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$product_name' placeholder='Model' class='span8'>
                        
                      </div>
                </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Payment Option:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$paymentoption' placeholder='Payment Option' class='span8'>
                        
                      </div>
                </div>

                
                       </div>

                        <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Payment Type:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$paymenttype' placeholder='Payment Type' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>



                   <div class=' row-fluid'>
                       <div class='span4'>
                        
                      <div class='control-group'>
                             <label class='control-label' for='basicinput'>Payment Plan(year):</label>
                          <div class='controls'>
                             <input type='text' id='basicinput' value='$paymentplan' placeholder='Payment Plan' class='span8'>
                        
                          </div>
                       </div>

                
                       </div>
                         <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Total Amount:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$totalPrice' placeholder='Total Amount' class='span8'>
                        
                      </div>
                </div>

                
                       </div>

                        <div class='span4'>
                        
                              <div class='control-group'>
                      <label class='control-label' for='basicinput'>Initial Amount Paid:</label>
                      <div class='controls'>
                        <input type='text' id='basicinput' value='$initialAmount' placeholder='Amount paid' class='span8'>
                        
                      </div>
                </div>

                
                       </div>



                   </div>

                   <div class=' row-fluid'>
                       <div class='span4'>
                        
                            <div class='control-group'>
                              <label class='control-label' for='basicinput'>Amount Left:</label>
                              <div class='controls'>
                                <input type='text' id='basicinput'  value='$AmountLeft' placeholder='Amount Left ' class='span8'>
                        
                              </div>
                            </div>
                    
                
                       </div>
                     
                    
                     <div class='span4'>
                        
                            <div class='control-group'>
                              <label class='control-label' for='basicinput'>Order Date:</label>
                              <div class='controls'>
                                <input type='text' id='basicinput' value='$paymentdate' placeholder='Order Date ' class='span8'>
                        
                              </div>
                            </div>
                    
                
                       </div>
                        



                   </div>

                      <br>
                      <br>
                       
           
                     <div class=' row-fluid'>";

                     if($orderStatus1==1 || $orderStatus1==4){
                      echo "<div class='span2'>
                        
                           <button type='submit' name='process' class='btn btn-primary' style='padding: 7px 20px 7px 23px; '>Process</button>

                
                       </div>";
                     }elseif($orderStatus1==2){
                      echo "<div class='span2'>
                        
                           <button type='submit' name='deliver' class='btn btn-primary' style='padding: 7px 20px 7px 23px; '>Deliver</button>

                
                       </div>";
                     }
                       
                        echo " <div class='span2'>
                        
                            <button class='btn btn-warning' type='submit' name='cancel' style='padding: 7px 20px 7px 23px; '>Cancel</button>

                
                       </div>
                         <div class='span2'>
                           <button class='btn btn-info' style='padding: 7px 20px 7px 23px; '>Update</button>

                
                       </div>
                        <div class='span2'>
                           <button class='btn btn-success' style='padding: 7px 20px 7px 23px; '>back</button>

                
                       </div>




                   </div>
              </form>
                   ";
      }
     }
  }

}


// process order
function processOrder(){
  global $conn;
   
   if (isset($_GET['process'])) {
    $id=$_GET['process'];
    
    $processOrder="UPDATE checkout  SET orderStatus='2'  WHERE id='$id'";
    $run_processOrder=mysqli_query($conn,$processOrder);

    if($run_processOrder){
      echo " <script>swal.fire({
          title: ' Process Succes!',
         text: 'customer Order Processed successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Process Failled!',
         text: 'customer Order Processed Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}


// process viewed orders

function processOrder1(){
  global $conn;
   
   if (isset($_POST['process'])) {
    $id=$_GET['view'];
    
    $processOrder="UPDATE checkout  SET orderStatus='2'  WHERE id='$id'";
    $run_processOrder=mysqli_query($conn,$processOrder);

    if($run_processOrder){
      echo " <script>swal.fire({
          title: ' Process Succes!',
         text: 'customer Order Processed successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Process Failled!',
         text: 'customer Order Processed Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}


function cancelOrder(){
   
     global $conn;
   
   if (isset($_GET['cancel'])) {
    $id=$_GET['cancel'];
    
    $cancelOrder="UPDATE checkout  SET orderStatus='4'  WHERE id='$id'";
    $run_cancelOrder=mysqli_query($conn,$cancelOrder);

    if($run_cancelOrder){
      echo " <script>swal.fire({
          title: ' Cancel Success!',
         text: 'customer Order Cancelled successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Process Failled!',
         text: 'customer Order Cancelled Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}



function cancelOrder1(){
   
     global $conn;
   
   if (isset($_POST['cancel'])) {
    $id=$_GET['view'];
    
    $cancelOrder="UPDATE checkout  SET orderStatus='4'  WHERE id='$id'";
    $run_cancelOrder=mysqli_query($conn,$cancelOrder);

    if($run_cancelOrder){
      echo " <script>swal.fire({
          title: ' Cancel Success!',
         text: 'customer Order Cancelled successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Process Failled!',
         text: 'customer Order Cancelled Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}

function deliverOrder(){
   
     global $conn;
   
   if (isset($_GET['deliver'])) {
    $id=$_GET['deliver'];
    
    $deliverOrder="UPDATE checkout  SET orderStatus='3'  WHERE id='$id'";
    $run_deliverOrder=mysqli_query($conn,$deliverOrder);

    if($run_deliverOrder){
      echo " <script>swal.fire({
          title: ' deliver Success!',
         text: 'customer Order Delivered successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Process Failled!',
         text: 'customer Order Cancelled Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}



function deliverOrder1(){
   
     global $conn;
   
   if (isset($_POST['deliver'])) {
    $id=$_GET['view'];
    
    $deliverOrder="UPDATE checkout  SET orderStatus='3'  WHERE id='$id'";
    $run_deliverOrder=mysqli_query($conn,$deliverOrder);

    if($run_deliverOrder){
      echo " <script>swal.fire({
          title: ' deliver Success!',
         text: 'customer Order Delivered successfully!. ',
         icon: 'success',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";


    }else{
      
      echo " <script>swal.fire({
          title: ' Deliver Failled!',
         text: 'customer Order Delivered Failled!. ',
         icon: 'error',
        imageUrl: 'thumbs-up.jpg'
      });
      </script>";
    
  }

}
}

// get pending orders

function pendingorders(){
  global $conn;


   if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $pendingorders="SELECT * FROM `checkout` WHERE orderStatus ='1' AND orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $pendingorders="SELECT * FROM `checkout` WHERE orderStatus ='1' AND (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}
  


  $run_pendingorders=mysqli_query($conn,$pendingorders);
  $count=mysqli_num_rows($run_pendingorders);
   if($count>0){
           while ($row=mysqli_fetch_array($run_pendingorders)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];
            

            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>";

                      if($orderStatus1==1 || $orderStatus1==4){
                          echo "<a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Process</button></a>";
                      }elseif($orderStatus1==2){
                        echo "<a href='?deliver=$id'><button class='btn btn-info' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Deliver</button></a>";
                      }

                      echo "
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
                        No pending Order! 
                   </div>";
    }
}

// count pending orders
function pendingordersCount(){
  global $conn;

  $pendingorders="SELECT * FROM checkout WHERE orderStatus='1'";
  $run_pendingorders=mysqli_query($conn,$pendingorders);
  $count=mysqli_num_rows($run_pendingorders);

  echo "$count";

}



// get processing orders

function processingorders(){
  global $conn;

   if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $processingorders="SELECT * FROM `checkout` WHERE orderStatus ='2' AND orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $processingorders="SELECT * FROM `checkout` WHERE orderStatus ='2' AND (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}


  $run_processingorders=mysqli_query($conn,$processingorders);
  $count=mysqli_num_rows($run_processingorders);
   if($count>0){
           while ($row=mysqli_fetch_array($run_processingorders)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];
            

            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>";

                      if($orderStatus1==1 || $orderStatus1==4){
                          echo "<a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Process</button></a>";
                      }elseif($orderStatus1==2){
                        echo "<a href='?deliver=$id'><button class='btn btn-info' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Deliver</button></a>";
                      }

                      echo "
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
                        No  Proccessed Order! 
                   </div>";
    }
}

// count processing orders
function run_processingordersCount(){
  global $conn;

  $processingorders="SELECT * FROM checkout WHERE orderStatus='2'";
  $run_processingorders=mysqli_query($conn,$processingorders);
  $count=mysqli_num_rows($run_processingorders);

  echo "$count";

}





// get cancelled orders

function cancelledorders(){
  global $conn;

   if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $cancelledorders="SELECT * FROM `checkout` WHERE orderStatus ='4' AND orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $cancelledorders="SELECT * FROM `checkout` WHERE orderStatus ='4' AND (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}

  $run_cancelledorders=mysqli_query($conn,$cancelledorders);
  $count=mysqli_num_rows($run_cancelledorders);
   if($count>0){
           while ($row=mysqli_fetch_array($run_cancelledorders)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];
            

            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>";

                      if($orderStatus1==1 || $orderStatus1==4){
                          echo "<a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Process</button></a>";
                      }elseif($orderStatus1==2){
                        echo "<a href='?deliver=$id'><button class='btn btn-info' style='padding: 7px 13px 7px 13px;margin-left:4px;'>Deliver</button></a>";
                      }

                      echo "
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
                        No  cancelled Order! 
                   </div>";
    }
}

// count cancelled orders
function cancelledordersCount(){
  global $conn;

  $cancelledorders="SELECT * FROM checkout WHERE orderStatus='4'";
  $run_cancelledorders=mysqli_query($conn,$cancelledorders);
  $count=mysqli_num_rows($run_cancelledorders);

  echo "$count";

}




// get delivered orders

function deliveredorders(){
  global $conn;
   if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $deliveredorders="SELECT * FROM `checkout` WHERE orderStatus ='3' AND orderdate>= '$date1' AND orderdate <= '$date2'";
}else{
   $deliveredorders="SELECT * FROM `checkout` WHERE orderStatus ='3' AND (orderdate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}
 
  $run_deliveredorders=mysqli_query($conn,$deliveredorders);
  $count=mysqli_num_rows($run_deliveredorders);
   if($count>0){
           while ($row=mysqli_fetch_array($run_deliveredorders)) {

            $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $id=$row['id'];
            

            $getCustomer="SELECT * FROM customer WHERE id='$customerId'";
            $run_customer=mysqli_query($conn,$getCustomer);
            while($row=mysqli_fetch_array($run_customer)) {
              $fullName=$row['fullName'];
            }


            $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }


            $orderStatus="SELECT * FROM status WHERE id='$orderStatus1'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $status=$row['name'];
              $color=$row['color'];
            }

          
            
          echo "  <tr class='odd gradeX'>
                      <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentdate</td>
                      <td class='center' style='color:$color' >$status </td>
                      <td class='center'><a href='vieworder.php?view=$id''><button class='btn btn-success' style='padding: 7px 20px 7px 20px; '>view</button></a>";

                      if($orderStatus1==1 || $orderStatus1==4){
                          echo "<a href='?process=$id'><button class='btn btn-primary' style='padding: 7px 13px 7px 13px;'>Process</button></a>";
                      }elseif($orderStatus1==2){
                        echo "<a href='?deliver=$id'><button class='btn btn-info' style='padding: 7px 13px 7px 13px;'>Deliver</button></a>";
                      }

                      echo "
                      <a href='?cancel=$id'><button class='btn btn-warning' style='padding: 7px 13px 7px 13px;'>Cancel</button></a>

                        </td>
                    </tr>";
           }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
                        No  cancelled Order! 
                   </div>";
    }
}

// count delivered orders
function deliveredordersCount(){
  global $conn;

  $deliveredordersCount="SELECT * FROM checkout WHERE orderStatus='3'";
  $run_deliveredordersCount=mysqli_query($conn,$deliveredordersCount);
  $count=mysqli_num_rows($run_deliveredordersCount);

  echo "$count";

}

// customers list

function getCustomers(){
  global $conn;

  $getCustomers="SELECT * FROM customer";
  $run_getCustomers=mysqli_query($conn,$getCustomers);

  if($run_getCustomers){
    while ($row=mysqli_fetch_array($run_getCustomers)) {
        $fname=$row["fname"];
        $customerId=$row["customerId"];
        $id=$row["id"];
        $sname=$row["sname"];
        $contact=$row["contact"];
        $email=$row["email"];
        $cardTypeId=$row["cardTypeId"];
        $id_number=$row["id_number"];
        $institutionId=$row["institutionId"];
        $institutionName=$row["institutionName"];
        $yearId=$row["yearId"];
        $startDate=$row["startDate"];
        $lastUpdated=$row["lastUpdated"];
        
    



    echo "<tr class='odd gradeX'>
                      <td>$customerId</td>
                      <td>$sname</td>
                      <td>$fname</td>
                      <td>$contact</td>
                      <td>$email</td>
                      <td>$institutionName</td>
                      <td>$startDate</td>
                      <td><a href='#'><button class='btn btn-primary'>View</button></a>
                        
                      </td>
          </tr>";

  }
}
}



// count customers 

function countcustomers(){
  global $conn;

  $getCustomers="SELECT * FROM customer";
  $run_getCustomers=mysqli_query($conn,$getCustomers);
  $count=mysqli_num_rows($run_getCustomers);

  echo "$count";
}


function getIstitutontypes(){
  global $conn;

  $getTypes="SELECT * FROM institution";
  $run_getTypes=mysqli_query($conn,$getTypes);

  while ($row=mysqli_fetch_array($run_getTypes)) {
        $name=$row['name'];

        echo "<option >$name</option>";
  }
}


function getStatus(){
  global $conn;

  $getStatus="SELECT * FROM status ORDER BY id DESC";
  $run_getStatus=mysqli_query($conn,$getStatus);

  while ($row=mysqli_fetch_array($run_getStatus)) {
        $name=$row['name'];

        echo "<option >$name</option>";
  }
}


// preview report
function preview(){
  
 
  
  
  global $conn;
   $deleteOrderReport="DELETE  FROM orderreport";
  $run_deleteOrderReport=mysqli_query($conn,$deleteOrderReport);
  if(isset($_POST["reportSubmit"])){
    $institutionType=mysqli_escape_string($conn,$_POST["instType"]);
    $institutionName=mysqli_escape_string($conn,$_POST["instName"]);
    $status=mysqli_escape_string($conn,$_POST["status"]);
    $date1=mysqli_escape_string($conn,$_POST["date1"]);
    $date2=mysqli_escape_string($conn,$_POST["date2"]);


if($institutionType=="All Institution Types"){


  $institutionName="All Universities";



            $orderStatus="SELECT * FROM status WHERE name='$status'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $statusid=$row['id'];
              
            }

    if($status=="All Status"){

    $getOrders="SELECT * FROM checkout WHERE  orderdate>= '$date1' AND orderdate <='$date2'  ";
   }else{
      $getOrders="SELECT * FROM checkout WHERE orderStatus='$statusid' AND  orderdate>= '$date1' AND orderdate <='$date2'  ";
   }

  $run_getOrders=mysqli_query($conn,$getOrders);
  $countallorders=mysqli_num_rows($run_getOrders);

  if($countallorders>0){

        while ($row=mysqli_fetch_array($run_getOrders)) {
          # code...

           $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $initialAmount=$row['initialAmount'];
            $id=$row['id'];

           

  $getCustomers="SELECT * FROM customer WHERE id='$customerId'";
  $run_getCustomers=mysqli_query($conn,$getCustomers);
  
    while ($row=mysqli_fetch_array($run_getCustomers)) {
        $fname=$row["fname"];
       
        $id=$row["id"];
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
        }
           
       $getuserpayment="SELECT sum(paymentAmount) AS sum_payment FROM userpayments WHERE customerId='$customerId' 
       AND statusid ='2'";
       $run_getuserpayment=mysqli_query($conn,$getuserpayment);
       $row=mysqli_fetch_array($run_getuserpayment); 
       $paymentAmount=$row["sum_payment"];

         $paymentStatus="SELECT * FROM userpayments WHERE customerId='$id'";
         $run_paymentStatus=mysqli_query($conn,$paymentStatus);
          while($row=mysqli_fetch_array($run_paymentStatus)){
            $statusid1 =$row["statusid"];

        } 
       

       $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }
           
           
           

     $UpdateOrderReports="INSERT INTO 
     orderreport(fname,sname,institutionType,institutionName,AmountPaid,ezwich,orderDate,customerId,user_payments_statusid) VALUES('$fname','$sname','$institutionType','$institutionName','$paymentAmount','$ezwich_num','$paymentdate','$id','$statusid1')";

     $run_UpdateOrderReports=mysqli_query($conn,$UpdateOrderReports);

     if($run_UpdateOrderReports){
       echo "<script>window.open('reportPrint.php','_new')</script>";
     }else{
          echo " <script>swal.fire({
          title: ' Report Unavailable!',
         text: 'No Report for this data!. ',
         icon: 'info'
       
      });
      </script>";
     }
   

}
}else{
   echo " <script>swal.fire({
          title: ' Report Unavailable!',
         text: 'No Report for this data!. ',
         icon: 'info'
       
      });
      </script>";
}
}else{


         $getInstitution="SELECT * FROM institution WHERE name='$institutionType'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionTypeid=$row['id'];
            }


      $orderStatus="SELECT * FROM status WHERE name='$status'";
            $run_orderStatus=mysqli_query($conn,$orderStatus);
            while ($row=mysqli_fetch_array($run_orderStatus)) {
              $statusid=$row['id'];
              
            }

    if($status=="All Status"){

    $getOrders="SELECT * FROM checkout WHERE InstitutionId='$institutionTypeid' AND orderdate>= '$date1' AND orderdate <='$date2'  ";
   }else{
      $getOrders="SELECT * FROM checkout WHERE InstitutionId='$institutionTypeid' AND orderStatus='$statusid' AND  orderdate>= '$date1' AND orderdate <='$date2'  ";
   }

  $run_getOrders=mysqli_query($conn,$getOrders);
  $count=mysqli_num_rows($run_getOrders);
  if($count>0){

        while ($row=mysqli_fetch_array($run_getOrders)) {
          # code...

           $customerId=$row['customerId'];
            $InstitutionId =$row['InstitutionId'];
            $orderStatus1=$row['orderStatus'];
            $paymentdate=$row['orderdate'];
            $institutionName=$row['institutionName'];
            $initialAmount=$row['initialAmount'];
            $id=$row['id'];

           

  $getCustomers="SELECT * FROM customer WHERE id='$customerId'";
  $run_getCustomers=mysqli_query($conn,$getCustomers);
  
    while ($row=mysqli_fetch_array($run_getCustomers)) {
        $fname=$row["fname"];
        $customerId=$row["customerId"];
        $id=$row["id"];
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
        }
           
           $getInstitution="SELECT * FROM institution WHERE id='$InstitutionId'";
            $run_getInstitution=mysqli_query($conn,$getInstitution);
            while ($row=mysqli_fetch_array($run_getInstitution)) {
              $institutionType=$row['name'];
            }

             $getuserpayment="SELECT sum(paymentAmount) AS sum_payment FROM userpayments WHERE customerId='$customerId'";
       $run_getuserpayment=mysqli_query($conn,$getuserpayment);
       while($row=mysqli_fetch_array($run_getuserpayment)) {
           $paymentAmount=$row["sum_payment"];
           
         } 
           $paymentStatus="SELECT * FROM userpayments WHERE customerId='$id'";
         $run_paymentStatus=mysqli_query($conn,$paymentStatus);
          while($row=mysqli_fetch_array($run_paymentStatus)){
            $statusid1 =$row["statusid"];

        } 
 



     $UpdateOrderReports="INSERT INTO 
     orderreport(fname,sname,institutionType,institutionName,AmountPaid,ezwich,orderDate,customerId,user_payments_statusid) VALUES('$fname','$sname','$institutionType','$institutionName','$paymentAmount','$ezwich_num','$paymentdate','$id','$statusid1')";

     $run_UpdateOrderReports=mysqli_query($conn,$UpdateOrderReports);

     if($run_UpdateOrderReports){
       echo "<script>window.open('reportPrint.php','_new')</script>";
     }else{
          echo " <script>swal.fire({
          title: ' Report Unavailable!',
         text: 'No Report for this data!. ',
         icon: 'info'
       
      });
      </script>";
     }
   

}
}else{
  echo " <script>swal.fire({
          title: ' Report Unavailable!',
         text: 'No Report for this data!. ',
         icon: 'info'
       
      });
      </script>";
}
}
}
}

// payment Report
function getCustomerPayment(){
  global $conn;
    if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $getPayments="SELECT * FROM userpayments WHERE   paymentDate>= '$date1' AND paymentDate <= '$date2' GROUP BY customerId ";
}else{
   $getPayments="SELECT * FROM userpayments WHERE(paymentDate between date_format(NOW(),'%Y-%m-01') AND NOW()) GROUP BY customerId";
}
  
  $run_getPayments=mysqli_query($conn,$getPayments);
  $count=mysqli_num_rows($run_getPayments);

  if($count>0){


  while($row=mysqli_fetch_array($run_getPayments)){
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
           $paymentAmount=$row["sum_payment"];
           
         }  

        echo " <tr class='odd gradeX'>
                     <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymenttype</td>
                      <td>$paymentoption</td>
                      <td>$paymentPlanid</td>
                      <td>$paymentAmount</td>
                      
                      <td><a href='paymentReportPrint.php?id=$uid' target='_blank'><button style='border-radius:5px;' class='btn btn-info'>Print</button></a>
                        
                      </td>

                      </tr>";
       

  }
}else{
   echo "<div class='alert alert-danger' role='alert'>
                        No Payment History! 
                   </div>";
}
}


function getAllpayments(){
  global $conn;

   if(isset($_POST["refresh"])){
  $date1=$_POST["date1"];
  $date2=$_POST["date2"];
  $getPayments="SELECT * FROM userpayments WHERE   paymentDate>= '$date1' AND paymentDate <= '$date2'";
}else{
   $getPayments="SELECT * FROM userpayments WHERE(paymentDate between date_format(NOW(),'%Y-%m-01') AND NOW())";
}
  $run_getPayments=mysqli_query($conn,$getPayments);
  $count=mysqli_num_rows($run_getPayments);

  if($count>0){

    while($row=mysqli_fetch_array($run_getPayments)){
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


         $user_payments_status="SELECT * FROM user_payments_status WHERE id='$statusid'";
            $run_user_payments_status=mysqli_query($conn,$user_payments_status);
            while ($row=mysqli_fetch_array($run_user_payments_status)) {
              $user_payments_status=$row['name'];
              $color=$row['color'];
            }



        echo " <tr class='odd gradeX'>
                     <td>$fullName</td>
                      <td>$institutionType</td>
                      <td>$institutionName</td>
                      <td>$paymentDate</td>
                      <td>$paymentAmount</td>
                      
                      <td style='color:$color'>$user_payments_status</td>";

                      if ($statusid==1) {
                        # code...
                          echo " <td>
                      <a href='payments.php?id=$id'> <button style=''  class='btn btn-danger'  name='payment_reportSubmit'>Unclear</button></a>
                        
                      </td>";
                      }else{
                         echo " <td>
                      <a href='payments.php?id=$id'> <button style='padding-left:15px; padding-right:15px;' class='btn btn-primary'  name='payment_reportSubmit'>Clear</button></a>
                      </td>";
                      }
                      
                    
                  echo "
                      </tr>";

  }
}else{
     echo "<div class='alert alert-danger' role='alert'>
                        No Payment History! 
                   </div>";
  }
}



function getPaymentCount(){
  global $conn;
  $getPayments="SELECT * FROM userpayments";
  $run_getPayments=mysqli_query($conn,$getPayments);
  $count_payments=mysqli_num_rows($run_getPayments);

  echo $count_payments;

}


// update payment stutus


function update_payment_status(){
  global $conn;
  if(isset($_GET["id"])){
    $id=$_GET["id"];

    $getpayments="SELECT * FROM userpayments WHERE id='$id' ";
    $run_getpayments=mysqli_query($conn,$getpayments);
    while ($row=mysqli_fetch_array($run_getpayments)) {
      # code...
      $paymentStatus=$row["statusid"];
    }

    if($paymentStatus==1){
      $update_payment_status="UPDATE userpayments SET statusid='2' WHERE id='$id'";
      $run_update_payment_status=mysqli_query($conn,$update_payment_status);
      if($run_update_payment_status){

          echo " <script>swal.fire({
          title: ' payment Uncleared!',
         text: 'User payment have been Uncleared!. ',
         icon: 'success'
       
      });
      </script>";
      }
    }else{
      $update_payment_status="UPDATE userpayments SET statusid='1' WHERE id='$id'";
      $run_update_payment_status=mysqli_query($conn,$update_payment_status);
      if($run_update_payment_status){

          echo " <script>swal.fire({
          title: ' payment Cleared!',
         text: 'User payment have been cleared!. ',
         icon: 'success'
       
      });
      </script>";
      }
    }
  }
}

?>