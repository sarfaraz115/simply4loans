<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>includes/admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>includes/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/admin/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/admin/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>includes/admin/assets/lineicons/style.css">    
    <script src="<?php echo base_url(); ?>includes/admin/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>includes/admin/assets/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>includes/admin/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>includes/admin/assets/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>includes/admin/assets/js/chart-master/Chart.js"></script>
    
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php site_url(); ?>" class="logo"><b><?php echo $name; ?></b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo site_url('admin/home/logout'); ?>">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->