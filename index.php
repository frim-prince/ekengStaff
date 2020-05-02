<?php  
include_once("config.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();

  
}


   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
 
    
}else{
    include_once("login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php  include_once("link.php")  ?>
     <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
         $(function() {
            $( "#datepicker-10" ).datepicker({
               changeMonth:true,
               changeYear:true,
                dateFormat: 'yy-mm-dd',
               numberOfMonths:[2,2]
            });
         });
      </script>
      <script>
         $(function() {
            $( "#datepicker-1" ).datepicker({
               changeMonth:true,
               changeYear:true,
                dateFormat: 'yy-mm-dd',
               numberOfMonths:[2,2]
            });
         });
      </script>
</head>
<body>
<?php include_once("nav.php")  ?>

<div class="wrapper">
    <div class="container">
        <div  class="row">
        	<?php  include_once("aside.php") ?>

        	 <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">

                                    <a href="neworder.php" class="btn-box big span4"><i class="icon-envelope" style="color: #FF6EFF"></i><b><?php 
                                       
                                    countnewoder(); processOrder();cancelOrder(); ?></b>
                                        <p class="text-muted">
                                       New Orders </p>
                                    </a>
                                    <a href="pendingorders.php" class="btn-box big span4"><i class="icon-book"></i><b><?php pendingordersCount();   ?></b>
                                        <p class="text-muted">
                                            Pending Orders</p>
                                    </a>
                                    <a href="ProcessingOrders.php" class="btn-box big span4"><i class="icon-envelope-alt" style="color: #FF7A00"></i><b><?php run_processingordersCount() ?></b>
                                        <p class="text-muted">
                                            Processing Orders</p>
                                    </a>
                                </div>
                                 <div class="btn-box-row row-fluid">
                                    <a href="deliveroder.php" class="btn-box big span4"><i class=" icon-folder-open-alt" style="color: #FF6EFF"></i><b><?php deliveredordersCount() ?></b>
                                        <p class="text-muted">
                                          Delivered Orders  </p>
                                    </a><a href="cancelorders.php" class="btn-box big span4"><i class="icon-folder-close-alt"></i><b><?php   cancelledordersCount() ?></b>
                                        <p class="text-muted">
                                           Cancelled Orders </p>
                                    </a><a href="customers.php" class="btn-box big span4"><i class="icon-user" style="color: #FF7A00"></i><b><?php countcustomers();  ?></b>
                                        <p class="text-muted">
                                            Total Customers</p>
                                    </a>
                                </div>

                                 <div class="btn-box-row row-fluid">
                                     <a href="payments.php" class="btn-box big span4"><i style="color: #FF6EFF" class=" icon-money"></i><b><?php getPaymentCount() ?></b>
                                        <p class="text-muted">
                                         All Payments  </p>
                                    </a>
                                    <a href="owingCustomers.php" class="btn-box big span4"><i class=" icon-folder-open-alt"></i><b><?php deliveredordersCount() ?></b>
                                        <p class="text-muted">
                                          Owing Customers  </p>
                                    </a>
                                    <a href="fully_paid_customers.php" class="btn-box big span4"><i class="icon-folder-close-alt" style="color: #FF7A00"></i><b><?php   cancelledordersCount() ?></b>
                                        <p class="text-muted">
                                           Full Paid Customers </p>
                                    </a>
                                </div>


                               
                            </div>
        </div>

        <?php include_once('NewOrderTable.php')   ?>

    </div>



 </div>



   <?php include_once("footer.php")  ?>
 <?php  include_once("script.php")  ?>
</body>
</html>