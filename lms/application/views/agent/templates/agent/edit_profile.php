      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Edit Profile Data</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <h4 class="mb"><i class="fa fa-angle-right"></i> Form</h4>
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open_multipart('agent/agent_home/update_profile_data/', $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10">
				<?php echo form_error('fullname'); ?>
                <input type="text" name="fullname" value="<?php echo $rows->fullname; ?>"  class="form-input" placeholder="John Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
            <div class="col-sm-10">
				<?php echo form_error('email'); ?>
                <input type="text" name="email" value="<?php echo $rows->email; ?>"  class="form-input" placeholder="email@example.com">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
				<?php echo form_error('username'); ?>
                <input type="text" name="username" value="<?php echo $rows->username; ?>" class="form-input" placeholder="user" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
				<?php echo form_error('password'); ?>
                <input type="password" name="password" value="<?php //echo $pass; ?>"  class="form-input">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-10">
				<?php echo form_error('passconf'); ?>
                <input type="password" name="passconf" value="<?php //echo $pass; ?>" class="form-input">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Profile Picture</label>
            <div class="col-sm-10">
				<?php echo form_error('image'); ?>
				<?php if(empty($rows->image))
				{ ?> <img src="<?php echo base_url('uploads/admina.png'); ?>" height="150px" width="150px"/> <?php } else { ?>
				<img src="<?php echo base_url('uploads/'.$rows->image); ?>" height="150px" width="150px"/><?php } ?>
                <input type="file" name="image" class="form-input img" placeholder="">
            </div>
          </div>

          <input type="hidden" name="status" id="status" value="<?php echo $rows->active; ?>" />
          <input type="hidden" name="user_id" id="user_id" value="<?php echo $rows->id; ?>" />
          <button type="submit" class="btn btn-theme">Update Profile Info</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
