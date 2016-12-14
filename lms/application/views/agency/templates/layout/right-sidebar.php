<?php 
$this->load->view('agency/templates/common/header.php');
$this->load->view('agency/templates/common/nav_menu.php'); ?>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

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
	</section>
</section>
<?php $this->load->view('agency/templates/common/footer.php'); ?>