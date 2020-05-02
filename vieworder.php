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
	<title>View Order</title>
	<?php include_once("link.php");  ?>
</head>
<body>
<?php include_once("nav.php")      ?>
<div class="wrapper">
    <div class="container">
        <div  class="row">
            <?php  include_once("aside.php")   ?>
             <div class="span9">
           	     <?php  viewcustomerdetails(); processOrder1();cancelOrder1();deliverOrder1();      ?>


                        


              </div>
        </div>
</div>
</div>
<?php    include_once("footer.php")  ?>
<?php  include_once("script.php") ?>
</body>
</html>