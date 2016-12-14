<?php
//Admin Model

Class Csv_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		
		
	}
	
	public function get_addressbook()
	{
		$query = $this->db->get('lms_leads');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}
	
	Public function insert_csv($data)
	{
		$this->db->insert('lms_leads', $data);
	}
}
