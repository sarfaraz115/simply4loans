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

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>includes/admin/assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>includes/admin/assets/css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
        <div class="container">

          <?php $attributes = array('class' => 'form-login'); 
          echo form_open('login/verify_login', $attributes); ?>
          <h2 class="form-login-heading">sign in now</h2>
          <div class="login-wrap">
            <?php echo form_error('username'); ?>
            <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="User ID" autofocus>
            <br>
            <?php echo form_error('password'); ?>
            <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Password">
            <label class="checkbox">
              <span class="pull-right">
                <!--<a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>-->

              </span>
            </label>
            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
            <hr>
			</div>


        </form>   
            <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
				<?php $attributes = array('class' => ''); 
				echo form_open('login/recover_password', $attributes); ?>
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Forgot Password ?</h4>
                </div>
                <div class="modal-body">
                  <p>Enter your e-mail address below to reset your password.</p>
                  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                </div>
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                  <button class="btn btn-theme" type="submit">Submit</button>
                </div>
              </div>
              </form>
            </div>
          </div>
          <!-- modal -->
  

      </div>
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>includes/admin/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>includes/admin/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?php echo base_url(); ?>includes/admin/assets/js/jquery.backstretch.min.js"></script>
    <script>
    $.backstretch("<?php echo base_url(); ?>includes/admin/assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
  </html>
