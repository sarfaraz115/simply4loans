      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
			<h3><i class="fa fa-angle-right"></i> User List</h3>
			
				<!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel" style="margin:0px !important;">
						  <h4 class="mb"><i class="fa fa-angle-right"></i> Search User</h4>
						  <?php $attributes = array('class' => 'form-inline'); 
								echo form_open('admin/user/search_user_list', $attributes); ?>
						  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="agency">Agency Name</label>
								  <input type="text" class="form-control" name="agency" id="agency" placeholder="Agency Name">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="agency">User Name</label>
								  <input type="text" class="form-control" name="username" id="username" placeholder="Username">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="sr-only" for="exampleInputEmail2">Email Address</label>
								  <input type="email" class="form-control" name="agency_email" id="agency_email" placeholder="Email Id">
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
								  <a style="margin-left:30px; margin-bottom:15px;" href="<?php echo site_url('admin/user/user_list/'); ?>" class="btn btn-success">Back To User List</a>
							  <?php } else { ?>
						  <h4><i class="fa fa-angle-right"></i> User List</h4>
							  <section id="unseen">
							  
								<table class="table table-bordered table-striped table-condensed">
								  <thead>
									  <tr>
										  <th><i class="fa fa-bullhorn"></i>Agency Name</th>
										  <th>User Name</th>
										  <th>Email</th>
										  <th><i class=" fa fa-edit"></i>Status</th>
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
										  <td><?php if($result_data->active == 1){ echo "Active"; } else { echo "Deactive"; } ?></td>
										  <td><?php $Date = date("D M d Y H:i:s", strtotime($result_data->created)); echo  $Date; ?></td>
										  <td>
											  <a title="Edit Agency" href="<?php echo site_url('admin/user/edit_user/'.$u_id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											  <a title="Delete Agency" href="<?php echo site_url('admin/user/delete_user/'.$u_id); ?>" href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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
