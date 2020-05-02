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
	<title>Fully Paid Customers</title>
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
  	  <?php include_once('fully_paid_customersTable.php'); ?>
  </div>
</div>
</div>
</div>

<?php    include_once("footer.php")  ?>
<?php  include_once("script.php") ?>



</body>
</html>