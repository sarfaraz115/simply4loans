<?php
//Admin Model

Class Users extends CI_Model{
	
	public function index(){

	}

	//To perform login functionalitites
	public function login($username, $password){
		//Select query based on username and password
		$this->db->select('id, username, role, fullname, image, created');
		$this->db->from('lms_users');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		//$this->db->where('role', '1');
		$this->db->where('active', '1');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	//add agencies to DB
	public function insert_user($data,$data1)
	{
		$this->db->insert('lms_users', $data);
		$insert_id=$this->db->insert_id();
		$query="INSERT INTO `lms_user_type`(`user_id`, `allotment_id`, `status`) VALUES ('".$insert_id."','".$data1."','1')";
		$this->db->query($query);
		return true;
	}
	//update user data
	public function update_user($data, $id, $password, $profile_img)
	{
		if(!empty($password)) 
		{
			$this->db->set('password', MD5($password));
		}
		if(!empty($profile_img)) 
		{
			$this->db->set('image', $profile_img);
		}
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->where('id', $id);
		$this->db->update('lms_users', $data);
		return true;
	}
	
	//Delete user data
	public function delete_user($id)
	{
		$data['active'] = 0;
		$this->db->where('id', $id);
		$this->db->update('lms_users', $data);
		return true;
	}
	
	//Get User Detail
	public function get_user_data($data)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('id', $data);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = $query->row(); 
			return $data;
		}
	}

	//select data for user listing
	public function list_clients()
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('lms_users.role', 2);
		$this->db->where('lms_users.active', 1);
		$this->db->order_by('lms_users.id', 'desc');
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

	
	//select data for user listing
	public function list_user($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->join('lms_filters', 'lms_filters.user_id = lms_users.id', 'left outer');
		$this->db->where('lms_users.role', 2);
		$this->db->where('lms_users.active', 1);
		$this->db->order_by('lms_users.id', 'desc');
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


		//select data for user listing
	public function list_agent($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->join('lms_filters', 'lms_filters.user_id = lms_users.id', 'left outer');
		$this->db->where('lms_users.role', 3);
		$this->db->where('lms_users.active', 1);
		$this->db->order_by('lms_users.id', 'desc');
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


		//select data for user listing
	public function list_executive($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('lms_users.role', 4);
		$this->db->order_by('lms_users.id', 'desc');
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
	public function list_all_executive()
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('lms_users.role', 4);
		$this->db->order_by('lms_users.id', 'desc');
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

	public function list_all_agent()
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->where('lms_users.role', 3);
		$this->db->where('lms_users.active', 1);
		$this->db->order_by('lms_users.id', 'desc');
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

	//search user listing
	public function search_list($agency, $username, $email_id, $limit, $start)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->join('lms_filters', 'lms_filters.user_id = lms_users.id', 'left outer');
		$this->db->where('lms_users.role', 2);
		$this->db->where('lms_users.active', 1);
		if(!empty($agency)) 
		{
			$this->db->like('lms_users.fullname', $agency);
		}
		if(!empty($username)) 
		{
			$this->db->like('lms_users.username', $username);
		}
		if(!empty($email_id)) 
		{
			$this->db->like('lms_users.email', $email_id);
		}
		
		$this->db->order_by('lms_users.id', 'desc');
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

		//search user listing
	public function search_agent($agency, $username, $email_id, $limit, $start)
	{
		$this->db->select('*');
		$this->db->from('lms_users');
		$this->db->join('lms_filters', 'lms_filters.user_id = lms_users.id', 'left outer');
		$this->db->where('lms_users.role', 3);
		$this->db->where('lms_users.active', 1);
		if(!empty($agency)) 
		{
			$this->db->like('lms_users.fullname', $agency);
		}
		if(!empty($username)) 
		{
			$this->db->like('lms_users.username', $username);
		}
		if(!empty($email_id)) 
		{
			$this->db->like('lms_users.email', $email_id);
		}
		
		$this->db->order_by('lms_users.id', 'desc');
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


	//select city details
	public function get_city()
	{
		$this->db->select('*');
		$this->db->from('lms_city_list');
		$this->db->order_by('lms_city_list.city', 'asc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
		
	
	
	
	//add filters to DB
	public function add_filter($data)
	{
		$this->db->insert('lms_filters', $data);
		return true;
	}
	
	//select data for filter listing
	public function list_filter()
	{
		$this->db->select('*');
		$this->db->from('lms_filters');
		$this->db->join('lms_users', 'lms_users.id = lms_filters.user_id');
		$this->db->join('lms_state', 'lms_state.id = lms_filters.state_id');
		$this->db->where('lms_filters.f_status', 1);
		$this->db->order_by('lms_filters.f_id','desc');

		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	//Get Filter Data
	public function get_filter_data($data)
	{
		$this->db->select('*');
		$this->db->from('lms_filters');
		$this->db->where('f_id', $data);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = $query->row(); 
			return $data;
		}
	}
	
	//update user data
	public function update_filter($data, $filter_id)
	{
		$this->db->set('date_created', 'NOW()', FALSE);
		$this->db->where('f_id', $filter_id);
		$this->db->update('lms_filters', $data);
		return true;
	}
	
	//Delete filter
	public function delete_filter($id)
	{
		$data['f_status'] = 0;
		$this->db->where('f_id', $id);
		$this->db->update('lms_filters', $data);
		return true;
	}
	
	
	//pagination
	public function record_count($usertype) 
	{
		$this->db->where('active', 1);
		$this->db->where('lms_users.role', $usertype);
        return $this->db->count_all_results("lms_users");
    }
    
    //pagination
	public function search_result_count($agency, $username, $email_id) 
	{
		if(!empty($agency)) 
		{
			$this->db->like('fullname', $agency);
		}
		if(!empty($username)) 
		{
			$this->db->like('username', $username);
		}
		if(!empty($email_id)) 
		{
			$this->db->like('email', $email_id);
		}
		$this->db->where('lms_users.role', '2');
		$this->db->from('lms_users');
		return $this->db->count_all_results();
	}


	    //pagination
	public function search_agent_result_count($agency, $username, $email_id) 
	{
		if(!empty($agency)) 
		{
			$this->db->like('fullname', $agency);
		}
		if(!empty($username)) 
		{
			$this->db->like('username', $username);
		}
		if(!empty($email_id)) 
		{
			$this->db->like('email', $email_id);
		}
		$this->db->where('lms_users.role', '3');
		$this->db->from('lms_users');
		return $this->db->count_all_results();
	}
	 
	//get filter data by user id
	public function get_filter_details($user_id)
	{
		$this->db->select('*');
		$this->db->from('lms_filters');
		$this->db->where('user_id', $user_id);
		$this->db->where('disable_filter', 0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = $query->row(); 
			return $data;
			
		}
	}
    
    //get all leads
	public function get_leads($limit, $start, $city, $product, $income, $min_age, $max_age)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
                $cities = explode(',',$city); 
                $citycond = ''; 
           foreach($cities as $key=>$value){
              $citycond .="FIND_IN_SET('$value',City) !=0 OR ";
           }
           $citycond  = substr($citycond, 0, -3);
           
           $this->db->where('('.$citycond.')');
		
	$products = explode(',',$product); 
           $productcond = ''; 
           foreach($products as $key=>$value){
               $productcond .="FIND_IN_SET('$value', insurance_product) !=0 OR ";
           }
           $productcond  = substr($productcond, 0, -3);
           
           $this->db->where('('.$productcond.')');
            $incomes = explode(',',$income); 
           $incomecond = ''; 
           foreach($incomes as $key=>$value){
              $incomecond .="Annual_Income='".$value."' OR ";
           }
           $incomecond  = substr($incomecond, 0, -3);
           
           $this->db->where('('.$incomecond.')');
		//$this->db->where('Annual_Income =', $income);
                if($min_age!='' && $max_age!='') {
                 $this->db->where('DOB between "'.$min_age.'" AND "'.$max_age.'"');
                }
                
                 if($min_age=='' && $max_age!=''){
              $this->db->where('DOB >= "'.$max_age.'"');
           }
           if($max_age==''&&$min_age!=''){
                $this->db->where('DOB <= "'.$min_age.'"');
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
	
    //get all leads
	public function get_leads_by_date($limit, $start, $city, $product, $income, $min_age, $max_age, $start_date, $end_date)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$cities = explode(',',$city); 
                $citycond = ''; 
           foreach($cities as $key=>$value){
              $citycond .="FIND_IN_SET('$value',City) !=0 OR ";
           }
           $citycond  = substr($citycond, 0, -3);
           
           $this->db->where('('.$citycond.')');

           $products = explode(',',$product); 
           $productcond = ''; 
           foreach($products as $key=>$value){
               $productcond .="FIND_IN_SET('$value', insurance_product) !=0 OR ";
           }
           $productcond  = substr($productcond, 0, -3);
           
           $this->db->where('('.$productcond.')');
	   $incomes = explode(',',$income); 
           $incomecond = ''; 
           foreach($incomes as $key=>$value){
              $incomecond .="Annual_Income='".$value."' OR ";
           }
           $incomecond  = substr($incomecond, 0, -3);
           
           $this->db->where('('.$incomecond.')');         
		//$this->db->where('Annual_Income =', $income);
                if($min_age!='' && $max_age!='') {
                 $this->db->where('DOB between "'.$min_age.'" AND "'.$max_age.'"');
                }
                
                if($min_age=='' && $max_age!=''){
              $this->db->where('DOB >= "'.$max_age.'"');
           }
           if($max_age==''&&$min_age!=''){
                $this->db->where('DOB <= "'.$min_age.'"');
           }
		$this->db->where('PostDate >=', $start_date);
		$this->db->where('PostDate <=', $end_date);
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

		public function get_all_leads($limit, $start)
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

	//get all leads
	public function get_excel_data($city, $product, $income, $min_age, $max_age)
	{
		$this->db->select('*');
		$this->db->from('lms_leads');
		$cities = explode(',',$city); 
                $citycond = ''; 
           foreach($cities as $key=>$value){
              $citycond .="FIND_IN_SET('$value',City) !=0 OR ";
           }
           $citycond  = substr($citycond, 0, -3);
           
           $this->db->where('('.$citycond.')');

           $products = explode(',',$product); 
           $productcond = ''; 
           foreach($products as $key=>$value){
               $productcond .="FIND_IN_SET('$value', insurance_product) !=0 OR ";
           }
           $productcond  = substr($productcond, 0, -3);
           
           $this->db->where('('.$productcond.')');

	  $incomes = explode(',',$income); 
           $incomecond = ''; 
           foreach($incomes as $key=>$value){
              $incomecond .="Annual_Income='".$value."' OR ";
           }
           $incomecond  = substr($incomecond, 0, -3);
           
           $this->db->where('('.$incomecond.')');          
	//$this->db->where('Annual_Income =', $income);
                if($min_age!='' && $max_age!='') {
                 $this->db->where('DOB between "'.$min_age.'" AND "'.$max_age.'"');
                }
                
                 if($min_age=='' && $max_age!=''){
              $this->db->where('DOB >= "'.$max_age.'"');
           }
           if($max_age==''&&$min_age!=''){
                $this->db->where('DOB <= "'.$min_age.'"');
           }
		$this->db->order_by('id', 'desc');
		

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

	function count_all_leads(){
		 return $this->db->count_all_results('lms_leads');
	}

	
	//pagination leads
	public function leads_count($city, $product, $income, $min_age, $max_age,$start_date, $end_date) 
	{
           $cities = explode(',',$city); 
           $citycond = ''; 
           foreach($cities as $key=>$value){
              $citycond .="FIND_IN_SET('$value',City) !=0 OR ";
           }
           $citycond  = substr($citycond, 0, -3);
           
           $this->db->where('('.$citycond.')'); 

           $products = explode(',',$product); 
           $productcond = ''; 
           foreach($products as $key=>$value){
              //$productcond .="nsurance_product='".$value."' OR ";
              $productcond .="FIND_IN_SET('$value', insurance_product) !=0 OR ";  
           }
           $productcond  = substr($productcond, 0, -3);
           
           $this->db->where('('.$productcond.')');
          
           $incomes = explode(',',$income); 
           $incomecond = ''; 
           foreach($incomes as $key=>$value){
              $incomecond .="Annual_Income='".$value."' OR ";
           }
           $incomecond  = substr($incomecond, 0, -3);
           
           $this->db->where('('.$incomecond.')');

	   //$this->db->where('Annual_Income =', $income);
           if($min_age!='' && $max_age!='') {
              $this->db->where('DOB between "'.$min_age.'" AND "'.$max_age.'"');
           }
                
           if($min_age=='' && $max_age!=''){
              $this->db->where('DOB >= "'.$max_age.'"');
           }
           if($max_age==''&&$min_age!=''){
                $this->db->where('DOB <= "'.$min_age.'"');
           }
           if($start_date!=''){
            $this->db->where('PostDate >=', $start_date);
           }
           if($end_date){
	    $this->db->where('PostDate <=', $end_date);
           }
         
	   return $this->db->count_all_results('lms_leads');
		
    }
    
    //update profile data
	public function update_profile_data($data, $id, $password, $profile_img)
	{
		if(!empty($profile_img)) 
		{
			$this->db->set('image', $profile_img);
		}
		if(!empty($password)) 
		{
			$this->db->set('password', MD5($password));
		}
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->where('id', $id);
		$this->db->update('lms_users', $data);
		return true;
	}
	
	//For Reset Password
	public function reset_password($pass, $u_id)
	{
		$this->db->set('password', $pass);	
		$this->db->set('reset_pass', '');
		$this->db->where('id', $u_id);
		$this->db->update('lms_users');
		return true;
	}

	public function unique_leads($Insurance_Product, $Contact_No, $Application_Date, $user_id)
	{
		if(!empty($Insurance_Product)) 
		{
			$this->db->where('lms_leads.Insurance_Product', $Insurance_Product);
		}
		if(!empty($Contact_No)) 
		{
			$this->db->where('lms_leads.ContactNo', $Contact_No);
		}
		if(!empty($Application_Date)) 
		{
			$this->db->where('lms_leads.Application_Date', $Application_Date);
		}
		if(!empty($user_id)) 
		{
			$this->db->where('lms_leads.agent', $user_id);
		}
		
		return $this->db->count_all_results('lms_leads');
	}
	
}