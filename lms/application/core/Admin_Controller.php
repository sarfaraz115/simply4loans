<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller{

	public $site_data = array(
		
		'title' 		=> 'Admin | ',
		
		'name' 			=> 'Lead Management System',
		
		'layout' 		=> 'admin/templates/layout/default',
		
		'main_content' 	=> 'admin/templates/',
		
		'menu'			=>	array(
			
			'dashboard' =>	0,
			
			'leads' 	=>	0,
		
			'agency' 	=>	0,
			
			'add_agency'	=>	0,
			
			'agency_list'	=>	0,
			
			'add_agent'	=>	0,
			
			'agent'	=>	0,
			
			'agent_list'	=>	0,

			'executive'	=>	0,
			
			'executive_list'	=>	0,
			
			'add_executive'	=>	0,
			
			),
		
		);
	
	function __construct(){
		
		parent::__construct();
		
		$this->logged_in();

	}


	function logged_in(){

		if($this->session->userdata('logged_data')){

			$logged_data = $this->session->userdata('logged_data');

			if($logged_data['role'] != 1){ //logout if user is not admin.

				$this->logout(); 
				
			}

			$this->site_data['logged_data'] = $logged_data;

			return true;
			

		}else{

			redirect('login', 'refresh'); //redirect to admin page if not logged in.

		}

	}
	
	
	function logout(){
		
		$this->session->unset_userdata('logged_data'); //unset data
		
		$this->session->sess_destroy(); //destroy session
		
		redirect('login', 'refresh'); //redirect to admin page.

	}

}
