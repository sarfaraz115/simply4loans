<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin/users', '', TRUE);
		$this->load->helper("url");
        $this->load->library("pagination");
        $this->load->library('encrypt');
		
	}

	public function index(){

	}

	public function add(){
		
		$this->site_data['title'].= 'Add User';

		$this->site_data['main_content'].= 'user/add';

		$this->site_data['menu']['user'] = 1;
		
		$this->site_data['menu']['add_user'] = 1;
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	function add_user()
	{
		$this->site_data['title'].= 'Add User';
		
		$this->site_data['main_content'].= 'user/add';

		$this->site_data['menu']['user'] = 1;
		
		$this->site_data['menu']['add_user'] = 1;

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|max_length[100]|is_unique[lms_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|max_length[50]|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){

			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{
				// Setting Values For User Tabel
				//$key = 'my-secret-key';
				$data = array(
				'fullname' 		=> $this->input->post('fullname'),
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> MD5($this->input->post('password'))
				);
				
				// Transfering Data To Model
				
				$success = $this->users->insert_user($data);
				// Loading View
					if($success)
					{
						redirect('admin/user/user_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}
	
	
	public function edit_user()
	{
		
		$this->site_data['title'].= 'Edit User';

		$this->site_data['main_content'].= 'user/edit';

		$this->site_data['menu']['user'] = 1;
		
		$this->site_data['menu']['add_user'] = 1;
		
		$user_id = $this->uri->segment(4);
		
		$this->site_data['user_id'] = $user_id;
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		//$password = $this->site_data['rows']->password;
		
		//$key = 'my-secret-key';
		
		//$this->site_data['pass'] = $this->encrypt->decode($password, $key);
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	//Update User Data
	function update_user()
	{
		$this->site_data['title'].= 'Edit User';
		
		$this->site_data['main_content'].= 'user/edit';

		$this->site_data['menu']['user'] = 1;
		
		$this->site_data['menu']['add_user'] = 1;

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|max_length[50]|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){
			
			$user_id = $this->uri->segment(4);
			
			$this->site_data['user_id'] = $user_id;
		
			$this->site_data['rows'] = $this->users->get_user_data($user_id);
			
			//$password = $this->site_data['rows']->password;
		
			//$key = 'my-secret-key';
		
			//$this->site_data['pass'] = $this->encrypt->decode($password, $key);

			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{
				// Setting Values For User Tabel
				//$key = 'my-secret-key';
				$data = array(
				'fullname' 		=> $this->input->post('fullname'),
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> MD5($this->input->post('password')),
				'active' 		=> $this->input->post('status')
				);
				
				// Transfering Data To Model
				$id = $this->input->post('user_id');
				$success = $this->users->update_user($data, $id);
				// Loading View
					if($success)
					{
						redirect('admin/user/user_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}

	public function user_list()
	{
			$this->site_data['title'].= 'User List';
			
			$this->site_data['main_content'].= 'user/user_list';

			$this->site_data['menu']['user'] = 1;
			
			$this->site_data['menu']['user_list'] = 1;
			
			$config = array();
			$config["base_url"] = base_url() . "index.php/admin/user/user_list/index";
			$config["total_rows"] = $this->users->record_count();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
	 
			$this->pagination->initialize($config);
	 
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->site_data['rows'] = $this->users->list_user($config["per_page"], $page);
			$this->site_data['links'] = $this->pagination->create_links();
						
			$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//Search User List
	public function search_user_list()
	{
			$this->site_data['title'].= 'User List';
			
			$this->site_data['main_content'].= 'user/user_list';

			$this->site_data['menu']['user'] = 1;
			
			$this->site_data['menu']['user_list'] = 1;
			
			$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|max_length[50]');
			$this->form_validation->set_rules('agency', 'Agency Name', 'trim|xss_clean|max_length[100]');
			$this->form_validation->set_rules('agency_email', 'Email Address', 'trim|xss_clean|max_length[100]');
			$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');
			if($this->form_validation->run() == FALSE){
			
				redirect('admin/user/user_list', 'refresh');
			
			}
			else
			{
					$agency = $this->input->post('agency');
					$username = $this->input->post('username');
					$email_id = $this->input->post('agency_email');
					if(($agency == '') && ($username == '') && ($email_id == ''))
					{
						redirect('admin/user/user_list', 'refresh');
					}
					else
					{
						$config = array();
						$config["base_url"] = base_url() . "index.php/admin/user/search_user_list";
						$config["total_rows"] = $this->users->search_result_count($agency, $username, $email_id);
						$config["per_page"] = 30;
						$config["uri_segment"] = 4;
				 
						$this->pagination->initialize($config);
				 
						$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
						$this->site_data['rows'] = $this->users->search_list($agency, $username, $email_id, $config["per_page"], $page);
						$this->site_data['links'] = $this->pagination->create_links();
									
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
	
			}
	}
	
	//Delete User
	public function delete_user()
	{
			
			$this->site_data['menu']['user'] = 1;
			
			$this->site_data['menu']['user_list'] = 1;
			
			$user_id = $this->uri->segment(4);
						
			$this->users->delete_user($user_id);
						
			redirect('admin/user/user_list', 'refresh');
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
/*Layout: $this->site_data['main_content'] = 'admin/templates/common/users'; */
