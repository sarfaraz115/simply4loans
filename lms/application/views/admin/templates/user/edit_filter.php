      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Add Filter</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <h4 class="mb"><i class="fa fa-angle-right"></i> Form</h4>
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open('admin/filter/update_filter/'.$filter_id, $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Filter Name</label>
            <div class="col-sm-10">
				<?php echo form_error('FilterName'); ?>
				<input type="text" name="FilterName" value="<?php echo $rows->name; ?>"  class="form-input" placeholder="John Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add State</label>
            <div class="col-sm-10">
				<?php echo form_error('state'); ?>
				<select name="state" id="state" class='form-dropdown'>
                    <?php foreach($states as $result_data) : ?>
                    
						<?php if(($rows->state_id) == ($result_data->id)) { ?> 
							<option value="<?php echo $result_data->id; ?>" selected><?php echo $result_data->state; ?></option>
						<?php } else { ?>
							<option value="<?php echo $result_data->id; ?>"><?php echo $result_data->state; ?></option>
						<?php } ?>
							
					<?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add City</label>
            <div class="col-sm-10">
				<?php echo form_error('city'); ?>
				<select name="city" id="city" class='form-dropdown'>  
					 <option value="0">Select</option> 
					 <option value="<?php echo $rows->city_id; ?>" selected><?php echo $rows->city_id; ?></option>  
				</select> 
				
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add Age Range</label>
            <div class="col-sm-10">
				<?php echo form_error('age_range'); ?>
				<select name="age_range" id="age_range" class='form-dropdown'>
                    <option value="0">Select Age</option>
                    <?php foreach($age_range as $result_data) : ?>
                    
						<?php if(($rows->age_range_id) == ($result_data->age_range)) { ?> 
							<option value="<?php echo $result_data->age_range; ?>" selected><?php echo $result_data->age_range; ?></option>
						<?php } else { ?>
							<option value="<?php echo $result_data->age_range; ?>"><?php echo $result_data->age_range; ?></option>
						<?php } ?>
						
					<?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add Salary Range</label>
            <div class="col-sm-10">
      				<?php echo form_error('salary_range'); ?>
      				<select name="salary_range" id="salary_range" class='form-dropdown'>
                          <option value="0">Salary Range</option>
                          <?php foreach($salary_range as $result_data) : ?>
                          
      						<?php if(($rows->salary_range_id) == ($result_data->salary_range)) { ?> 
      							<option value="<?php echo $result_data->salary_range; ?>" selected><?php echo $result_data->salary_range; ?></option>
      						<?php } else { ?>
      							<option value="<?php echo $result_data->salary_range; ?>"><?php echo $result_data->salary_range; ?></option>
      						<?php } ?>
      						
      					<?php endforeach; ?>
                </select>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Verification Type</label>
            <div class="col-sm-10">
              <?php echo form_error('verification_error'); ?>
              <select name="verification" id="verification" class='form-dropdown'>
                  <option value="GEN">Generic</option>
                  <option value="OTP">OTP/SMS</option>
                  <option value="CV">Call Verified</option>
              </select>
            </div>
          </div>
          <input type="hidden" name="user_id" id="user_id" value="<?php echo $rows->user_id; ?>" />
          <input type="hidden" name="status" id="status" value="<?php echo $rows->f_status; ?>" />
          <input type="hidden" name="filter_id" id="filter_id" value="<?php echo $rows->f_id; ?>" />
          <button type="submit" class="btn btn-theme">Update Filter</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
		

