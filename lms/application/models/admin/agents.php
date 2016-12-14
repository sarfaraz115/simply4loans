<?php
//Admin Model

Class Agents extends CI_Model{
	
	public function index(){

	}

    //get all leads by agent
	public function get_leads($limit, $start, $userid)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$this->db->where('agent =', $userid);
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
	
 /*   //get all leads
	public function get_leads_by_date($limit, $start, $userid)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$this->db->where('agent =', $userid);
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
	}*/

	public function get_leads_by_date($limit, $start, $start_date, $end_date, $userid)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$this->db->where('agent =', $userid);
		
		if($start_date){
		$this->db->where('lms_leads.PostDate >=', $start_date);
		}
		if($end_date){
			$this->db->where('lms_leads.PostDate <=', $end_date);
		}
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
		$this->db->where('agent =', $userid);
		return $this->db->count_all_results('lms_leads');
		
	}

}