			<script>
			  $(function() {
				$( "#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
				$( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' });
			  });
			  
				   $(function() {
				$( "#lfromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
				$( "#ltodate" ).datepicker({ dateFormat: 'yy-mm-dd' });
			  });
		  </script>
          
       <script>
	
      $(document).ready(function(){
		 // alert('j');
		  $("#importIDs").click(function(){
			  var lfromdate=$("#lfromdate").val();
			  var ltodate=$("#ltodate").val();
			  var cmbfeedback=$("#cmbfeedback").val();
              var data="lfromdate="+lfromdate+"&ltodate="+ltodate+"&cmbfeedback="+cmbfeedback;
				var url="<?php echo base_url("index.php/admin/lead/import_to_c4p"); ?>";
				$("#flash").show();
				$("#flash").fadeIn(100).html('<img src="<?php echo base_url(); ?>uploads/loads.gif" align="absmiddle"> <span class="loading">Loading Comment...</span>');
	
			 $.ajax({
					type: "POST",
					url: url,
					data: data,
					success: function(data){
					//console.log(data);
						//alert(data);
						if(data){
						$("#flash").hide('slow');
						}else {
						$("#flash").hide('slow');
						}
						
						}

				 
				 });
			  });

		  });
      
      </script>

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Leads</h3>
      
      <div><input type="button" value="Import Leads" id="import" class="btn btn-primary download_btn btn-xs" style="float:right;"></div>
            <!----  Import Leads  ---->
      
      <div class="row mt" id="lead" style="display:none;">
					<div class="col-lg-12">
 <div id="flash"></div>
						<div class="form-panel" style="margin:0px !important;">
						   <h4 class="mb"><i class="fa fa-angle-right"></i> Import Leads from C4P</h4>
						   <span id="error_message" style="display:none;">Alredy Exist</span>
							<form name='search' class="form-inline" action="<?php echo base_url("index.php/admin/lead/index/"); ?>" method='get'>  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">From :</label>
								  <input type="text" class="form-control" id="lfromdate" name="lfrom" value="" placeholder="yyyy/mm/dd">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">To :</label>
								  <input type="text" class="form-control" id="ltodate" name="lto" value="" placeholder="yyyy/mm/dd">
							  </div>
                              
                             <div style="padding:0 20px 0 0px;" class="form-group">
								  
<select name="cmbfeedback[]" id="cmbfeedback" style="width:155px;height:122px;" size="7" multiple>




		<option value="Busy" selected="selected" >Busy (Disconnected)</option>
		<option value="Not Reachable" >Not Reachable</option>
		<option value="Switch Off" >Switch Off</option>
        <option value="Ringing" >Ringing</option>
		<option value="FollowUp" >Call Back</option>
		<option value="Listened and Disconnected" >Listened and Disconnected</option>
		<option value="Other Product" >Other Product</option>
		<option value="Not Interested" >Not Interested (Casually Registered)</option>
		<option value="Wrong Number" >Wrong Number</option>
		<option value="Not Eligible(Income)" >Not Eligible(Income) </option>
		<option value="Not Eligible(Age)" >Not Eligible(Age) </option>
		<option value="Other City" >City Not Serviced</option>
		<option value="Duplicate" >Duplicate</option>
		<option value="Not Applied" >Not Applied</option>
		<option value="Fake Lead" >Fake Lead (Student/Housewife)</option>
		<option value="Language Issue" >Language Issue</option>
		<option value="Invalid Number" >Invalid Number/Out of Service</option>
		<option value="Test Lead">Test Lead</option>
		<option value="Save" >Save</option>
		<option value="Verified@C4P" >Verified@C4P</option>
		<option value="Send later" >Send Later</option>
		
		


</select>							  </div>
                              
							  
							  <a  title="Add Filter" id="importIDs" href="#" class="btn btn-primary download_btn btn-xs">Import From C4P</a>
						  </form>
						</div><!-- /form-panel -->
					</div><!-- /col-lg-12 -->
				</div>
      

      
      <!-------End Leads------------>
      
      
      <!-- Search Form -->
				<div class="row mt">
					<div class="col-lg-12">

						<div class="form-panel" style="margin:0px !important;">
						   <h4 class="mb"><i class="fa fa-angle-right"></i> Filter Leads ( <?php echo $pagination->total_rows.' Leads Found'; ?> )</h4>
							<form name='search' class="form-inline" action="<?php echo base_url("index.php/admin/lead/index/"); ?>" method='get'>  
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">From :</label>
								  <input type="text" class="form-control" id="fromdate" name="from" value="<?php if(!empty($start_date)) { echo $start_date; } ?>" placeholder="yyyy/mm/dd">
							  </div>
							  <div style="padding:0 20px 0 0px;" class="form-group">
								  <label class="" for="agency">To :</label>
								  <input type="text" class="form-control" id="todate" name="to" value="<?php if(!empty($end_date)) { echo $end_date; } ?>" placeholder="yyyy/mm/dd">
							  </div>
							  <button type="submit" class="btn btn-theme">Filter</button>
							  <a  title="Add Filter" href="<?php echo site_url('admin/lead/export_csv').'?' . http_build_query($_GET, '', "&"); ?>" class="btn btn-primary download_btn btn-xs">Export To Excel</a>
						  </form>
						</div><!-- /form-panel -->
					</div><!-- /col-lg-12 -->
				</div><!-- /row --> 
				
				<div class="row mt">
					<div class="col-lg-12">
						<div class="content-panel">
							<?php if(empty($rows)) { ?>
							<h2 style="margin-left:30px;">Oops! No Records Found!</h2>
							<a style="margin-left:30px; margin-bottom:15px;" href="<?php echo site_url('admin/lead/'); ?>" class="btn btn-success">Back To Leads</a>
							<?php } else { ?>
							<section id="unseen">
								<form name='delete' class="form-inline" action="<?php echo base_url("index.php/admin/lead/action/"); ?>" method='post'> 
								<table class="table table-striped table-advance table-hover">
									<thead>
										<tr>
											<td colspan="2">
												<select name="action" id="action" onchange="changeaction();" class="form-dropdown" required style="width:150px;">
													<option value="">Action</option>
													<option value="delete">Delete</option>
													<option value="assign">Assign To</option>
												</select>
											</td>
											<td colspan="2">
												<?php //print_r($executives); ?>	
												<select name="executives" id="executives" class="form-dropdown"  style="width:150px;display:none;">
													<option value="">Executive</option>
													<?php foreach ($executives as $key => $value) {
													?>
														<option value="<?php echo $value->id; ?>"><?php echo $value->fullname; ?></option>
													<?php
													} 
													?>
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
											<th>Occupation</th>
											<th>DOB</th>
											<th>Plan</th>
											<th>City</th>
											<th>Income</th>
											<th>Posted On</th>
											<th>Source</th>
											<th>IP</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($rows as $result_data) : ?>
										<tr>
											<td><input id="lead[]" class="checkbox1" type="checkbox" name="lead[]" value="<?php echo $result_data['ID']; ?>" /></td>
											<td><?php echo $result_data['Name']; ?></td>
											<td><?php echo $result_data['Email_ID']; ?></td>
											<td><?php echo $result_data['ContactNo']; ?></td>
											<td><?php echo $result_data['Occupation']; ?></td>
											<td><?php echo $DOB = date("d-m-Y", strtotime($result_data['DOB'])); ?></td>
											<td><?php echo $result_data['insurance_product']; ?></td>
											<td><?php echo $result_data['City']; ?></td>
											<td><?php if($result_data['Occupation']=='Self Employed')
												   {
												   echo $result_data['Annual_Income'];
												   }
												else
												  {
													echo $result_data['NetMonthlyIncome'];
												  }	
												?>
											</td>
											<td><?php $Date = date("d-m-Y", strtotime($result_data['PostDate'])); echo  $Date; ?></td>
											<td><?php echo $result_data['source']; ?></td>  
											<td><?php echo $result_data['IP']; ?></td>  
										</tr>
									<?php endforeach; ?>
									
								</tbody>
							</table>

							</form>
							<?php } ?>
						</section>
						
						<p class="pagination"><?php if(!empty($links)) { echo $links; } else { echo ""; } ?></p>
					</div><!-- /content-panel -->
				</div><!-- /col-lg-4 -->			
			</div><!-- /row -->


        <script>

        	function changeaction(){

            		var action = document.getElementById("action").value;
            		if(action=='assign'){

            			document.getElementById("executives").style.display='';

            		}else{
            			document.getElementById("executives").style.display='none';
            		}

            	}	

            $(document).ready(function() {
            	
            	

                resetcheckbox();
                $('#selecctall').click(function(event) {  //on click
                    if (this.checked) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"              
                        });
                    } else {
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                        });
                    }
                });
                 
                function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                	this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
                }
            });
			$(document).ready(function(){
				$('#import').click(function(){
				 $("#lead").slideToggle("faster");
				});
				
			});
        </script>