      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Add Filter</h3>

		<?php $id = $_GET['id']; ?>
		
      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <h4 class="mb"><i class="fa fa-angle-right"></i> Form</h4>
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open('admin/filter/add_filter?id='.$id, $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Filter Name</label>
            <div class="col-sm-10">
				<?php echo form_error('FilterName'); ?>
				<input type="text" name="FilterName" value="<?php echo set_value('FilterName'); ?>"  class="form-input" placeholder="John Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add State</label>
            <div class="col-sm-10">
				<?php echo form_error('state'); ?>
				<select name="state" id="state" class='form-dropdown'>
                    <option value="0">Select State</option>
                    <?php foreach($states as $result_data) : ?>
						<option value="<?php echo $result_data->id; ?>"><?php echo $result_data->state; ?></option>
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
						<option value="<?php echo $result_data->age_range; ?>"><?php echo $result_data->age_range; ?></option>
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
						<option value="<?php echo $result_data->salary_range; ?>"><?php echo $result_data->salary_range; ?></option>
					<?php endforeach; ?>
                </select>
            </div>
          </div>
          <input type="hidden" name="user_id" id="user_id" value="<?php echo $_GET['id'];  ?>" />
          <button type="submit" class="btn btn-theme">Add Filter</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
		

