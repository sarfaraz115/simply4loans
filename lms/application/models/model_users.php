<?php
//Admin Model

Class Model_users extends CI_Model{
	
	public function index(){

	}

	public function email_exists()
	{
		$email = $this->input->post('email');
		$query = $this->db->query("SELECT email, password FROM lms_users WHERE email='$email'");    
		if($row = $query->row())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function temp_reset_password($temp_pass)
	{
		$data =array('email' =>$this->input->post('email'),
					'reset_pass'=>$temp_pass);
					$email = $data['email'];

		if($data)
		{
			$this->db->where('email', $email);
			$this->db->update('lms_users', $data);  
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	public function is_temp_pass_valid($temp_pass)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('reset_pass', $temp_pass);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else 
		{
			return FALSE;
		}
	}
	
}      

