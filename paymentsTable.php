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
							  <button class="btn btn-primary" type="submit" style='float:right;margin-top:-2px;' name="refresh">Refresh</button>
							<input style='float:right;margin-top:-2px; width:100px;margin-right: 10px; ' id = "datepicker-1" type="text" name="date2" value="<?php echo date('Y-m-t') ?>"  />
                             <p style='float:right'>_______</p>
							<input style='float:right;margin-top:-2px; width:100px;' id = "datepicker-10" type="text" name="date1" value="<?php echo date('Y-m-01') ?>"  />
                              </form>
								<h3>Payments</h3>
							</div>
							<br>
							
					      

							<a href="paymentAllPrint.php"> <button style=" margin-left: 55px;" class="btn btn-primary"  name="payment_reportSubmit">Print All</button></a>
							<div class="module-body table">
								<table style="font-size: 11px;" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Institution Type</th>
											<th>Institution Name</th>
											<th>Payment Date</th>
											<th>Payment Amount</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									 <?php getAllpayments();   ?> 
										
									</tbody>
									<tfoot>
										<tr>
											<th>Full Name</th>
											<th>Institution Type</th>
											<th>Institution Name</th>
											<th>Payment Date</th>
											<th>Payment Amount</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

				