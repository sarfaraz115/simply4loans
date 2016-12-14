<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Admin_Controller {

	function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
		$this->site_data['title'].= 'Dashboard';
		//echo 'hi';die;
		$this->site_data['main_content'].= 'common/home';

		$this->site_data['menu']['dashboard'] = 1;
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}

}

?>