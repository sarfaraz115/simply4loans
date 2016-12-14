      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Edit Agency</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <h4 class="mb"><i class="fa fa-angle-right"></i> Form</h4>
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open('admin/user/update_user/'.$user_id, $attributes); ?>
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
                <input type="text" name="username" value="<?php echo $rows->username; ?>" class="form-input" placeholder="user">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
				<?php echo form_error('password'); ?>
                <input type="text" name="password" value="<?php //echo $pass; ?>"  class="form-input" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-10">
				<?php echo form_error('passconf'); ?>
                <input type="text" name="passconf" value="<?php //echo $pass; ?>" class="form-input" placeholder="">
            </div>
          </div>
          <input type="hidden" name="status" id="status" value="<?php echo $rows->active; ?>" />
          <input type="hidden" name="user_id" id="user_id" value="<?php echo $rows->id; ?>" />
          <button type="submit" class="btn btn-theme">Update Data</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
