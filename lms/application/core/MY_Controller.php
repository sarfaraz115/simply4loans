<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once( APPPATH . 'core/Admin_Controller.php' );
include_once( APPPATH . 'core/Public_Controller.php' );
include_once( APPPATH . 'core/Agent_Controller.php' );
include_once( APPPATH . 'core/Executive_Controller.php' );

class MY_Controller extends CI_Controller{

	function __construct(){

		parent::__construct();
		
		$this->clear_cache();

	}

	//To clear cache on controller load
	function clear_cache(){
		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		
		$this->output->set_header("Pragma: no-cache");
	}

}