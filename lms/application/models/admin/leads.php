<?php
	//Admin Model

	Class Leads extends CI_Model{
		
		public function index(){

		}

		#Agency Functions Start

		public function export_agency_data($start_date, $end_date, $agency){

$this->db->select('l.ID as UID,l.insurance_product as Product_Name, l.Name as Name, l.DOB as DOB, l.Email_ID as Email_ID, l.ContactNo as Contact_No, l.Annual_Income, l.City, date(r.allocated_time) as Application_date');
			$this->db->from('lms_leads l');
			$this->db->join('lms_leads_relations r', 'l.ID = r.lead_id','left');
			$this->db->where('r.agency_id =', $agency);
			
			if($start_date){
				$where="r.allocated_time >='".$start_date."'";	
			}
			if($end_date){
				$where.=" AND r.allocated_time <='".$end_date."'";
				
			}

			if($start_date){
			$this->db->where($where);
			}
			$result = $this->db->get();
			 $this->db->last_query();
			
			return $result;
			

		}


		#Agency Functions Start

		public function export_agent_data($start_date, $end_date, $agent){

			//$this->db->select('lms_leads.ID as UID,lms_leads.insurance_product as Insurance_Product,lms_leads.Name, lms_leads.verification as Verification,lms_leads.Annual_Income as Annual_Income,lms_leads.Email_ID as Email_ID,lms_leads.City, lms_leads.Other_City as OtherCity, lms_leads.ContactNo as Contact_No, rfeedback.Feedback as Feedback, rfeedback.not_contactable_counter as CallAttempts');
						$this->db->select('lms_leads.ID as UID,lms_leads.insurance_product as Insurance_Product,lms_leads.ContactNo as Contact_No,lms_leads.DOB as DOB ,lms_leads.City, lms_leads.Other_City as OtherCity,  rfeedback.pub_feedback as Feedback, rfeedback.not_contactable_counter as CallAttempts');

			
			$this->db->select("DATE_FORMAT(lms_leads.DOB, '%m/%d/%Y') as DOB", FALSE);
			$this->db->select("DATE_FORMAT(lms_leads.Application_Date, '%m/%d/%Y') as Application_Date", FALSE);
			//$this->db->select("lms_leads.PostDate as PostDate");

			$this->db->from('lms_leads');
			$this->db->join('rfeedback', 'rfeedback.AllRequestID = lms_leads.ID','left');
			$this->db->where('lms_leads.agent =', $agent);

			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
				
			}
			$this->db->order_by('lms_leads.PostDate', 'DESC');

			$result = $this->db->get();
			 $this->db->last_query();
			
			return $result;
			

		}

		public function get_agency_leads($limit, $start, $start_date, $end_date,$agency){
			$this->db->select('l.insurance_product, l.ID, l.Name, l.DOB, l.Email_ID, l.ContactNo, l.Annual_Income, l.City, r.allocated_time');
			$this->db->from('lms_leads l');
			$this->db->join('lms_leads_relations r', 'l.ID = r.lead_id','left');
			$this->db->where('r.agency_id =', $agency);
			$this->db->order_by('r.allocated_time', 'DESC');
			if($start_date){
				$where="r.allocated_time >='".$start_date."'";	
			}
			if($end_date){
				$where.=" AND r.allocated_time <='".$end_date."'";	
			}
					
			if($start_date){
			$this->db->where($where);
			}

			$this->db->limit($limit, $start);
			$result = $this->db->get();
			$this->db->last_query();
			return $result;
			

		}

		public function count_agency_leads($start_date, $end_date,$agency){

			$this->db->select('l.insurance_product, l.ID, l.Name, l.DOB, l.Email_ID, l.ContactNo, l.Annual_Income, l.City, r.allocated_time');
			$this->db->from('lms_leads l');
			$this->db->join('lms_leads_relations r', 'l.ID = r.lead_id','left');
			$this->db->where('r.agency_id =', $agency);
			$this->db->order_by('r.allocated_time', 'DESC');
			if($start_date){
				$where="r.allocated_time >='".$start_date."'";	
			}
			if($end_date){
				$where.=" AND r.allocated_time <='".$end_date."'";	
			}
					
			if($start_date){
			$this->db->where($where);
			}

			$result = $this->db->get();
			$this->db->last_query();
			return $result->num_rows();

		}

		# Agency functions end		

		# Admin functions Start

	    //get all leads
		public function get_leads($limit, $start, $start_date, $end_date)
		{
			$this->db->select('lms_leads.*,lms_users.fullname');
			$this->db->from('lms_leads');
			
			$this->db->join('lms_users', 'lms_users.id = lms_leads.agent','left');
			
			$this->db->join('rfeedback', 'rfeedback.AllRequestID = lms_leads.ID','left');
			
			$session_data = 	$this->session->all_userdata('logged_data');
			$user_id = $session_data['logged_data']['id'];
			if($user_id==1){
				$this->db->select('lms_leads.IP_Address as IP');
				$this->db->select('lms_leads.Source as Source');
			
			}	

			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
//				$this->db->where('lms_leads.updated_date >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
//				$this->db->where('lms_leads.updated_date <=', $end_date);
			}
