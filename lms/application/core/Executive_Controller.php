<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Executive_Controller extends MY_Controller{

	public $site_data = array(

		'title' 		=> 'Leads | ',

		'name' 			=> 'Lead Management System',

		'layout' 		=> 'executive/templates/layout/default',

		'main_content' 	=> 'executive/templates/',

		'menu'			=>	array(

			'dashboard' =>	0,
		
			'leads' =>	0,
		
			'profile' =>	0,

			),

		);

	function __construct(){

		parent::__construct();

		$this->logged_in();

	}


	function logged_in(){

		if($this->session->userdata('logged_data')){

			$logged_data = $this->session->userdata('logged_data');

			if($logged_data['role'] != 4){ //logout if user is not agency.

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
