<script>
  $(function() {
	$( "#from" ).datepicker({ dateFormat: 'yy-mm-dd', 
						minDate: new Date(<?php
						$date_old = date("d-m-Y", strtotime($start_date));
						$date = explode('-', $date_old);
						echo $date[2] .  ',' . $date[1] . '- 1,' . $date[0]; 
						?>)});
	$( "#to" ).datepicker({ dateFormat: 'yy-mm-dd',
						minDate:-45});
  });
</script>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
     
			<h3><i class="fa fa-angle-right"></i> Leads</h3>
				<?php if(!empty($rows)) { ?>
				<!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel" style="margin:0px !important;">
						  <h4 class="mb"><i class="fa fa-angle-right"></i> Filter Leads ( <?php echo $pagination->total_rows.' Leads Found'; ?> )</h4>
						 
								<form name='search' class="form-inline" action="<?php echo base_url("index.php/agency/home/index/"); ?>" method='get'>  
						  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">From :</label>
								  <input type="text" class="form-control" id="from" name="from" value="<?php if(!empty($start_date)) { echo $start_date; } ?>" placeholder="dd/mm/yyyy">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">To :</label>
								  <input type="text" class="form-control" id="to" name="to" value="<?php if(!empty($end_date)) { echo $end_date; } ?>" placeholder="dd/mm/yyyy">
							  </div>
							  <button type="submit" class="btn btn-theme">Filter</button>

							  <a  title="Add Filter" href="<?php echo site_url('agency/home/export_csv').'?' . http_build_query($_GET, '', "&"); ?>" class="btn btn-primary download_btn btn-xs">Export To Excel</a>
						  </form>
						</div><!-- /form-panel -->
					</div><!-- /col-lg-12 -->
				</div><!-- /row -->
				<?php } else { } ?>
					
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
											  <th>Name</th>
											  <th>Email Id</th>
											  <th>Mobile</th>
											  <th>DOB</th>
											  <th>Plan</th>
											  <th>City</th>
											  <th>Income</th>
											  <th>Posted On</th>
										   </tr>
									  </thead>
									  <tbody>
										  
										  <?php foreach($rows as $result_data) : ?>
										  <tr>
											<td><?php echo $result_data['Name']; ?></td>
											<td><?php echo $result_data['Email_ID']; ?></td>
											<td><?php echo $result_data['ContactNo']; ?></td>
											<td><?php echo $DOB = date("d-m-Y", strtotime($result_data['DOB'])); ?></td>
											<td><?php echo $result_data['insurance_product']; ?></td>
											<td><?php echo $result_data['City']; ?></td>
											<td><?php echo $result_data['Annual_Income']; ?></td>
											<td><?php $Date = date("d-m-Y", strtotime($result_data['allocated_time'])); echo  $Date; ?>
											
											</td>

										  </tr>
										  
										  <?php endforeach; ?>
										 
									  </tbody>
								  </table>
							  	<div class="row mt">
									<div class="col-lg-2">

									</div>
									<div class="col-lg-5">
									</div>
									<div class="col-lg-5">
										<p class="pagination"><?php echo $links; ?></p>
									</div>
								</div>
							  </section>
							  
							  
							  <?php } ?>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->