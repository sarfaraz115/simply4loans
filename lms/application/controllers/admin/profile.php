<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Admin_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('admin/users', '', TRUE);
		$this->load->helper("url");
        $this->load->library("pagination");
		$this->load->library('form_validation');
		
	}
	//for view profile data
	public function index()
	{
		$this->site_data['title'].= 'Profile';
		
		$this->site_data['main_content'].= 'admin/view_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
		$logged_data = $this->session->userdata('logged_data');
			
		$user_id = $logged_data['id'];
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//for update profile data
	public function edit_profile()
	{
		$this->site_data['title'].= 'Update Profile';
		
		$this->site_data['main_content'].= 'admin/edit_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
		$logged_data = $this->session->userdata('logged_data');
			
		$user_id = $logged_data['id'];
		
		$this->site_data['rows'] = $this->users->get_user_data($user_id);
		
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	//Update User Data
	function update_profile_data()
	{
		$this->site_data['title'].= 'Update Info';
		
		$this->site_data['main_content'].= 'admin/edit_profile';

		$this->site_data['menu']['dashboard'] = 0;
		
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
						redirect('admin/profile', 'refresh');
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
}
