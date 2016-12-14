      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
			<h3><i class="fa fa-angle-right"></i> Agency List</h3>
			
				<!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel" style="margin:0px !important;">
						  <?php $attributes = array('class' => 'form-inline'); 
								echo form_open('admin/agency/search_agency_list', $attributes); ?>
						  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="agency">Agency Name</label>
								  <input type="text" class="form-control" name="agency" id="agency" value="<?php if(!empty($agency)) { echo $agency; } ?>" placeholder="Agency Name">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="agency">Username</label>
								  <input type="text" class="form-control" name="username" id="username" value="<?php if(!empty($username)) { echo $username; } ?>" placeholder="Username">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="exampleInputEmail2">Email Address</label>
								  <input type="email" class="form-control" name="agency_email" id="agency_email" value="<?php if(!empty($email_id)) { echo $email_id; } ?>" placeholder="Email Id">
							  </div>
							  <button type="submit" class="btn btn-theme">Search</button>
						  </form>
						</div><!-- /form-panel -->
					</div><!-- /col-lg-12 -->
				</div><!-- /row -->
				
				<div class="row mt">
					<div class="col-lg-12">
						  <div class="content-panel">
							  <?php if(empty($rows)) { ?>
								  <h2 style="margin-left:30px;">Oops! No Records Found!</h2>
								  <a style="margin-left:30px; margin-bottom:15px;" href="<?php echo site_url('admin/agency/agency_list/'); ?>" class="btn btn-success">Back To Agency List</a>
							  <?php } else { ?>
						  <section id="unseen">
							  
								<table class="table table-striped table-advance table-hover">
								  <thead>
									  <tr>
										  <th>Agency Name</th>
										  <th>User Name</th>
										  <th>Email</th>
										  <th>Status</th>
										  <th>Created</th>
										  <th></th>
									   </tr>
								  </thead>
								  <tbody>
									  <?php foreach($rows as $result_data) : ?>
									  <tr>
										  <?php $u_id = $result_data->id; ?>
										  <?php $f_id = $result_data->f_id; ?>
										  <td><?php echo $result_data->fullname; ?></td>
										  <td><?php echo $result_data->username; ?></td>
										  <td><?php echo $result_data->email; ?></td>
										  <td><?php if($result_data->disable_filter == 1){ echo "Disabled"; } else { echo "Enabled"; } ?></td>
										  <td><?php $Date = date("d-m-Y", strtotime($result_data->created)); echo  $Date; ?></td>
										  <td>
											  <a title="Edit Agency" href="<?php echo site_url('admin/agency/edit_agency/'.$u_id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											  <a onclick="return confirm('Are You Sure to Delete This Agency?');" title="Delete Agency" href="<?php echo site_url('admin/agency/delete_agency/'.$u_id); ?>" href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
											  <?php if(($result_data->user_id) != '') { ?>
											  <a title="Edit Filter" href="<?php echo site_url('admin/filter/edit_filter/'.$f_id); ?>" class="btn btn-primary btn-xs">Edit Filter</a>
											  <?php } else { ?>
											  <a title="Add Filter" href="<?php echo site_url('admin/filter/add/?id='.$u_id); ?>" class="btn btn-primary btn-xs">Add Filter</a>
											  <?php } ?>
										  </td>
									  </tr>
									  <?php endforeach; ?>
									 
								  </tbody>
							  </table>
							  <?php } ?>
							  </section>
							  <p class="pagination"><?php if(!empty($links)) { echo $links; } else { echo ""; } ?></p>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->
