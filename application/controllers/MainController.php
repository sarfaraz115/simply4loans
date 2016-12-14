<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainController extends MY_FrontEndController {

	function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->library('form_validation');
	}

	public function index(){

		$this->site_data['title'].= 'home';
		$this->site_data['main_content'].= 'home';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function personalLoan(){

		$this->site_data['title'].= 'Personal Loan';
		$this->site_data['main_content'].= 'personalLoan';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function homeLoan(){
		$this->site_data['title'].= 'Home Loan';
		$this->site_data['main_content'].= 'homeLoan';
		$this->load->view($this->site_data['layout'], $this->site_data);
	
	}
	
	public function carBikeLoan(){
		$this->site_data['title'].= 'Car Bike Loan';
		$this->site_data['main_content'].= 'carBikeLoan';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function educationLoan(){
		$this->site_data['title'].= 'Education Loan';
		$this->site_data['main_content'].= 'educationLoan';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function homeLoanTransfer(){
		$this->site_data['title'].= 'Home Loan Transfer';
		$this->site_data['main_content'].= 'homeLoanTransfer';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function loanAgainstProperty(){
		$this->site_data['title'].= 'Loan Against Property';
		$this->site_data['main_content'].= 'loanAgainstProperty';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function creditCards(){
		$this->site_data['title'].= 'Credit Cards';
		$this->site_data['main_content'].= 'creditCards';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function contactUs(){
		$this->site_data['title'].= 'Contact Us';
		$this->site_data['main_content'].= 'contactUs';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function aboutUs(){
		$this->site_data['title'].= 'About Us';
		$this->site_data['main_content'].= 'aboutUs';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function healthInsurance(){
		$this->site_data['title'].= 'Health Insurance';
		$this->site_data['main_content'].= 'healthInsurance';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function lifeInsurance(){
		$this->site_data['title'].= 'Life Insurance';
		$this->site_data['main_content'].= 'lifeInsurance';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function privacyPolicy(){
		$this->site_data['title'].= 'Privacy Policies';
		$this->site_data['main_content'].= 'privacyPolicy';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function termsConditions(){
		$this->site_data['title'].= 'Terms And Conditions';
		$this->site_data['main_content'].= 'termsConditions';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	
	public function faqs(){
		$this->site_data['title'].= 'Frequently Asked Questions';
		$this->site_data['main_content'].= 'faqs';
		$this->load->view($this->site_data['layout'], $this->site_data);
	}
	public function addLoanDetails() {
       
	    echo'ldjdkfdfl';
		exit;
	    $this->site_data['title'].= 'Add Filter';
		$this->site_data['main_content'].= 'agency/add_filter';
        $this->site_data['menu']['filter'] = 1;
		
		$this->form_validation->set_rules('Name', 'Name', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('min_age', 'Minimum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('max_age', 'Maximum Age Range', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('income', 'Income', 'required');
		$this->form_validation->set_error_delimiters('<div class="login_error">', '</div>');	
                
				
				$current_date = date('Y-m-d');
				$ip = $this->input->ip_address();
				 
				$prevdate = date('Y-m-d', strtotime("now -45 days") );
				$dob = $dd['year'] . "-" . $dd['month'] . "-" . $dd['day'];
				
				$data = array(
				'insurance_product' => $this->input->post('Type_Loan'),
				'Loan_Amount' 		=> $this->input->post('Loan_Amount'),
				'Occupation' 		=> $this->input->post('Occupation'),
				'name' 				=> $this->input->post('Name'),
				'Email' 			=> $this->input->post('Email'),
				'Phone' 			=> $this->input->post('Phone'),
				'City' 				=> $this->input->post('City'),
				'Gender' 			=> $this->input->post('Gender'),
				'DOB' 			    => $dob,
				'verification' 		=> 'NONOTP',
				'Application_date'  => $current_date,
				'user_id' 			=> $this->db->insert_id(),
				);
				// Transfering Data To Model
				
				   $idd= $this->db->insert_id();
				   
				   $form = '<div id="second_form1">
		<form name="form_validation" id="form">
			<input type="hidden" name="Type_Loan" value="Personal Loan" />
			<input type="text" name="id" value="<?php echo$idd; ?>" />
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>Loan Amount</label>
				<input type="text" class="form-control" name="Loan_Amount" placeholder="Loan_Amount" maxlength="15" onkeypress="intOnly(this);" onkeyup="intOnly(this); javascript:this.value=Comma(this.value);" id="loan_amount" autofocus />
			</div>
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>Occupation</label>
				<select class="minimal" name="Occupation" id="Occupation">
					<option>Please Select</option>
					<option>Salaried</option>
					<option>Self Employed</option>
				</select>
			</div>
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>Name</label>
				<input type="text" class="form-control" placeholder="First Name and Last Name" id="Name" name="Name" onKeyup="AllowAlphabet();" />
				<div id="nameAlert"></div>
			</div>
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>Email</label>
				<input type="email" class="form-control" id="email" name="Email" placeholder="Example@domain.com" onchange="validate_email(this.value);" />
				<div id="emailAlert"></div>
			</div>
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>Mobile</label>
				<input type="text" id="Phone" name="Phone" class="form-control" placeholder="Mobile" onchange="phonenumber(this.value);" maxlength="10" onKeyup="mob_check();" />
				<div id="phoneAlert"></div>
			</div>
			<div class="col-md-6 col-sm-6  form-set">
				<br />
				<label>City</label>
				<select class="minimal" name="City" id="City">
					<option value="Please Select">Please Select</option>
					<option value="Ahmedabad">Ahmedabad</option>
					<option value="Aurangabad">Aurangabad</option>
					<option value="Bangalore">Bangalore</option>
					<option value="Baroda">Baroda</option>
					<option value="Bhiwadi">Bhiwadi</option>
					<option value="Bhopal">Bhopal</option>
					<option value="Bhubneshwar">Bhubneshwar</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Chennai">Chennai</option>
					<option value="Cochin">Cochin</option>
					<option value="Coimbatore">Coimbatore</option>
					<option value="Cuttack">Cuttack</option>
					<option value="Dehradun">Dehradun</option>
					<option value="Delhi">Delhi</option>
					<option value="Faridabad">Faridabad</option>
					<option value="Ghaziabad">Ghaziabad</option>
					<option value="Gurgaon">Gurgaon</option>
					<option value="Guwahati">Guwahati</option>
					<option value="Hosur">Hosur</option>
					<option value="Hyderabad">Hyderabad</option>
					<option value="Indore">Indore</option>
					<option value="Jabalpur">Jabalpur</option>
					<option value="Jaipur">Jaipur</option>
					<option value="Jamshedpur">Jamshedpur</option>
					<option value="Kanpur">Kanpur</option>
					<option value="Kochi">Kochi</option>
					<option value="Kolkata">Kolkata</option>
					<option value="Lucknow">Lucknow</option>
					<option value="Ludhiana">Ludhiana</option>
					<option value="Madurai">Madurai</option>
					<option value="Mangalore">Mangalore</option>
					<option value="Mysore">Mysore</option>
					<option value="Mumbai">Mumbai</option>
					<option value="Nagpur">Nagpur</option>
					<option value="Nasik">Nasik</option>
					<option value="Navi Mumbai">Navi Mumbai</option>
					<option value="Noida">Noida</option>
					<option value="Patna">Patna</option>
					<option value="Pune">Pune</option>
					<option value="Ranchi">Ranchi</option>
					<option value="Raipur">Raipur</option>
					<option value="Rewari">Rewari</option>
					<option value="Sahibabad">Sahibabad</option>
					<option value="Surat">Surat</option>
					<option value="Thane">Thane</option>
					<option value="Others">Others</option>
					<option value="Thiruvananthapuram">Thiruvananthapuram</option>
					<option value="Trivandrum">Trivandrum</option>
					<option value="Trichy">Trichy</option>
					<option value="Vadodara">Vadodara</option>
					<option value="Vizag">Vizag</option>
					<option value="Vishakapatanam">Vishakapatanam</option>
				</select>
				<div id="City"></div>
			</div>
			<div class="col-md-12" id="col-13" style="border:0px solid #000;">
				<div class="col-md-6 col-sm-6  form-set1" style="margin-left:-15px;">
					</br>
					<label>Date of Birth</label>
					<div style="float:left; width:100%; text-align:left; line-height: 34px; ">
						<select name="day" id="day" class="minimal" style="margin-left:0px;">
							<option value="DD" selected="SELECTED">DD</option>
							<?php for($i=1;$i<=31;$i++){?>
							<option value="<?=$i?>">
								<?=$i?>
							</option>
							<?php } ?>
						</select>
						<select width="200px;" class="minimal" name="month" id="month" style="margin-left:10px;">
							<option value="MM" selected="SELECTED">MM</option>
							<option value="1">Jan</option>
							<option value="2">Feb</option>
							<option value="3">Mar</option>
							<option value="4">Apr</option>
							<option value="5">May</option>
							<option value="6">Jun</option>
							<option value="7">Jul</option>
							<option value="8">Aug</option>
							<option value="9">Sep</option>
							<option value="10">Oct</option>
							<option value="11">Nov</option>
							<option value="12">Dec</option>
						</select>
						<select name="year" class="minimal" id="year" style="margin-left:10px;">
							<option value="YYYY">YYYY</option>
							<?php for($k=0;$k<=51;$k++){?>
							<option value="<?=1956+$k?>">
								<?=1956+$k?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div id="dobVal"></div>
				</div>
				<div class="col-md-6 col-sm-6  form-set" style="margin-left:15px;">
					</br>
					<label>Gender</label>
					</br>
					<div style="float:left; width:100%; text-align:left; line-height: 34px; ">
						<input type="radio" name="Gender" value="Male" checked />Male&nbsp &nbsp &nbsp &nbsp
						<input type="radio" name="Gender" value="Female" />Female</div>
				</div>
			</div>
			<br />
			<br />
			<div class="col-md-12 form-set">
				<br />
				<p style="float:left;font-size:10px;font-style:normal;">
					<input id="Checkbox1" type="checkbox" checked />I agree to<a href="privacypolicy.php"> Privacy Policy</a> and <a href="terms-condition.php"> T&C </a> authorizing Simply4Loans.com and it&apos;s partnering Companies to Contact me with reference to financial products overriding any registration for DNC/NDNC.</p>
				</br>
			</div>
			<div class="col-md-12" align="center">
				</br>
				<input class="buttom" name="submit" id="submit" value="Submit" style="margin-bottom:20px;width:120px;" type="button">
				</br>
			</div>
	</form>
	</div>';
				// Loading View
					if($idd>0)
					{   
				        echo'lkldlfkdf';
						echo$form;
						//redirect('admin/agency/agency_list', 'refresh');
					}
					else
					{
						$this->load->view($this->site_data['layout'], $this->site_data);
					}
		}

	
}
