<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_FrontEndController extends MY_Controller{

	public $site_data = array(

		'title' 		=> 'Simply4Loans | ',

		'name' 			=> 'Easy way to apply loans and credit card',

		'layout' 		=> 'templates/layout/bone',

		'main_content' 	=> 'frontend/',

		'menu'			=>	array(
			'Home' =>	0
			),

		);

	function __construct(){

		parent::__construct();

	}


}
