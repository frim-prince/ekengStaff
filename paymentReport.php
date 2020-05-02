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
	<title>Payment Reports</title>
	<?php include_once("link.php");  ?>
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
<?php include_once("nav.php")      ?>
<div class="wrapper">
    <div class="container">
        <div  class="row">
         <?php  include_once("aside.php")   ?>
           <div class="span9">
            <form method="post">
           	  <div class="module-head">
                <button class="btn btn-primary" type="submit" style='float:right;margin-top:-2px;' name="refresh">Refresh</button>
                  <input style='float:right;margin-top:-2px; width:100px; margin-right: 10px;' id = "datepicker-1" type="text" name="date2" value="<?php echo date('Y-m-t') ?>"  />
                             <p style='float:right'>_______</p>
                 <input style='float:right;margin-top:-2px; width:100px;' id = "datepicker-10" type="text" name="date1" value="<?php echo date('Y-m-01') ?>"  />
                <h3>Payment Reports</h3>
              </div>
            </form>

                <div class="module-body table" style="background-color: white">
                    

                         <?php  include_once("paymentReportTable.php")  ?>

                       <div style="margin-left: 20px; margin-bottom: 200px;margin-top:20px; ">
                        <a href="paymentAllPrint.php"> <button style="padding: 10px 20px 10px 20px;" class="btn btn-primary"  name="payment_reportSubmit">Print All</button></a>
                           
                       </div>

                      
                       
                      
                </div>
             
              
           </div>
           </div>
       </div>
    </div>
</div>
<?php    include_once("footer.php")  ?>
<?php  include_once("script.php") ?>
</body>
</html>