<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Executive extends Admin_Controller {

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
		
		$this->site_data['title'].= 'Add executive';

		$this->site_data['main_content'].= 'executive/add';

		$this->site_data['menu']['executive'] = 1;
		
		$this->site_data['menu']['add_executive'] = 1;
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	function add_executive()
	{
		$this->site_data['title'].= 'Add executive';
		
		$this->site_data['main_content'].= 'executive/add';

		$this->site_data['menu']['executive'] = 1;
		
		$this->site_data['menu']['add_executive'] = 1;

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]|is_unique[lms_users.username]');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|max_length[50]|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){

			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{
		
						$product_str="";
		$litdatat=$this->input->post('product');
		if(!empty($litdatat)){
		$list_product=$this->input->post('product');
		$product_str=implode(',',$list_product);
		}
				// Setting Values For User Tabel
				$image_data = $this->do_upload('image');
				$image = (isset($image_data['file_name'])) ?  $image_data['file_name'] : '';
				$data = array(
				'fullname' 		=> $this->input->post('fullname'),
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'image'			=> $image,
				'role'			=> '4',
				'emp_type'		=> $this->input->post('emp_type'),
				'Product'			=>$product_str,
				'password' 		=> MD5($this->input->post('password'))
				);
				
				// Transfering Data To Model
				$data1=$this->input->post('emp_type');
				
				$success = $this->users->insert_user($data,$data1);
				// Loading View
					if($success)
					{
						redirect('admin/executive/executive_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}
	
	
	public function edit_executive()
	{
		
		$this->site_data['title'].= 'Edit executive';

		$this->site_data['main_content'].= 'executive/edit';

		$this->site_data['menu']['executive'] = 1;
		
		$this->site_data['menu']['add_executive'] = 0;
		
		$user_id = $this->uri->segment(4);
		
		$this->site_data['user_id'] = $user_id;
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		$this->load->view($this->site_data['layout'], $this->site_data);

	}
	
	//Update User Data
	function update_executive()
	{
		$this->site_data['title'].= 'Edit executive';
		
		$this->site_data['main_content'].= 'executive/edit';

		$this->site_data['menu']['executive'] = 1;
		
		$this->site_data['menu']['add_executive'] = 0;

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|xss_clean|max_length[50]|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');

		if($this->form_validation->run() == FALSE){
			
			$user_id = $this->uri->segment(4);
			
			$this->site_data['user_id'] = $user_id;
		
			$this->site_data['rows'] = $this->users->get_user_data($user_id);
			
			$this->load->view($this->site_data['layout'], $this->site_data);
		
		}
		else
		{
		
				$product_str="";
		$litdatat=$this->input->post('product');
		if(!empty($litdatat)){
		$list_product=$this->input->post('product');
		$product_str=implode(',',$list_product);
		}
				// Setting Values For User Tabel
				$image_data = $this->do_upload('image');
				$image = (isset($image_data['file_name'])) ?  $image_data['file_name'] : '';
				$profile_img = $image;
				$data = array(
				'fullname' 		=> $this->input->post('fullname'),
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'emp_type'		=> $this->input->post('emp_type'),
				'Product'		=>$product_str,
				'active' 		=> $this->input->post('status')
				);
				
				// Transfering Data To Model
				$id = $this->input->post('user_id');
				$password = $this->input->post('password');
				$status=$this->input->post('status');
				$success = $this->users->update_user($data, $id, $password, $profile_img,$status);
				// Loading View
					if($success)
					{
						redirect('admin/executive/executive_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}
	}

	public function executive_list()
	{
			$this->site_data['title'].= 'executive List';
			
			$this->site_data['main_content'].= 'executive/executive_list';

			$this->site_data['menu']['executive'] = 1;
			
			$this->site_data['menu']['executive_list'] = 1;
			
			$config = array();
			$config["base_url"] = base_url() . "index.php/admin/executive/executive_list/index";
			$config["total_rows"] = $this->users->record_count(4);
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
	 
			$this->pagination->initialize($config);
	 
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->site_data['rows'] = $this->users->list_executive($config["per_page"], $page);
			$this->site_data['links'] = $this->pagination->create_links();
						
			$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//Search User List
	public function search_executive_list()
	{
			$this->site_data['title'].= 'executive List';
			
			$this->site_data['main_content'].= 'executive/executive_list';

			$this->site_data['menu']['executive'] = 1;
			
			$this->site_data['menu']['executive_list'] = 1;
			
			$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|max_length[50]');
			$this->form_validation->set_rules('executive', 'executive Name', 'trim|xss_clean|max_length[100]');
			$this->form_validation->set_rules('executive_email', 'Email Address', 'trim|xss_clean|max_length[100]');
			$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');
			if($this->form_validation->run() == FALSE){
			
				redirect('admin/executive/executive_list', 'refresh');
			
			}
			else
			{
					 
				
					$executive = $this->input->post('executive');
					$username = $this->input->post('username');
					$email_id = $this->input->post('executive_email');
					
					if(($executive == '') && ($username == '') && ($email_id == ''))
					{
						redirect('admin/executive/executive_list', 'refresh');
					}
					else
					{
						$this->site_data['executive'] = $executive;
						$this->site_data['username'] = $username;
						$this->site_data['email_id'] = $email_id;
						
						$config = array();
						$config["base_url"] = base_url() . "index.php/admin/executive/search_executive_list";
						$config["total_rows"] = $this->users->search_executive_result_count($executive, $username, $email_id);
						$config["per_page"] = 20;
						$config["uri_segment"] = 4;
				 
						$this->pagination->initialize($config);
				 
						$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
						$this->site_data['rows'] = $this->users->search_executive($executive, $username, $email_id, $config["per_page"], $page);
						$this->site_data['links'] = $this->pagination->create_links();
									
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
	
			}
	}
	
	//Delete User
	public function delete_executive()
	{
			
			$this->site_data['menu']['executive'] = 1;
			
			$this->site_data['menu']['executive_list'] = 0;
			
			$user_id = $this->uri->segment(4);
						
			$this->users->delete_user($user_id);
						
			redirect('admin/executive/executive_list', 'refresh');
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
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
/*Layout: $this->site_data['main_content'] = 'admin/templates/common/users'; */
