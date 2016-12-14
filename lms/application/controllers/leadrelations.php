<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leadrelations extends CI_Controller {

	function __construct(){
		//echo 'hi';die;
		parent::__construct();
		//$this->clear_cache();
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);

		$this->update_leads_relations();

	}

	public function update_leads_relations() {
	 		
	 		$users_data = $this->users->list_clients();

	 		foreach ($users_data as $key => $value) {
	 		
		 			$filter_data = 	$this->users->get_filter_details($value->id);

		 			if(!empty($filter_data)){
			 			$city = $filter_data->city_id;
						$agents = $filter_data->agents;
						$product = $filter_data->product;
						$income = $filter_data->income;
						$verification = $filter_data->verification;
						$start_date = date('Y-m-d');
						$today = date('Y-m-d');
						if($filter_data->min_age!=0){
					
							$min_age = date('Y-m-d', strtotime('-'.$filter_data->min_age.' years', strtotime($today)));
					
						}else{

							$min_age = '';

						}
						if($filter_data->max_age!=0){
							
							$max_age = date('Y-m-d', strtotime('-'.$filter_data->max_age.' years', strtotime($today)));
						
						}else{

							$max_age = '';
						}
						
						$end_date = '';
						
						$results = $this->leads->get_relations_leads($city, $product, $income, $min_age, $max_age, $start_date, $end_date, $verification,$agents);
				 		$leads = $results->result_array();
				 		//echo '<pre>'; print_r($leads);die;
				 		foreach ($leads as $key_lead => $value_lead) {
				 				
				 				$this->leads->update_relations_leads($value_lead['ID'],$value->id);		
				 				
				 		}	

				 		//echo '<pre>';print_r($leads);die;

				}
			}
			echo 'Leads Updated'; 
			exit();		

	}

}


?>