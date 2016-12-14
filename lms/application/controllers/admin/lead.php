<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends Admin_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('admin/leads', '', TRUE);
		$this->load->model('admin/users', '', TRUE);
		$this->load->helper("url");
		$this->load->library("pagination");
		
	}

	public function index(){

		$limit = 20;
		$this->site_data['title'].= 'Leads';

		$this->site_data['main_content'].= 'leads/list';
                $today = date('Y-m-d');
		$start_date = '';
		$end_date = '';

		if($this->input->get('from')){

			$start_date = $this->input->get('from')." 00:00:00";
		}

		if($this->input->get('to')){

			$end_date = $this->input->get('to')." 23:59:59" ;
		}

		$this->site_data['menu']['leads'] = 1;
		$config = array();
		$config["base_url"] = base_url("index.php/admin/lead/index/");
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$results = $this->leads->get_leads($limit, $page, $start_date, $end_date);
		
		$this->site_data['rows'] = $results->result_array();
		$config["total_rows"] =  $this->leads->count_all_leads($start_date, $end_date);
		$config["per_page"] = $limit;
		$config["uri_segment"] = 4;
		$this->site_data['start_date'] = $start_date;
		$this->site_data['end_date'] = $end_date;
		

		$this->pagination->initialize($config);

		
		
		$this->site_data['links'] = $this->pagination->create_links();
		$this->site_data['pagination'] = $this->pagination;
		$this->site_data['executives'] = $this->users->list_all_executive();

		$this->load->view($this->site_data['layout'], $this->site_data);
	}

	public function export_csv(){
		
                
		$start_date = '';
		$end_date = '';
	        $today = date('Y-m-d');

		if($this->input->get('from')){

			$start_date = $this->input->get('from');
		}

		if($this->input->get('to')){

			$end_date = $this->input->get('to');
		}
		
		$results = $this->leads->get_excel_data($start_date, $end_date);
		$resultdata = $results->result_array();
		$this->load->library('excel');
		
		$this->excel->to_excel($resultdata, 'Leads'.date('Y-m-d')); 
		//echo '<pre>';print_r($results);die;
			
		return TRUE;

	}

	public function action(){
		 
		 //print_r($this->input->post());die;
		 if($this->input->post('action')=='assign'){
		 	$checked_lead = $this->input->post('lead'); 
		 	$executives = $this->input->post('executives'); 
		 	$this->leads->assign_checked($checked_lead,$executives);
		 	$redirectto = base_url("index.php/admin/lead/index/");
		 	redirect($redirectto);

		 }elseif($this->input->post('action')=='delete'){
		 	$checked_lead = $this->input->post('lead'); 
		 	$this->leads->delete_checked($checked_lead);
         	$redirectto = base_url("index.php/admin/lead/index/");
		 	redirect($redirectto);
		 }
	
	}
	
	function import_to_c4p(){
	require('app_code/applicationLayer.php');
	$lfromdate=$_POST['lfromdate'];
	$ltodate=$_POST['ltodate'];
	$cmbfeedback=$_POST['cmbfeedback'];


$quey="SELECT * FROM  `lms_leads` LEFT OUTER JOIN `rfeedback` ON `rfeedback`.`AllRequestID` = `lms_leads`.`ID` AND rfeedback.Feedback='".$cmbfeedback."' where Application_Date>='".$lfromdate."' AND Application_Date<='".$ltodate."'";
	$i=0;

$listdata=$dbClass->dbSelect($quey);
 $listcount=$dbClass->countRow($quey);
$count_row=0;

foreach($listdata as $row) {$i++;
	
	
			$this->db->select('lms_leads.*');
			$this->db->from('lms_leads');
			$this->db->where('lms_leads.Email_ID =', $row['Email_ID']);
			$this->db->where('lms_leads.ContactNo =', $row['ContactNo']);
			$result = $this->db->get();
			 $count_row=$result->num_rows();
	
		if($count_row>0){
		echo $msg='alredy exist';	
		
		}else {
	       $data = array('Annual_Income'=>$row['Annual_Income'],
						'insurance_product'=>$row['insurance_product'],
						'Name'=>$row['Name'],
						'DOB'=>$row['DOB'] ,
						'Email_ID'=>$row['Email_ID'] ,
						'agent' =>0, 
						'City' =>  $row['City'], 
						'ContactNo' => $row['ContactNo'],
						'IP_Address'=>$row['IP_Address'],
						'Application_Date' => $row['Application_Date'],
						'refererurl'=>$row['refererurl'],
						'verification_code'=>$row['verification_code'],
						'verification'=>$row['verification'],						
						'Other_City'=>$row['Other_City'],
						'source'=> 'C4P',
						'PostDate' =>$row['PostDate']);
						$results = $this->leads->import_to_c4p($data);
						//echo $i;
						$restt=$listcount-$i;
						if($restt==1){
						return $results;
						}
					}
	
}

}
	
	
	

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
/*Layout: $this->site_data['main_content'] = 'admin/templates/common/users'; */