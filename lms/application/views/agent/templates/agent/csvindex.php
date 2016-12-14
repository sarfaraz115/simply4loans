      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Add Leads</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
			<?php if(isset($error)) { 
				 echo $error;
			}?>
			<?php if($this->session->flashdata('success') == TRUE)
			{
				echo $this->session->flashdata('success');
			} ?>
          <div class="form-panel">
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open_multipart('agent/agent_home/importcsv', $attributes); ?>
           
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Profile Picture</label>
            <div class="col-sm-10">
                <?php echo form_error('image'); ?>
                <input type="file" name="userfile" class="form-input img" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label"></label>
            <div class="col-sm-10">
                 Click here <a href="<?php echo  base_url().'includes/leads.csv'; ?>" download>Download Standard CSV</a> File.
            </div>
          </div>
          <button type="submit" class="btn btn-theme">Upload</button>
          </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
