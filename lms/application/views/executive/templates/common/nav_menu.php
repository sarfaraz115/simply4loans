

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
           <p class="centered"><a href="<?php echo site_url('executive/executive_home/view_profile'); ?>"><img height="60" width="60" src="<?php echo base_url(); ?>uploads/admina.png" class="img-circle" width="60"></a></p>
           <?php } else { ?>
           <p class="centered"><a href="<?php echo site_url('executive/executive_home/view_profile'); ?>"><img height="60" width="60" src="<?php echo base_url(). 'uploads/' .$logged_data['image']; ?>" class="img-circle" width="60"></a></p>
           <?php } ?>
           <h5 class="centered"><?php echo $logged_data['name']; ?></h5>
           
           <li class="mt">
            <a class="<?php if($menu['dashboard'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('executive/executive_home/'); ?>">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="<?php if($menu['leads'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('executive/executive_home/view_profile'); ?>" >
              <i class="fa fa-desktop"></i>
              <span>Leads</span>
            </a>
            <ul class="sub">
              <li class="<?php if($menu['leads'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('executive/executive_home/show_leads'); ?>">Leads</a></li>
            
            </ul>
          </li>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
