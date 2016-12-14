<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qualtech extends CI_Controller {

	function __construct(){
		//echo 'hi';die;
		parent::__construct();
		//$this->clear_cache();
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);

		$this->send_QT_leads();

	}

	public function send_QT_leads() {
	 		
	 	$results = $this->leads->get_cron_data(3);
		$leads = $results->result_array();	
		foreach ($leads as $k => $v) {

      		$dob =  date('m/d/Y',strtotime($v['DOB']));
      		$OPPORTUNITY_DATE	= date('m/d/Y H:i:s A');

      		$citycode ='999';
      		
      		if($v['City']=='Delhi' || $v['City']=='Delhi NCR'|| $v['City']=='Noida'|| $v['City']=='Faridabad' || $v['City']=='Gurgaon' || $v['City']=='Ghaziabad'){
      			$citycode = '491';	
      		}
      		if($v['City']=='Ahmadabad'||$v['City']=='Ahmedabad'){
      			$citycode = '3';	
      		}
      		if($v['City']=='Bangalore'||$v['City']=='Bangaluru'){
      			$citycode = '11';	
      		}
      		if($v['City']=='Chennai'){
      			$citycode = '24';	
      		}
      		if($v['City']=='Hyderabad'){
      			$citycode = '43';	
      		}
      		if($v['City']=='Kolkata'){
      			$citycode = '20';	
      		}
      		if($v['City']=='Mumbai' || $v['City']=='Navi Mumbai'){
      			$citycode = '67';	
      		}
      		if($v['City']=='Pune'){
      			$citycode = '80';	
      		}
      		if($v['City']=='Nashik'||$v['City']=='Nasik'){
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
                        
                  if($v['Annual_Income']=='5-10 Lacs'){
                  	$Annual_Income = '500000';
                  }
                  if($v['Annual_Income']=='3-5 Lacs'){
                  	$Annual_Income = '300000';
                  }

                  if($v['Annual_Income']=='10-above'){
                  	$Annual_Income = '1000000';
                  }
                  //echo '<pre>'; print_r($v);
                  $name = urlencode($v['Name']);
                  $age = date_diff(date_create($v['DOB']), date_create('today'))->y;

                  $curl = "http://182.71.129.114/apps/ipru.php?";
                  $postfields = "Lead_id=".$v['ID']."&gender=''&age=".$age."&email=".trim($v['Email_ID'])."&refsite=Contact4Policy&adunit=&channel=Alliance%20&source=Contact4Policy&product=Life&Agency=751&Lead=INCOMING_WEB&Mode=PREFIXED_APPOINTMENT&Full%20&name=".urlencode($v['Name'])."&first_name=".urlencode($v['Name'])."&mobile=".trim($v['ContactNo'])."&city=".$citycode."&dob=".$dob."&AnnInc=".$Annual_Income."&Lead_time=".$OPPORTUNITY_DATE.".";
            				 
                  $furl = $curl.$postfields;

            	$ch = curl_init();  
                  curl_setopt($ch,CURLOPT_URL,$furl);
                 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                  $output=curl_exec($ch);
                  curl_close($ch);
                  $this->leads->update_leads_status($v['ID'],3,$output,1);
            
	 	}

	 	exit();

	}


}


?>