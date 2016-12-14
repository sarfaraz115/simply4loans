

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
           <p class="centered"><a href="<?php echo site_url('admin/profile'); ?>"><img height="60" width="60" src="<?php echo base_url(); ?>uploads/admina.png" class="img-circle" width="60"></a></p>
           <?php } else { ?>
           <p class="centered"><a href="<?php echo site_url('admin/profile'); ?>"><img height="60" width="60" src="<?php echo base_url(). 'uploads/' .$logged_data['image']; ?>" class="img-circle" width="60"></a></p>
           <?php } ?>
           <h5 class="centered"><?php echo $logged_data['name']; ?></h5>

           <li class="mt">
            <a class="<?php if($menu['dashboard'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('admin/home/'); ?>">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="<?php if($menu['leads'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('admin/lead'); ?>" >
              <i class="fa fa-desktop"></i>
              <span>Leads</span>
            </a>
            <ul class="sub">
              <li class="<?php if($menu['leads'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/lead'); ?>">Leads</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a class="<?php if($menu['agency'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('admin/agency/agency_list'); ?>" >
              <i class="fa fa-desktop"></i>
              <span>Clients</span>
            </a>
            <ul class="sub">
              <li class="<?php if($menu['agency_list'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/agency/agency_list'); ?>">Clients</a></li>
              <li class="<?php if($menu['add_agency'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/agency/add'); ?>">Add Client</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a class="<?php if($menu['agent'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('admin/agent/agent_list'); ?>" >
              <i class="fa fa-desktop"></i>
              <span>Publishers</span>
            </a>
            <ul class="sub">
              <li class="<?php if($menu['agent_list'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/agent/agent_list'); ?>">Publishers</a></li>
              <li class="<?php if($menu['add_agent'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/agent/add'); ?>">Add Publisher</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a class="<?php if($menu['executive'] == 1){ echo 'active'; } ?>" href="<?php echo site_url('admin/executive/executive_list'); ?>" >
              <i class="fa fa-desktop"></i>
              <span>Tele Executive</span>
            </a>
            <ul class="sub">
              <li class="<?php if($menu['executive_list'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/executive/executive_list'); ?>">Executives</a></li>
              <li class="<?php if($menu['add_executive'] == 1){ echo 'active'; } ?>"><a href="<?php echo site_url('admin/executive/add'); ?>">Add executive</a></li>
            </ul>
          </li>


        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
