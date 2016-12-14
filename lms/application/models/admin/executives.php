<?php
//Admin Model

Class Executives extends CI_Model{
	
	public function index(){

	}

    //get all leads by executive
	public function get_leads($limit, $start, $userid)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
 
	//pagination leads
	public function leads_count($userid) 
	{
		return $this->db->count_all_results('lms_leads');
		
	}

}