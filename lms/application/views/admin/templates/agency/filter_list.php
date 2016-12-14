      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
			<h3><i class="fa fa-angle-right"></i> Filter List</h3>
				<div class="row mt">
					<div class="col-lg-12">
						  <div class="content-panel">
						  <h4><i class="fa fa-angle-right"></i> List</h4>
							  <section id="unseen">
								  <?php if(empty($rows))
								  { ?>
									  <h2 style="margin-left:30px">Oops! No Records Found!</h2>
								  <?php } else { ?>
								<table class="table table-bordered table-striped table-condensed">
								  <thead>
									  <tr>
										  <th>Company Name</th>
										  <th>Filter Title</th>
										  <th>State</th>
										  <th>City</th>
										  <th>Salary Range</th>
										  <th>Age Range</th>
										  <th>Created</th>
										  <th></th>
									   </tr>
								  </thead>
								  <tbody>
									  <?php foreach($rows as $result_data) : ?>
									  <tr>
										  <?php $f_id = $result_data->f_id; ?>
										  <td><?php echo $result_data->fullname; ?></td>
										  <td><?php echo $result_data->name; ?></td>
										  <td><?php echo $result_data->state; ?></td>
										  <td><?php echo $result_data->city_id; ?></td>
										  <td><?php echo $result_data->salary_range_id; ?></td>
										  <td><?php echo $result_data->age_range_id; ?></td>
										  <td><?php echo $result_data->date_created; ?></td>
										  <td>
											  <a onclick="return confirm('Are You Sure to Delete This Agency?');" title="Delete Filter" href="<?php echo site_url('admin/filter/delete_filter/'.$f_id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
										  </td>
									  </tr>
									  <?php endforeach; ?>
								  </tbody>
							  </table>
							  <?php } ?>
							  </section>
					  </div><!-- /content-panel -->
				   </div><!-- /col-lg-4 -->			
				</div><!-- /row -->
