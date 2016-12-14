<?php
   ////////////////////////////////////////
  
   function db_connect(){
	$dbuser	= "contaosa_simply4"; 
	$dbserver= "localhost"; 
	$dbpass	= "simply4loans"; 
	$dbname	= "contaosa_simply4loans"; 

	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;
	return (FALSE);
   }

   ////////////////////////////////////////
   function ExecQuery($sql){

	/////////////////////////Connect to the db
	db_connect();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

?>
<?php 
if($this->session->flashdata('success')){ ?>
<div class="col-lg-12"><br/><div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div></div>
<?php }
?>

<script>
  $(function() {
	$( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
			<h3><i class="fa fa-angle-right"></i>Leads</h3>
				<!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel" style="margin:0px !important;">
						  <h4 class="mb"><i class="fa fa-angle-right"></i> Filter Leads ( <?php echo $pagination->total_rows.' Leads Found'; ?> )</h4>
								<form name='search' class="form-inline" action="<?php echo base_url("index.php/agent/agent_home/show_leads/"); ?>" method='get'>  
						  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agent">From :</label>
								  <input type="text" class="form-control" id="from" name="from" value="<?php if(!empty($start_date)) { echo $start_date; } ?>" placeholder="dd/mm/yyyy">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agent">To :</label>
								  <input type="text" class="form-control" id="to" name="to" value="<?php if(!empty($end_date)) { echo $end_date; } ?>" placeholder="dd/mm/yyyy">
							  </div>
							  <button type="submit" class="btn btn-theme">Filter</button>
							   <a  title="Add Filter" href="<?php echo site_url('agent/agent_home/export_csv').'?' . http_build_query($_GET, '', "&"); ?>" class="btn btn-primary download_btn btn-xs">Export To Excel</a>
						  </form>
						</div><!-- /form-panel -->
					</div><!-- /col-lg-12 -->
				</div><!-- /row -->
					
				<div class="row mt">
					<div class="col-lg-12">
						  <div class="content-panel">
						  <section id="unseen">
							  <?php if(empty($rows)) { ?>
									<h2 style="margin-left:30px">Oops! No Records Found!</h2>
									  <?php } else { ?>
									<table class="table table-striped table-advance table-hover">
									  <thead>
										  <tr>
										  	<th>UID</th>
											 <th>Insurance Product</th>
											  <th>Mobile</th>
											  <th>DOB</th>
											  <th>City</th>
											  
											  <th>Feedback</th>
											 <th>Call attempt</th>
											  <th>Application Date</th>
											  
										   </tr>
									  </thead>
									  <tbody>
										  
										  <?php foreach($rows as $result_data) :
										  
					$result1 = ExecQuery("select * from rfeedback where AllRequestID='".$result_data['ID']."'");
					$row1 = mysql_fetch_array($result1);		
		                       $num_rows = mysql_num_rows($result1);
		                    // mysql_
		                    // $result = ExecQuery($strSQL);
										   ?>
										  <tr>
											<td><?php echo $result_data['ID']; ?></td>
											<td><?php echo $result_data['insurance_product']; ?></td>
											<td><?php echo $result_data['ContactNo']; ?></td>
											<td><?php echo $result_data['DOB'];?></td>
											<td><?php if($result_data['City']=='Others'){ echo $result_data['Other_City']; }else { echo $result_data['City'];} ?></td>
											
											<td><?php echo $row1['pub_feedback']; ?></td>
											<td><?php echo $row1['not_contactable_counter']; ?></td>
											<td><?php $Date = date("d-m-Y", strtotime($result_data['Application_Date'])); echo  $Date; ?></td>
										 
										 </tr>
										  
										  <?php endforeach; ?>
										 
									  </tbody>
								  </table>
							  
							  </section>
							  <p class="pagination"><?php echo $links; ?></p>
							  <?php } ?>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->