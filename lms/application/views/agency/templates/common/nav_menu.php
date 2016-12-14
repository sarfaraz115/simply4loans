

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">
           <?php if(empty($logged_data['image']))
           {?>
				<p class="centered"><a href="<?php echo site_url('agency/home/view_profile'); ?>"><img height="60" width="60" src="<?php echo base_url(); ?>uploads/admina.png" class="img-circle" width="60"></a></p>
           <?php } else { ?>
				<p class="centered"><a href="<?php echo site_url('agency/home/view_profile'); ?>"><img height="60" width="60" src="<?php echo base_url(). 'uploads/' .$logged_data['image']; ?>" class="img-circle" width="60"></a></p>
		   <?php } ?>
           <h5 class="centered"><?php echo $logged_data['name']; ?></h5>
           
           <li class="mt">
            <a class="<?php if($menu['dashboard'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('/'); ?>">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="<?php if($menu['profile'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('agency/home/view_profile'); ?>">
              <span>User Profile</span>
            </a>
          </li>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
