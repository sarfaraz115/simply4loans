      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Add executive</h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open_multipart('admin/executive/add_executive', $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10">
        <?php echo form_error('fullname'); ?>
                <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>"  class="form-input" placeholder="John Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
            <div class="col-sm-10">
        <?php echo form_error('email'); ?>
                <input type="email" name="email" value="<?php echo set_value('email'); ?>"  class="form-input" placeholder="email@example.com">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
        <?php echo form_error('username'); ?>
                <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-input" placeholder="user">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
        <?php echo form_error('password'); ?>
                <input type="password" name="password" class="form-input" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-10">
        <?php echo form_error('passconf'); ?>
                <input type="password" name="passconf" class="form-input" placeholder="">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Employee Type</label>
            <div class="col-sm-10">
        
               <select name="emp_type" class="form-input">
               <option value="1">Caller</option>
               <option value="2">Other</option>
           
               </select>
             
            </div>
          </div>
          
          
                    
          		          <?php 
        $products = array(
			'Personal loan',
			'Home loan',          
			'Loan against property',
			'Car loan',          
			'Education loan',
			'Gold loan',
			'Credit Card');
          ?>

        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Add Product : </label>
          <div class="col-sm-10">
            <?php echo form_error('product'); ?>
            <select name="product[]" id="product" class='form-dropdown' multiple="multiple">  
             <option value="0">Select Product</option> 
             <?php $productdata = explode(',',$rows->Product); ?>
             <?php foreach($products as $result_data) : ?>
             <?php if(in_array($result_data,$productdata)){
              ?>
              <option value="<?php echo $result_data; ?>" selected><?php echo $result_data; ?></option>
              <?php 
            }else{ ?>
            <option value="<?php echo $result_data; ?>" ><?php echo $result_data; ?></option>
            <?php } ?>
          <?php endforeach; ?>
        </select> 
      </div>
    </div>
          
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Profile Picture</label>
            <div class="col-sm-10">
        <?php echo form_error('image'); ?>
                <input type="file" name="image" value="<?php echo set_value('image'); ?>" class="form-input img" placeholder="">
            </div>
          </div>
          <button type="submit" class="btn btn-theme">Add Executive</button>
        </form>
      </div>
    </div><!-- col-lg-12-->       
    </div><!-- /row -->
