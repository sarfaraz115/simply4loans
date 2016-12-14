<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_Home extends Agent_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('admin/agents', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);
		$this->load->model('admin/users', '', TRUE);
		$this->load->helper("url");
		$this->load->library("pagination");
		$this->load->library('form_validation');
		$this->load->model('admin/csv_model', '', TRUE);
		$this->load->library('csvimport');
	}

	public function index(){

		$this->site_data['title'].= 'Dashboard';
		
		$this->site_data['main_content'].= 'agent/home';

		$this->site_data['menu']['dashboard'] = 1;
		
		$this->site_data['menu']['agent'] = 0;

		$logged_data = $this->session->userdata('logged_data');
		
		$user_id = $logged_data['id'];

		$this->load->view($this->site_data['layout'], $this->site_data);



	}

	public function show_leads(){
			
		$this->site_data['title'].= 'Dashboard';
		
		$this->site_data['main_content'].= 'agent/leads';

		$this->site_data['menu']['dashboard'] = 1;
		
		$this->site_data['menu']['agency'] = 0;
		
		$logged_data = $this->session->userdata('logged_data');
		
		$user_id = $logged_data['id'];
		
		$today = date('Y-m-d');
		$start_date = '';
		$end_date = '';
		$limit = 20;

		if($this->input->get('from')){

			$start_date = $this->input->get('from')." 00:00:00";
		}

		if($this->input->get('to')){

			$end_date = $this->input->get('to')." 23:59:59";
		}
			
		$config = array();
		$config["base_url"] = base_url("index.php/agent/agent_home/show_leads/");
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$results = $this->leads->get_agent_leads($limit, $page, $user_id, $start_date, $end_date);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 4;
		$config["total_rows"] =  $this->leads->count_agent_all_leads($user_id, $start_date, $end_date);
	 
		$this->pagination->initialize($config);
	 
		$this->site_data['rows'] = $results->result_array();
		$this->site_data['start_date'] = $start_date;
		$this->site_data['end_date'] = $end_date;
		
		$this->site_data['links'] = $this->pagination->create_links();
		$this->site_data['pagination'] = $this->pagination;
		
		$this->load->view($this->site_data['layout'], $this->site_data);
		
	}
	
	//for view profile data
	public function view_profile()
	{
		$this->site_data['title'].= 'Profile';
		
		$this->site_data['main_content'].= 'agent/view_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
		$this->site_data['menu']['profile'] = 1;
		
		$logged_data = $this->session->userdata('logged_data');

		$user_id = $logged_data['id'];
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//for update profile data
	public function edit_profile()
	{
		$this->site_data['title'].= 'Update Profile';
		
		$this->site_data['main_content'].= 'agent/edit_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
		$this->site_data['menu']['profile'] = 1;
		
		$logged_data = $this->session->userdata('logged_data');

		$user_id = $logged_data['id'];
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//Update User Data
	function update_profile_data()
	{
		$this->site_data['title'].= 'Update Profile';
		
		$this->site_data['main_content'].= 'agent/edit_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
		$this->site_data['menu']['profile'] = 1;
		
		$logged_data = $this->session->userdata('logged_data');

		$user_id = $logged_data['id'];
		
		$user_data = $this->users->get_user_data($user_id);

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|xss_clean|max_length[50]|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){
			
			$logged_data = $this->session->userdata('logged_data');
			
			$user_id = $logged_data['id'];

			$this->site_data['rows'] = $this->users->get_user_data($user_id);
			
			$this->load->view($this->site_data['layout'], $this->site_data);

		}
		else
		{
				// Setting Values For User Tabel
			$image_data = $this->do_upload('image');
			$image = (isset($image_data['file_name'])) ?  $image_data['file_name'] : $user_data->image;
			$profile_img = $image;
			$data = array(
				'fullname' 		=> $this->input->post('fullname'),
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'active' 		=> $this->input->post('status')
				);

				// Transfering Data To Model
			$id = $this->input->post('user_id');
			$password = $this->input->post('password');
			$success = $this->users->update_profile_data($data, $id, $password, $profile_img);
				// Loading View
			if($success)
			{
				redirect('agent/agent_home/view_profile', 'refresh');
			}
			else
			{
				$this->load->view($this->site_data['layout'], $this->site_data);
			}
		}
	}
	
	//to upload image
	private function do_upload($field_name)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']	= TRUE;
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($field_name))
		{
			$data = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data =  $this->upload->data();


		}
		return $data;
	}

	public function upload_csv(){
		$this->site_data['title'].= 'Upload Excel';

		$this->site_data['main_content'].= 'agent/csvindex';

		$this->site_data['menu']['agent'] = 1;
		
		$this->site_data['menu']['add_agent'] = 1;
		
		//$this->site_data['addressbook'] = $this->csv_model->get_addressbook();
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}

	public function importcsv()
	{		
		if (!$this->do_upload_csv('userfile'))
		{	
			$this->site_data['error'] = $this->upload->display_errors();
			
			$this->site_data['title'].= 'Upload Excel';

			$this->site_data['main_content'].= 'agent/csvindex';

			$this->site_data['menu']['agent'] = 1;

			$this->site_data['menu']['add_agent'] = 1;

			$this->load->view($this->site_data['layout'], $this->site_data);
			
		}
		else
		{	
			$file_data = $this->upload->data();
			$file_path = $file_data['full_path'];
			
			
			if($this->csvimport->get_array($file_path))
			{
				$logged_data = $this->session->userdata('logged_data');

				$user_id = $logged_data['id'];
				$csv_array = $this->csvimport->get_array($file_path); 
				
				foreach($csv_array as $row)
				{	
					
					if(isset($row['Application_Date'])){
						$appdatearray = explode('/', $row['Application_Date']);
						$Application_Date = $appdatearray['2'].'-'.$appdatearray['0'].'-'.$appdatearray['1'];

					}else{
						$Application_Date = date('Y-m-d');	
					}

					if(isset($row['PostDate'])){
						$PostDate = $row['PostDate'];
					
					}else{
						$PostDate = date('Y-m-d');	
					}

					if(isset($row['Pin_No'])){
						$Pin_No = $row['Pin_No'];
					}else{
						$Pin_No = '';
					}
					

					if(isset($row['Sum_Assured'])){
						$Sum_Assured = $row['Sum_Assured'];
					}else{
						$Sum_Assured = '';
					}
					if(isset($row['IP_Address'])){
						$IP_Address = $row['IP_Address'];
					}else{
						$IP_Address = '';
					}

					if(isset($row['Campaign_Name'])){
						$Campaign_Name = $row['Campaign_Name'];
					}else{
						$Campaign_Name = '';
					}

					$test = $this->users->unique_leads($row['Insurance_Product'], $row['Contact_No'], $Application_Date, $user_id); //csv import condition 
					
					//echo $test; die;
					if(!$test){
						$dobarray = explode('/', $row['DOB']);
						$dob = $dobarray['2'].'-'.$dobarray['0'].'-'.$dobarray['1'];
						$insert_data = array(
						'insurance_product' 	=> $row['Insurance_Product'],
						'Name' 					=> $row['Name'],
						'DOB' 					=> $dob,
						'Gender' 				=> $row['Gender'],
						'Annual_Income' 		=> $row['Annual_Income'],
						'Email_ID' 				=> $row['Email_ID'],
						'City' 					=> $row['City'],
						'PinNo' 				=> $Pin_No,
						'ContactNo' 			=> $row['Contact_No'],
						'insurance_company' 	=> $row['Insurance_Company'],
						'SumAssured' 			=> $Sum_Assured,
						'Application_Date' 		=> $Application_Date,
						'PostDate' 				=> $PostDate,
						'IP_Address' 			=> $IP_Address,
						'agent' 				=> $user_id,
						'campaign_name' 		=> $Campaign_Name,
						'verification' 			=> $row['Verification']
						
						);

						$this->csv_model->insert_csv($insert_data);
					}

					
				}
				unlink($file_path);
				$this->session->set_flashdata('success', 'The data is imported successfully');
				redirect('agent/agent_home/show_leads', 'refresh');
			}
			else
			{
				$this->site_data['error'] = "Error Occoured";
				$this->site_data['title'].= 'Upload Excel';

				$this->site_data['main_content'].= 'agent/csvindex';

				$this->site_data['menu']['agent'] = 1;

				$this->site_data['menu']['add_agent'] = 1;

				$this->load->view($this->site_data['layout'], $this->site_data);
				
			}
		}
	}

	public function export_csv(){
		
		
		$logged_data = $this->session->userdata('logged_data');
		
		$user_id = $logged_data['id'];
		$start_date = '';
		$end_date = '';
		$today = date('Y-m-d');
	
		if($this->input->get('from')){

			$start_date = $this->input->get('from')." 00:00:00";
		}

		if($this->input->get('to')){

			$end_date = $this->input->get('to')." 23:59:59";
		}
		$results = $this->leads->export_agent_data($start_date, $end_date,$user_id);
		$resultdata = $results->result_array();
		//=========================Export to csv with Repush====================
		
		
		$this->load->library('excel');
		
		$this->excel->to_excel($resultdata, 'brands-excel_'.$user_id); 
			
		return TRUE;

	}
	
	public function do_upload_csv($field_name)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';

		$config['max_size']      = '4096';
		

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name))
		{
			
			$data = array('error' => $this->upload->display_errors());
			print_r($data);
		}
		else
		{
			$data =  $this->upload->data();


		}
		return $data;
	}


}

/* End of file home.php */
/* Location: ./application/controllers/admin/agent_home.php */
/*Layout: $this->site_data['main_content'] = 'admin/templates/common/agent_home'; */