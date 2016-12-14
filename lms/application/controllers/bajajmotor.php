 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bajajmotor extends CI_Controller {

	function __construct(){
		//echo 'hi';die;
		parent::__construct();
		//$this->clear_cache();
		$this->load->model('admin/users', '', TRUE);
		$this->load->model('admin/leads', '', TRUE);

		$this->send_bajajmotor_leads();

	}

	public function send_bajajmotor_leads() {
		$results = $this->leads->get_cron_data(5);
		$leads = $results->result_array();	

		foreach ($leads as $k => $v) {
			$name = str_replace(' ', '', $v['Name']);
			$url = 'https://general.bajajallianz.com/MotorInsurance/Misc/corpDM.do?p_dept_cd=4242&p_prod_cd=6001&p_comp_cd=1&p_data_source=WS_Health_Contact_CB&p_user_eml='.$v['Email_ID'].'&p_user_mob='.$v['ContactNo'].'&p_user_nm='.$name;

			$ch = curl_init();  

			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

			$output=curl_exec($ch);

			curl_close($ch);
			$this->leads->update_leads_status($v['ID'],5,$output);
			//echo $v['ContactNo'].$name.'<br>';

		}
	
	 		exit();
	}

	
}
?>