//			'lms_leads.DOB >= "'.$max_age.'" AND lms_leads.DOB <="'.$min_age.'"'
//$this->db->where(' ( (lms_leads.PostDate >="'.$start_date.'" and lms_leads.PostDate <="'.$end_date.'" ))');
		

			$this->db->order_by('lms_leads.PostDate', 'DESC');

			$this->db->limit($limit, $start);
	

			$result = $this->db->get();
			return $result;
		}
	    //get all leads
		public function get_cron_data($agency)
		{
			$today	= date('Y-m-d')." 00:00:00";
			//$today = "2015-06-12 00:00:00";
			$this->db->select('lms_leads.*');

			$this->db->from('lms_leads_relations');
			$this->db->join('lms_leads', 'lms_leads.ID = lms_leads_relations.lead_id','left');
			$this->db->where('lms_leads_relations.agency_id =', $agency);

			$this->db->where('lms_leads_relations.cron_status =', '0');
//			$this->db->where('lms_leads.Application_Date >=', $today); // Changed by Upendra 13-06-15 for taking leads as allocated date/time 
			$this->db->where('lms_leads_relations.allocated_time >=', $today);
			
			$result = $this->db->get();
			return $result;
			
		}
//select * from lms_leads left join lms_leads_relations on lms_leads.ID = lms_leads_relations.lead_id where lms_leads_relations.agency_id =8 and lms_leads_relations.cron_status =0 and lms_leads_relations.allocated_time >= '2015-06-1'

	    //get all leads
		public function get_relations_leads($city, $product, $income, $min_age, $max_age, $start_date,$end_date,$verification,$agents)
		{
			$this->db->select('lms_leads.*,lms_users.fullname');
			$this->db->from('lms_leads');
			$this->db->join('lms_users', 'lms_users.id = lms_leads.agent','left');

			if($city){
				$cities = explode(',',$city); 
				$citycond = ''; 
				
				foreach($cities as $key=>$value){
					$citycond .="FIND_IN_SET('$value',lms_leads.City) !=0 OR ";
				}
				
				$citycond  = substr($citycond, 0, -3);
				$this->db->where('('.$citycond.')');
			}

			if($product){
				$products = explode(',',$product); 
				$productcond = ''; 
			
				foreach($products as $key=>$value){
					$productcond .="FIND_IN_SET('$value',lms_leads.insurance_product) !=0 OR ";
				}
			
				$productcond  = substr($productcond, 0, -3);
				$this->db->where('('.$productcond.')');
			}
			if($income){
				$incomes = explode(',',$income); 
				$incomecond = ''; 
				
				foreach($incomes as $key=>$value){
					$incomecond .="lms_leads.Annual_Income='".$value."' OR ";
				}
				
				$incomecond  = substr($incomecond, 0, -3);
				$this->db->where('('.$incomecond.')');
			
			}
			if($agents){
				$agent = explode(',',$agents); 
				$agentcond = ''; 
				
				foreach($agent as $key=>$value){
					$agentcond .="FIND_IN_SET('$value',lms_leads.agent) !=0 OR ";
				}
				
				$agentcond  = substr($agentcond, 0, -3);
				$this->db->where('('.$agentcond.')');
			}
			
			if($min_age!='' && $max_age!='') {
				 $this->db->where('lms_leads.DOB >= "'.$max_age.'" AND lms_leads.DOB <="'.$min_age.'"');
			}

		 	if($min_age=='' && $max_age!=''){
				$this->db->where('lms_leads.DOB >= "'.$max_age.'"');
			}
			if($max_age==''&&$min_age!=''){
				$this->db->where('lms_leads.DOB <= "'.$min_age.'"');
			}

			$this->db->order_by('lms_leads.PostDate', 'desc');
			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
				
			}
			
			if($verification!='GEN' && $verification!=''){

				$this->db->where('lms_leads.verification =', $verification);
			}

			$result = $this->db->get();
			return $result;
			
		}

		public function update_relations_leads($lead_id,$agency_id){

			$this->db->select('lms_leads_relations.*');
			$this->db->from('lms_leads_relations');
			$this->db->where('lms_leads_relations.lead_id =', $lead_id);
			$this->db->where('lms_leads_relations.agency_id =', $agency_id);
			$result = $this->db->get();
			$rows = $result->num_rows();
			if($rows==0){
			 $PostDate = date("Y-m-d h:i:s"); // Added by Upendra 02-06-15 for inserting date
				$data=array('lead_id'=>$lead_id,'agency_id'=>$agency_id,'cron_status'=>0,'allocated_time'=>$PostDate); // Added by Upendra 02-06-15 for inserting date
				$this->db->insert('lms_leads_relations',$data);
				}
			
			return true;

		}

		public function update_leads_status($lead_id,$agency_id,$response){
			$date = date('Y-m-d h:i:s');
			$data=array('cron_status'=>'1','cron_response'=>$response, 'cron_time'=>$date);
			$this->db->where('lead_id',$lead_id);
			$this->db->where('agency_id',$agency_id);
			$this->db->update('lms_leads_relations',$data);
			return true;
		}

		 //get agent all leads
		public function get_agent_leads($limit, $start, $user_id, $start_date, $end_date)
		{
			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			$this->db->where('lms_leads.agent =', $user_id);
			$this->db->order_by('lms_leads.PostDate', 'desc');
			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);	
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
			}

			$this->db->limit($limit, $start);

			$result = $this->db->get();
			//print_r($result->result_array());die;
			return $result;
			
		}

		function count_agent_all_leads($user_id, $start_date, $end_date){
			
			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			$this->db->where('lms_leads.agent =', $user_id);
			$this->db->order_by('lms_leads.PostDate', 'desc');
			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
				
			}

			$result = $this->db->get();
			return $result->num_rows();
		}

		
		//get all leads
		public function get_excel_data($start_date, $end_date)
		{	
			$session_data = 	$this->session->all_userdata('logged_data');

			$user_id = $session_data['logged_data']['id'];
			if($user_id==1){
				$this->db->select('lms_leads.ID as UID,lms_leads.insurance_product as Insurance_Product,lms_leads.Name, lms_leads.verification as Verification,lms_leads.Annual_Income as Annual_Income,lms_leads.Email_ID as Email_ID,lms_leads.City,lms_leads.Other_City as OtherCity,lms_leads.ContactNo as Contact_No, rfeedback.Feedback as Feedback, rfeedback.not_contactable_counter as CallAttempts');
			}
			else {
				$this->db->select('lms_leads.ID as UID,lms_leads.insurance_product as Insurance_Product,lms_leads.Name, lms_leads.verification as Verification,lms_leads.Annual_Income as Annual_Income,lms_leads.Email_ID as Email_ID,lms_leads.City,lms_leads.ContactNo as Contact_No');
			}

///////////////
			$this->db->select("DATE_FORMAT(lms_leads.DOB, '%m/%d/%Y') as DOB", FALSE);
			$this->db->select("DATE_FORMAT(lms_leads.Application_Date, '%m/%d/%Y') as Application_Date", FALSE);

			
			
			if($user_id==1){
				$this->db->select('lms_users.fullname');
				$this->db->select('lms_leads.IP_Address as IP');
				$this->db->select("lms_leads.PostDate as PostDate");
				$this->db->join('lms_users', 'lms_users.id = lms_leads.agent','left');
				$this->db->join('rfeedback', 'rfeedback.AllRequestID = lms_leads.ID','left');

			}	

			$this->db->from('lms_leads');
		
			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
				
			}

			
			$this->db->order_by('lms_leads.ID', 'desc');
			
			$result = $this->db->get();

			return $result;
		}

		function count_all_leads($start_date, $end_date){
			
			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			
			if($start_date){
				$this->db->where('lms_leads.PostDate >=', $start_date);
				
			}
			if($end_date){
				$this->db->where('lms_leads.PostDate <=', $end_date);
				
			}

			
			$this->db->order_by('lms_leads.PostDate', 'desc');
			
			
			$result = $this->db->get();
			return $result->num_rows();
		}
		
		function delete_checked($checked_lead)   
		{  	

		    foreach ($checked_lead as $key=>$lead_id){
	  		  $this->db->where('ID', $lead_id);  
	          $this->db->delete('lms_leads');  
	  
		   	}  
		    return true;
		            
		}  


		function assign_checked($checked_lead, $executives)   
		{  	

		    foreach ($checked_lead as $key=>$lead_id){
		    	$data=array('executive'=>$executives);
				$this->db->where('ID',$lead_id);
				$this->db->update('lms_leads',$data);
	  
		   	}  
		    return true;
		            
		}

		function update_checked($checked_lead, $verification)   
		{  	

		    foreach ($checked_lead as $key=>$lead_id){
		    	$data=array('verification'=>$verification,'follow_status'=>1);
				$this->db->where('ID',$lead_id);
				$this->db->update('lms_leads',$data);
	  
		   	}  
		    return true;
		            
		}  


		function get_executive_leads($executive){

			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			$this->db->order_by('lms_leads.PostDate', 'desc');
			$this->db->where('lms_leads.executive =', $executive);
			$this->db->where('lms_leads.follow_status !=', 1);
			$result = $this->db->get();
			return $result;

		}

		function count_executive_all_leads($executive){
			
			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			$this->db->order_by('lms_leads.PostDate', 'desc');
			$this->db->where('lms_leads.executive =', $executive);
			$this->db->where('lms_leads.follow_status !=', 1);
			$result = $this->db->get();
			return $result->num_rows();
		}
	
		function import_to_c4p($data){
		
		$this->db->insert('lms_leads', $data);
		$insert_id=$this->db->insert_id();
		return $insert_id;
		}

		

		
	}