<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Public_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);
		$this->load->helper("url");
        $this->load->library("pagination");
		$this->load->library('form_validation');
	}

	public function index(){
		
		$this->site_data['title'].= 'Dashboard';
		
		$this->site_data['main_content'].= 'agency/leads';

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
		$config["base_url"] = base_url("index.php/agency/home/index/");
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$config["per_page"] = $limit;
		$config["uri_segment"] = 4;
		
		$results = $this->leads->get_agency_leads($limit, $page, $start_date, $end_date, $user_id);
		$config["total_rows"] =  $this->leads->count_agency_leads($start_date, $end_date, $user_id);
		$this->site_data['rows'] = $results->result_array();
		
		$this->pagination->initialize($config);
		
		$this->site_data['start_date'] = $start_date;
		$this->site_data['end_date'] = $end_date;
		
		$this->site_data['links'] = $this->pagination->create_links();
		$this->site_data['pagination'] = $this->pagination;
		
		$this->load->view($this->site_data['layout'], $this->site_data);
		

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
		$results = $this->leads->export_agency_data($start_date, $end_date,$user_id);
		$resultdata = $results->result_array();
		
		$this->load->library('excel');
		
		$this->excel->to_excel($resultdata, 'brands-excel_'.$user_id); 
			
		return TRUE;

	}
	
	
	//for view profile data
	public function view_profile()
	{
		$this->site_data['title'].= 'Profile';
		
		$this->site_data['main_content'].= 'agency/view_profile';

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
		
		$this->site_data['main_content'].= 'agency/edit_profile';

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
		
		$this->site_data['main_content'].= 'agency/edit_profile';

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
						redirect('agency/home/view_profile', 'refresh');
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


}
