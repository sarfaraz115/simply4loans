<?php 
$this->load->view('admin/templates/common/header.php');
$this->load->view('admin/templates/common/nav_menu.php'); ?>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

		<?php if(isset($sidebar)){ ?>
		<div class="row">
			<div class="col-lg-9 main-chart">
				<?php $this->load->view($main_content); ?>
			</div><!-- /col-lg-9 END SECTION MIDDLE -->


			<!-- **********************************************************************************************************************************************************
			RIGHT SIDEBAR CONTENT
			*********************************************************************************************************************************************************** -->                  
			<div class="col-lg-3 ds">
				<?php $this->load->view($sidebar); ?>
			</div><!-- /col-lg-3 -->
			
		</div><!--/row -->
		<?php } else {
			$this->load->view($main_content);//'admin/templates/common/home.php'
			}
		?>

	</section>
</section>
<?php $this->load->view('admin/templates/common/footer.php'); ?>