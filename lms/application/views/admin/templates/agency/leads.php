      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
			<h3><i class="fa fa-angle-right"></i> Leads</h3>
				<div class="row mt">
					<div class="col-lg-12">
						  <div class="content-panel">
						  <h4><i class="fa fa-angle-right"></i> Filter Leads</h4>
							  <section id="unseen">
							  <?php if(empty($rows)) { ?>
									<h2 style="margin-left:30px">Oops! No Records Found!</h2>
									  <?php } else { ?>
									<table class="table table-bordered table-striped table-condensed">
									  <thead>
										  <tr>
											  <th><i class="fa fa-bullhorn"></i>Name</th>
											  <th>Email Id</th>
											  <th>Address</th>
											  <th>State</th>
											  <th>City</th>
											  <th>Zip</th>
											  <th>Salary</th>
											  <th>Age</th>
											  <th>Date</th>
										   </tr>
									  </thead>
									  <tbody>
										  
										  <?php foreach($rows as $result_data) : ?>
										  <tr>
											  <td><?php echo $result_data->name; ?></td>
											  <td><?php echo $result_data->email; ?></td>
											  <td><?php echo $result_data->address; ?></td>
											  <td><?php echo $result_data->state; ?></td>
											  <td><?php echo $result_data->city; ?></td>
											  <td><?php echo $result_data->zip; ?></td>
											  <td><?php echo $result_data->salary; ?></td>
											  <td><?php echo $result_data->age; ?></td>
											  <td><?php $Date = date("D M d Y H:i:s", strtotime($result_data->date)); echo  $Date; ?></td>
										  </tr>
										  
										  <?php endforeach; ?>
										 
									  </tbody>
								  </table>
							  <?php } ?>
							  </section>
							  <p class="pagination"><?php echo $links; ?></p>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->
