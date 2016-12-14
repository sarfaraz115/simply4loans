<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public $site_data = array(
		
		'title' 		=> 'Login',
		
		'name' 			=> 'Lead Management System',
		
		'main_content' 	=> 'login',
		
		);


	function __construct(){

		parent::__construct();

		$this->logged_in();
		$this->clear_cache();

		$this->load->library('form_validation');
		$this->load->model('admin/users', '', TRUE);

	}

	//To clear cache on controller load
	function clear_cache(){

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

	}

	function logged_in(){

		if($this->session->userdata('logged_data')){

			$logged_data = $this->session->userdata('logged_data');

			if($logged_data['role'] == 1){ //redirect
				redirect('admin/home','refresh');	
			}elseif($logged_data['role'] == 2){
				redirect('agency/home','refresh');
			}elseif($logged_data['role'] == 3){
				redirect('agent/agent_home','refresh');
			}elseif($logged_data['role'] == 4){
				redirect('executive/executive_home','refresh');
			}
			
		}

	}

	public function index(){
		
		$this->load->view($this->site_data['main_content'], $this->site_data);
		
	}

	function verify_login(){

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');
		
		if($this->form_validation->run() == FALSE){

			$this->load->view($this->site_data['main_content'], $this->site_data);
		
		}
		else{

			$logged_data = $this->session->userdata('logged_data');
			
			if($logged_data['role'] == 1){ //redirect
				redirect('admin/home','refresh');	
			}elseif($logged_data['role'] == 2){
				redirect('agency/home','refresh');
			}elseif($logged_data['role'] == 3){
				redirect('agent/agent_home','refresh');
			}elseif($logged_data['role'] == 4){
				redirect('executive/executive_home','refresh');
			}
		}

	}

	function check_database($password){

		$username = $this->input->post('username');
		$result = $this->users->login($username, $password);

		if($result){
			$sess_array = array();
			foreach($result as $row){

				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username,
					'name' => $row->fullname,
					'role' => $row->role,
					'image' => $row->image,
					'created' => $row->created,
					);
				$this->session->set_userdata('logged_data', $sess_array);
			}
			return TRUE;

		}else{

			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;

		}

	}
	
	//All Below code for forgot password
	public function recover_password()
	{
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

        //check if email is in the database
        $this->load->model('model_users');
        if($this->model_users->email_exists())
        {
			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_timeout' => 30,
			  'smtp_user' => 'dipankarbarman714@gmail.com', // change it to yours
			  'smtp_pass' => 'dipankarggs93!', // change it to yours
			  'mailtype' => 'html',
			  'charset'   => 'iso-8859-1',
			  'wordwrap' => TRUE
			  );
            //$them_pass is the varible to be sent to the user's email 
            $temp_pass = md5(uniqid());
            //send email with #temp_pass as a link
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('dipankarbarman714@gmail.com');
            $this->email->to($this->input->post('email'));
            $this->email->subject("Reset your Password");

            $message = "<p>This email has been sent as a request to reset our password</p>";
            $message .= "<p><a href='".base_url()."index.php/login/reset_password/".$temp_pass."'>Click here </a>if you want to reset your password, if not, then ignore</p>";
            $this->email->message($message);

            if($this->email->send())
            {
                $this->load->model('model_users');
                if($this->model_users->temp_reset_password($temp_pass))
                {
					$this->site_data['title'] = 'Reset Password';
		
					$this->site_data['main_content'] = 'user_msg';
					
					$this->site_data['user_msg'] = "Please Check your email for instructions, Thank you.";
					
					$this->load->view($this->site_data['main_content'], $this->site_data);
					
                }
            }
            else
            {
				$this->site_data['title'] = 'Reset Password';
		
				$this->site_data['main_content'] = 'user_msg';
					
				$this->site_data['user_msg'] = "email was not sent, please contact your administrator";
					
				$this->load->view($this->site_data['main_content'], $this->site_data);
                
                show_error($this->email->print_debugger());
            }

        }
        else
        {
			$this->site_data['title'] = 'Reset Password';
		
			$this->site_data['main_content'] = 'user_msg';
					
			$this->site_data['user_msg'] = "your email is not in our database";
					
			$this->load->view($this->site_data['main_content'], $this->site_data);
			
        }
	}
	public function reset_password($temp_pass)
	{
		$this->load->model('model_users');
		$this->site_data['tmp_pass'] = $temp_pass;
		$this->site_data['rows'] = $this->model_users->is_temp_pass_valid($temp_pass);
		$result = $this->site_data['rows'];
		if(!empty($result))
		{
			$this->site_data['title']= 'Change Password';
		
			$this->site_data['main_content']= 'reset_password';

			$this->load->view($this->site_data['main_content'], $this->site_data);

		}
		else
		{
			$this->site_data['title'] = 'Reset Password';
		
			$this->site_data['main_content'] = 'user_msg';
					
			$this->site_data['user_msg'] = "The key is not valid.";
					
			$this->load->view($this->site_data['main_content'], $this->site_data);
			
		}

	}
	public function update_password()
	{
			$this->site_data['title'] = 'Reset Password';
		
			$this->site_data['main_content']= 'reset_password';
			
			
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
			$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');
			if($this->form_validation->run() == FALSE)
			{
				$temp_pass = $this->uri->segment(3);
				redirect('login/reset_password/'.$temp_pass, 'refresh');
				//$this->load->view($this->site_data['layout'], $this->site_data);
				
				
			}
			else
			{
				// Transfering Data To Model
				$pass = MD5($this->input->post('password'));
				$u_id = $this->input->post('user_id');
				$success = $this->users->reset_password($pass, $u_id);
				// Loading View
				if($success)
				{
					$this->site_data['title'] = 'Password Changed';
		
					$this->site_data['main_content'] = 'user_msg';
							
					$this->site_data['user_msg'] = "Your Password is Reset. Please Log In.";
							
					$this->load->view($this->site_data['main_content'], $this->site_data);
					
					//redirect('login', 'refresh');
				}
				else
				{
					$this->load->view($this->site_data['layout'], $this->site_data);
				}
			}
	}	

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
/*Layout: $this->site_data['main_content'] = 'admin/templates/common/home'; */
