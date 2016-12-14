<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hdfclife extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);

		$this->send_hdfc_leads();

	}

	public function send_hdfc_leads() {

		$results = $this->leads->get_cron_data(8);
		$leads = $results->result_array();	
		print_r($leads);
		foreach ($leads as $k => $v) {
				$name = str_replace(' ', '', $v['Name']);
				$age = date_diff(date_create($v['DOB']), date_create('today'))->y;
				$url = 'http://115.113.224.164/tadpushdata/tadpushdatalogic.aspx?';
				$ch = curl_init();  
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"Userid=Serco&pwd=serco@123&SourceId=69&PolicyNo=&FirstName=".$name."&LastName=&Address=&PinCode=&City=".$v['City']."&Mobile=".$v['ContactNo']."&Phone1=&Phone2=&DOB=&Gender=".$v['Gender']."&Married=UnMarried&Age=".$age."&PolicyName=".$v['insurance_product']."&PolicyStatus=&BranchName=&Channel=Agency&Campaign=&Income=0");

				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

				$output=curl_exec($ch);

				curl_close($ch);
				if($output=='Y'){
					$this->leads->update_leads_status($v['ID'],8,$output);
				}
				//echo $v['ContactNo'].$name.'<br>';

	 	}
	 	exit();
	 }

}

?>