<?php 
if($this->session->flashdata('success')){ ?>
<div class="col-lg-12"><br/><div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div></div>
<?php }
?>
			<h3><i class="fa fa-angle-right"></i>Leads</h3>
				<!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel" style="margin:0px !important;">
						  <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $pagination->total_rows.' data found'; ?></h4>
							
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
									  <form name='action' class="form-inline" action="<?php echo base_url("/index.php/executive/executive_home/action"); ?>" method='post'> 
									<table class="table table-striped table-advance table-hover">
									  <thead>
									  	<tr>
									  		<td colspan="2">
												<select name="verification" id="verification" class="form-dropdown" required style="width:150px;">
													<option value="CV">Call Verified</option>
												</select>
											</td>
									  		<td colspan="8">
											<input type="submit" onclick="return confirm('Are You Sure?');" value="Submit" class="btn btn-theme">
											</td>
									  	</tr>	
										  <tr>
										  	  <th></th>	
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
										  	<td><input id="lead[]" class="checkbox1" type="checkbox" name="lead[]" value="<?php echo $result_data['ID']; ?>" /></td>
											<td><?php echo $result_data['Name']; ?></td>
											<td><?php echo $result_data['Email_ID']; ?></td>
											<td><?php echo $result_data['ContactNo']; ?></td>
											<td><?php echo $DOB = date("d-m-Y", strtotime($result_data['DOB'])); ?></td>
											<td><?php echo $result_data['insurance_product']; ?></td>
											<td><?php echo $result_data['City']; ?></td>
											<td><?php echo $result_data['Annual_Income']; ?></td>
											<td><?php $Date = mdate("d-m-Y h:i:s a", strtotime($result_data['PostDate'])); echo  $Date; ?></td>
										  </tr>
										  
										  <?php endforeach; ?>
										 
									  </tbody>
								  </table>
								</form>
							  
							  </section>
							  <p class="pagination"><?php echo $links; ?></p>
							  <?php } ?>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->
