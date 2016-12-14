<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter extends Admin_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin/users', '', TRUE);
		
	}

	public function index(){
		
		

	}
	
	public function add(){
		
		$this->site_data['title'].= 'Add Filter';

		$this->site_data['main_content'].= 'agency/add_filter';

		$this->site_data['menu']['filter'] = 1;
		
		$this->site_data['cities'] = $this->users->get_city();
		
		$this->site_data['agents'] = $this->users->list_all_agent();

		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	public function add_filter()
	{
		$this->site_data['title'].= 'Add Filter';
		
		$this->site_data['main_content'].= 'agency/add_filter';

		$this->site_data['menu']['filter'] = 1;
		
		$this->form_validation->set_rules('FilterName', 'Filter Name', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('min_age', 'Minimum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('max_age', 'Maximum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('income', 'Income', 'required');
		$this->form_validation->set_rules('min_loan_amount', 'Min loan amount', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){
			
			$this->site_data['cities'] = $this->users->get_city();
			$this->site_data['agents'] = $this->users->list_all_agent();
			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{		
				$cities = implode(',',$this->input->post('city'));
				$product = implode(',',$this->input->post('product'));
				$income = $this->input->post('income');
				$agent = $this->input->post('agents');
				$employeement_status = implode(',',$this->input->post('employeement_status'));
				if(empty($agent)){
						$agents = '';
				}else{

						$agents = implode(',',$this->input->post('agents'));

				}
				
				if($this->input->post('disable_filter')=='on'){

					$disable_filter = '1';
					$disable_date = date('Y-m-d');

				}else{
					$disable_filter = '0';
					$disable_date = '';
				}
				
				$min_loan_amount=$this->input->post('min_loan_amount');

				$data = array(
				'name' 				=> $this->input->post('FilterName'),
				'min_age' 			=> $this->input->post('min_age'),
				'max_age' 			=> $this->input->post('max_age'),
				'disable_filter'	=> $disable_filter,
				'disable_date'		=> $disable_date,
				'income' 			=> $income,
				'agents' 			=> $agents,
				'verification' 		=> $this->input->post('verification'),
				'city_id' 			=> $cities,
				'product' 			=> $product,
				'employeement_status'=>$employeement_status,
				'min_loan_amount' =>$min_loan_amount,
				'user_id' 			=> $this->input->post('user_id')
				);
				// Transfering Data To Model
				
				$success = $this->users->add_filter($data);
				// Loading View
					if($success)
					{
						redirect('admin/agency/agency_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}
	
	//To edit filter
	public function edit_filter()
	{
		
		$this->site_data['title'].= 'Edit Filter';

		$this->site_data['main_content'].= 'agency/edit_filter';

		$this->site_data['menu']['agency'] = 1;
		
		$this->site_data['menu']['add_agency'] = 1;
		
		$filter_id = $this->uri->segment(4);
		
		$this->site_data['filter_id'] = $filter_id;
		
		$this->site_data['cities'] = $this->users->get_city();
		$this->site_data['agents'] = $this->users->list_all_agent();
		
		$this->site_data['rows'] = $this->users->get_filter_data($filter_id);
		
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	
	//Update Filter Data
	function update_filter()
	{
		$this->site_data['title'].= 'Edit Filter';
		
		$this->site_data['main_content'].= 'agency/edit_filter';

		$this->site_data['menu']['filter'] = 1;
		
		$this->form_validation->set_rules('FilterName', 'Filter Name', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('min_age', 'Minimum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('max_age', 'Maximum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('income', 'Income', 'required');
		$this->form_validation->set_rules('min_loan_amount', 'min_loan_amount', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){
			
			$filter_id = $this->uri->segment(4);
			
			$this->site_data['filter_id'] = $filter_id;
			
			$this->site_data['cities'] = $this->users->get_city();
			
			$this->site_data['rows'] = $this->users->get_filter_data($filter_id);

			
			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{
				// Setting Values For User Tabel
				$cities = implode(',',$this->input->post('city'));
				$income = $this->input->post('income');
				$product = implode(',',$this->input->post('product'));
				$employeement_status = implode(',',$this->input->post('employeement_status'));
				
				
				$agent = $this->input->post('agents');
				if(empty($agent)){
						$agents = '';
				}else{

						$agents = implode(',',$this->input->post('agents'));

				}
				
				if($this->input->post('disable_filter')=='on'){

					$disable_filter = '1';
					$disable_date = date('Y-m-d');

				}else{
					$disable_filter = '0';
					$disable_date = '';
				}
				
				$date_updated = date('Y-m-d');
				
				$min_loan_amount=$this->input->post('min_loan_amount');
				$data = array(
				'name' 				=> $this->input->post('FilterName'),
				'city_id' 			=> $cities,
				'product' 			=> $product,
				'disable_filter'	=> $disable_filter,
				'disable_date'		=> $disable_date,
				'date_updated'		=> $date_updated,
				'min_age' 			=> $this->input->post('min_age'),
				'max_age' 			=> $this->input->post('max_age'),
				'income' 			=> $income,
				'verification' 		=> $this->input->post('verification'),
				'user_id' 			=> $this->input->post('user_id'),
				'agents' 			=> $agents,
				'employeement_status' => $employeement_status,
				'min_loan_amount' 	=> $min_loan_amount,
				'f_status' 			=> $this->input->post('status'),
				'leads_quantity' 			=> $this->input->post('leads_quantity')
				);
				// Transfering Data To Model
				$filter_id = $this->input->post('filter_id');
				$success = $this->users->update_filter($data, $filter_id);
				// Loading View
					if($success)
					{
						redirect('admin/agency/agency_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}

	
	//display All Filter
	public function filter_list()
	{
			$this->site_data['title'].= 'Filter List';
			
			$this->site_data['main_content'].= 'agency/filter_list';

			$this->site_data['menu']['filter'] = 1;
			
			$this->site_data['menu']['filter_list'] = 1;
						
			$this->site_data['rows'] = $this->users->list_filter();
			
		    $this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//Delete Filter
	public function delete_filter()
	{
			
			$this->site_data['main_content'].= 'agency/filter_list';

			$this->site_data['menu']['agency'] = 1;
			
			$this->site_data['menu']['agency_list'] = 1;
			
			$filter_id = $this->uri->segment(4);
						
			$this->users->delete_filter($filter_id);
						
			redirect('admin/filter/filter_list', 'refresh');
	}
	
	

}