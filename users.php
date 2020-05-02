<!DOCTYPE html>
<html>
<head>
	<title>lab</title>
	<?php include_once("link.php");  ?>
</head>
<body>
<?php include_once("nav.php")      ?>
<div class="wrapper">
    <div class="container">
        <div  class="row">
           <?php  include_once("aside.php")   ?>
      <div class="span9">
  	       <?php include_once('usersTable.php')  ?>
      </div>
</div>
</div>
</div>
<?php    include_once("footer.php")  ?>
<?php  include_once("script.php") ?>
</body>
</html>