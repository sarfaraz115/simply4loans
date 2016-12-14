      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Edit Agency</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open_multipart('admin/agency/update_agency/'.$user_id, $attributes); ?>
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
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <?php echo form_error('status'); ?>
                <select name="status" class="form-dropdown">
                  <option value="1" <?php if($rows->active==1){ echo 'selected'; } ?> >Disable</option>
                  <option value="3" <?php if($rows->active==3){ echo 'selected'; } ?> >Enable</option>
                </select>
              </div>
          </div>
          <input type="hidden" name="user_id" id="user_id" value="<?php echo $rows->id; ?>" />
          <button type="submit" class="btn btn-theme">Update Data</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
