      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Profile Data</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open_multipart('agency/home/edit_profile', $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10">
				<?php echo form_error('fullname'); ?>
                <label class="col-sm-2 col-sm-2 control-label"><?php echo $rows->fullname; ?></label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
            <div class="col-sm-10">
				<?php echo form_error('email'); ?>
                <label class="col-sm-2 col-sm-2 control-label"><?php echo $rows->email; ?></label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
				<?php echo form_error('username'); ?>
                <label class="col-sm-2 col-sm-2 control-label"><?php echo $rows->username; ?></label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Profile Picture</label>
            <div class="col-sm-10">
				<?php echo form_error('image'); ?>
				<?php if(empty($rows->image))
				{ ?> <img src="<?php echo base_url('uploads/admina.png'); ?>" height="150px" width="150px"/> <?php } else { ?>
				<img src="<?php echo base_url('uploads/'.$rows->image); ?>" height="150px" width="150px"/><?php } ?>
            </div>
          </div>

          <button type="submit" class="btn btn-theme">Edit Profile Info</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
