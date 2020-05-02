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

	<div class="module">
							<div class="module-head">
								
								<h3>Customers</h3>

							</div>

							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>id</th>
											<th>first Name</th>
											<th>Surname</th>
											<th>Contact</th>
											<th>Email</th>
											<th>Institution</th>
											<th>Start Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									  <?php  getCustomers(); ?>
										
									</tbody>
									<tfoot>
										<tr>
											<th>id</th>
											<th>first Name</th>
											<th>Surname</th>
											<th>Contact</th>
											<th>Email</th>
											<th>Institution</th>
											<th>Start Date</th>
											<th>Action</th>
										</tr>
									</tfoot>

								</table>
							</div>
						</div>

				