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
								<form method="post">
							  <button class="btn btn-primary" type="submit" style='float:right;margin-top:-2px;' name="">Add Group</button>
							
                              </form>
								<h3>Groups</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Institution Type</th>
											<th>Institution Name</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									  <?php  cancelledorders();  ?>
										
									</tbody>
									<tfoot>
										<tr>
											<th>Full Name</th>
											<th>Institution Type</th>
											<th>Institution Name</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

				