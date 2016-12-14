<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ipru extends CI_Controller {

	function __construct(){
		//echo 'hi';die;
		parent::__construct();
		//$this->clear_cache();
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);

		$this->send_ipru_leads();

	}

	public function send_ipru_leads() {
	 		
	 			

		$results = $this->leads->get_cron_data(2);
		$leads = $results->result_array();	
		//print_r($leads);die;
 		foreach ($leads as $k => $v) {

 				$dob =  date('m/d/Y',strtotime($v['DOB']));
 				$OPPORTUNITY_DATE	= date('m/d/Y H:i:s A');

 				$citycode ='999';
 				
 			if($v['City']=='Delhi'|| $v['City']=='Delhi NCR' || $v['City']=='Noida' || $v['City']=='Faridabad' || $v['City']=='Gurgaon' || $v['City']=='Ghaziabad'){
               $citycode = '491';   
            }
            if($v['City']=='Ahmadabad' || $v['City']=='Ahmedabad') {
               $citycode = '3';  
            }
            if($v['City']=='Bangalore' || $v['City']=='Bangaluru') {
               $citycode = '11'; 
            }
            if($v['City']=='Chennai') {
               $citycode = '24'; 
            }
            if($v['City']=='Hyderabad') {
               $citycode = '43'; 
            }
            if($v['City']=='Kolkata') {
               $citycode = '20'; 
            }
            if($v['City']=='Mumbai' || $v['City']=='Navi Mumbai') {
               $citycode = '67'; 
            }
            if($v['City']=='Pune') {
               $citycode = '80'; 
            }
            if($v['City']=='Nashik'||$v['City']=='Nasik') {
               $citycode = '70'; 
            }  
		 	if($v['City']=='Lucknow'||$v['City']=='Lucknow'){
      			$citycode = '59';	
      		}		
      		
			if($v['City']=='Bhubaneshwar'||$v['City']=='Bhubaneshwar'){
      			$citycode = '17';	
      		}	
			if($v['City']=='Vizag'||$v['City']=='Nasik' || $v['City']=='Vishakapatanam' || $v['City']=='Visakhapatnam' ){
      			$citycode = '473';	
      		}	
			if($v['City']=='CHANDIGARH'||$v['City']=='Chandigarh'){
      			$citycode = '22';	
      		}	
			if($v['City']=='Surat'){
      			$citycode = '92';	
      		}
			if($v['City']=='Baroda'||$v['City']=='Vadodara'){
      			$citycode = '13';	
      		}			
		$envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
   <soapenv:Header/>
   <soapenv:Body>
      <tem:Insert_Parking_Data>
         <!--Optional:-->
         <tem:PROSPECT_ID></tem:PROSPECT_ID>
         <!--Optional:-->
         <tem:FORM_ID></tem:FORM_ID>
         <!--Optional:-->
         <tem:Title></tem:Title>
         <!--Optional:-->
         <tem:FIRST_NAME>'.$v['Name'].'</tem:FIRST_NAME>
         <!--Optional:-->
         <tem:Last_Name></tem:Last_Name>
         <!--Optional:-->
         <tem:Gender></tem:Gender>
         <!--Optional:-->
         <tem:Date_of_Birth>'.$dob.'</tem:Date_of_Birth>
         <!--Optional:-->
         <tem:Res_STD></tem:Res_STD>
         <!--Optional:-->
         <tem:Res_No></tem:Res_No>
         <!--Optional:-->
         <tem:Off_STD></tem:Off_STD>
         <!--Optional:-->
         <tem:Off_No></tem:Off_No>
         <!--Optional:-->
         <tem:Off_Ext></tem:Off_Ext>
         <!--Optional:-->
         <tem:Mobile>'.trim($v['ContactNo']).'</tem:Mobile>
         <!--Optional:-->
         <tem:Email>'.trim($v['Email_ID']).'</tem:Email>
         <!--Optional:-->
         <tem:WHERE_TO_CONTACT></tem:WHERE_TO_CONTACT>
         <!--Optional:-->
         <tem:Address1></tem:Address1>
         <!--Optional:-->
         <tem:Address2></tem:Address2>
         <!--Optional:-->
         <tem:Address3></tem:Address3>
         <!--Optional:-->
         <tem:Res_City>'.$citycode.'</tem:Res_City>
         <!--Optional:-->
         <tem:Pincode></tem:Pincode>
         <!--Optional:-->
         <tem:Product_Interested></tem:Product_Interested>
         <!--Optional:-->
         <tem:Gross_Annual_Income>'.$v['Annual_Income'].'</tem:Gross_Annual_Income>
         <!--Optional:-->
         <tem:Occupation></tem:Occupation>
         <!--Optional:-->
         <tem:Education></tem:Education>
         <!--Optional:-->
         <tem:Company_Name></tem:Company_Name>
         <!--Optional:-->
         <tem:Designation></tem:Designation>
         <!--Optional:-->
         <tem:Ownership></tem:Ownership>
         <!--Optional:-->
         <tem:FINANCIAL_PRODUCTS></tem:FINANCIAL_PRODUCTS>
         <!--Optional:-->
         <tem:Marital></tem:Marital>
         <!--Optional:-->
         <tem:No_of_children></tem:No_of_children>
         <!--Optional:-->
         <tem:Next_contact_date></tem:Next_contact_date>
         <!--Optional:-->
         <tem:Next_contact_time></tem:Next_contact_time>
         <!--Optional:-->
         <tem:MDate></tem:MDate>
         <!--Optional:-->
         <tem:LEAD_TYPE>INCOMING_WEB</tem:LEAD_TYPE>
         <!--Optional:-->
         <tem:LEAD_CHANNEL>Alliance</tem:LEAD_CHANNEL>
         <!--Optional:-->
         <tem:LEAD_MODE>PREFIXED_APPOINTMENT</tem:LEAD_MODE>
         <!--Optional:-->
         <tem:LEAD_SOURCE>P4C</tem:LEAD_SOURCE>
         <!--Optional:-->
         <tem:LEAD_CAMPAIGN>XYZ</tem:LEAD_CAMPAIGN>
         <!--Optional:-->
         <tem:Remarks></tem:Remarks>
         <!--Optional:-->
         <tem:Lipp_Status></tem:Lipp_Status>
         <!--Optional:-->
         <tem:Lipp_Reason></tem:Lipp_Reason>
         <!--Optional:-->
         <tem:LIPP_OPPORTUNITY_ID></tem:LIPP_OPPORTUNITY_ID>
         <!--Optional:-->
         <tem:OPPORTUNITY_DATE>'.$OPPORTUNITY_DATE.'</tem:OPPORTUNITY_DATE>
         <!--Optional:-->
         <tem:CSE_Name>0</tem:CSE_Name>
         <!--Optional:-->
         <tem:CAMPAIGN_PRIORITY></tem:CAMPAIGN_PRIORITY>
         <!--Optional:-->
         <tem:OPPORTUNITY_TYPE></tem:OPPORTUNITY_TYPE>
         <!--Optional:-->
         <tem:Agency_Code></tem:Agency_Code>
         <!--Optional:-->
         <tem:FSC_CODE></tem:FSC_CODE>
         <!--Optional:-->
         <tem:ADDL_INFO1></tem:ADDL_INFO1>
         <!--Optional:-->
         <tem:ADDL_INFO2></tem:ADDL_INFO2>
         <!--Optional:-->
         <tem:FLAG>1</tem:FLAG>
         <!--Optional:-->
         <tem:Campaign_Code></tem:Campaign_Code>
         <!--Optional:-->
         <tem:Logic></tem:Logic>
         <!--Optional:-->
         <tem:UploadedCity></tem:UploadedCity>
         <!--Optional:-->
         <tem:TelecomCircle></tem:TelecomCircle>
         <!--Optional:-->
         <tem:NETWORK></tem:NETWORK>
         <!--Optional:-->
         <tem:DEVICE></tem:DEVICE>
         <!--Optional:-->
         <tem:UNIQUE_ID>'.$v['ID'].'</tem:UNIQUE_ID>
      </tem:Insert_Parking_Data>
   </soapenv:Body>
</soapenv:Envelope>';
				 				
								$soap_do = curl_init();
								curl_setopt($soap_do, CURLOPT_URL,"http://123.252.236.245/IPRU_Internet_Google_Campaign_New/Service1.asmx?wsdl");
								curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
								curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
								curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
								curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
								curl_setopt($soap_do, CURLOPT_POST,           true );            
								curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $envelope); 
								curl_setopt($soap_do, CURLOPT_VERBOSE, TRUE); 
								curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Content-Type: text/xml","SOAPAction: \"http://tempuri.org/Insert_Parking_Data\"", "Content-length: ".strlen($envelope))); 

								$result = curl_exec($soap_do);
	 							curl_close($soap_do);
	 							//print_r($result.$v['ID'].'<br>');
					    		$this->leads->update_leads_status($v['ID'],2,$result);
					

	 		}

	 		exit();

	}


}


?>