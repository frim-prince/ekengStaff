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
	<title>Reports</title>
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
                  <input style='float:right;margin-top:-2px; width:100px; ' id = "datepicker-1" type="text" name="date2" value="<?php echo date('Y-m-t') ?>"  />
                             <p style='float:right'>_______</p>
                 <input style='float:right;margin-top:-2px; width:100px;' id = "datepicker-10" type="text" name="date1" value="<?php echo date('Y-m-01') ?>"  />
                <h3>Order Reports</h3>
              </div>

                <div class="module-body table" style="background-color: white">
                     <div class=' row-fluid' style="margin-top: 20px;">
                        
                             <div class='span4'>
                              <div class="control-group">
                                 <label style="margin-left: 35px;" class="control-label" for="basicinput">Institution Type</label>
                               <div style="margin-left: 5px;" class="controls">
                                 <select tabindex="1" name="instType" class="span8" id="instTypeid" required>
                                   <option >All Institution Types</option>
                                     <?php getIstitutontypes();    ?>
                                 
                                 </select>
                               </div>
                              </div>
                              </div>
                     

                      
                             <div class='span4'>
                              <div class="control-group">
                                 <label style="margin-left: 35px;" class="control-label" for="basicinput">Institution Name</label>
                               <div class="controls">
                                 <select tabindex="1" name="instName" class="span8" id="instNameid">
                                   <option value="">All</option>
                                   
                                   
                                 </select>
                               </div>
                              </div>
                              </div>




                             <div class='span4'>
                              <div class="control-group">
                                 <label style="margin-left: 35px;" class="control-label" for="basicinput">Order Status</label>
                               <div class="controls">
                                 <select tabindex="1" name="status" class="span8" id="statusid">
                                   <option >All Status</option>
                                   <?php getStatus();   ?>
                                   
                                 </select>
                               </div>
                              </div>
                              </div>
                      

                      
                        

                       </div>

                         

                       <div style="margin-left: 20px; margin-bottom: 200px;margin-top:20px; ">
                         <button style="padding: 10px 20px 10px 20px;" class="btn btn-primary" type="submit" name="reportSubmit"> Preview</button>
                           <?php preview() ?>
                       </div>

                      
                       
                      
                </div>
              </form>
              
           </div>
           </div>
       </div>
    </div>
</div>
<?php    include_once("footer.php")  ?>
<?php  include_once("script.php") ?>
</body>
</html>