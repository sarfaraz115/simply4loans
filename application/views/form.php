<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<script type="text/javascript">
$(document).ready(function(){
var x="";	
var str_array="";
var res="";
$("#loan_amount").keyup(function(){
	
	var str=$("#loan_amount").val();
	var str_array = str.split(',');
	var countArray=str_array.length;
	if(countArray<5){
	
	if(countArray>0){
		 x=str.replace(',','');
		}else {
		 x=str;
			}
x=x.replace(',','');	
x=x.toString();
var lastThree = x.substring(x.length-3);
var otherNumbers = x.substring(0,x.length-3);
if(otherNumbers != '')
    lastThree = ',' + lastThree;
var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
var rest=inWords1(x);
$('#loan_amountId').html(rest);
document.getElementById('loan_amount').value=res;
	}else {
			return false;
	
	}
	});
});

function Comma(Num)
 {
       Num += '';
       Num = Num.replace(/,/g, '');
       x = Num.split('.');
       x1 = x[0];
       x2 = x.length > 1 ? '.' + x[1] : '';
         var rgx = /(\d)((\d)(\d{2}?)+)$/;
       while (rgx.test(x1))
       x1 = x1.replace(rgx, '$1' + ',' + '$2');
       return x1 + x2;       
        
 }
var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];

function inWords1(num) {
var num=num.replace(',','');
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'Only ' : '';
    console.log(str);
    return str;
}

function Comma(Num)
 {
       Num += '';
       Num = Num.replace(/,/g, '');

       x = Num.split('.');
       x1 = x[0];
	   x2 = x.length > 1 ? '.' + x[1] : '';

       var rgx = /(\d)((\d)(\d{2}?)+)$/;

       while (rgx.test(x1))
	      x1 = x1.replace(rgx, '$1' + ',' + '$2');
       return x1 + x2;       
        
 }	

function validateFrm(Form) {
	var loan_amount = $("#loan_amount").val();
	var occupation = $("#Occupation").val();
	var name = $("#Name").val();
	var email = $("#email").val();
	var mobile = $("#Phone").val();
	var city = $("#City").val();
	var dob_day = $("#day").val();
	var dob_month = $("#month").val();
	var dob_year = $("#year").val();
	var check = document.getElementById('Checkbox1');
	if (loan_amount == '') {
		$("#loan_amount").focus();
		return false
	} else if (occupation == 'Please Select') {
		$("#Occupation").focus();
		return false
	} else if (name == '') {
		$("#Name").focus();
		return false
	} else if (email == '') {
		$("#email").focus();
		return false
	} else if (mobile == '') {
		$("#Phone").focus();
		return false
	} else if (dob_day == 'DD') {
		$("#day").focus();
		return false
	} else if (dob_month == 'MM') {
		$("#month").focus();
		return false
	} else if (dob_year == 'YYYY') {
		$("#year").focus();
		return false
	} else if(check.checked == false){
		    alert('You must agree to Terms & Conditions.');
		    return false;
    }
	return true;
}
function intOnly(e){if(e.value.length>0){e.value=e.value.replace(/[^\d]+/g,"")}}

function validateDiv(div) {
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
function AllowAlphabet() {
	if (!form_validation.Name.value.match(/^[a-zA-Z-,]+(s{0,1}[a-zA-Z-, ])*$/) && form_validation.Name.value != "") {
		form_validation.Name.value = "";
		form_validation.Name.focus();
	}
}
</script>
<style>
.buttom{ background: #FC8505; display: inline-block; padding: 12px 28px 13px; color: #fbf7f7; margin-left:5px;margin-top:0px;text-align:center; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 16px; font-family:Verdana, Geneva, sans-serif;}
.buttom:hover	{ background-color: #2a78f6; }
</style>
<body>
	<div id="second_form">
		<form name="form_validation" id="form1" action="http://www.simply4loans.com" method="post">
			<input type="hidden" name="Type_Loan" value="Personal Loan" />
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
					<input id="Checkbox1" type="checkbox" checked />I agree to<a href="privacypolicy.php"> Privacy Policy</a> and <a href="terms-condition.php"> T&C </a> authorizing Simply4Loans.com and it's partnering Companies to Contact me with reference to financial products overriding any registration for DNC/NDNC.</p>
				</br>
			</div>
			<div class="col-md-12" align="center">
				</br>
				<input class="buttom" name="submit" id="submit" value="Submit" style="margin-bottom:20px;width:120px;" type="button">
				</br>
			</div>
	</form>
	</div>
	</div>
<script type="text/javascript">
function phonenumber(inputtxt)
    {
        var phoneno = /^\d{10}$/;
        if(inputtxt.match(phoneno)){
            $('#phoneAlert').hide();
            return true;
        }else
        {
            $('#phoneAlert').show();
            $('#phoneAlert').html('Please Enter Correct Mobile Number!');
            $('#Phone').focus();
            return false;
        }
    }
function validate_email(txt)
    {
      var emailid =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(txt.match(emailid)){
            $('#emailAlert').hide();
            $('#Phone').focus();
            return true;
        }
        else{
            $('#emailAlert').show();
            $('#emailAlert').html('Please Enter valid Email Id!');
            $('#email').focus();
            return false;
        }
    }
function mob_check() {
	if ((document.form_validation.Phone.value.charAt(0) != "9") && (document.form_validation.Phone.value.charAt(0) != "8") && (document.form_validation.Phone.value.charAt(0) != "7")) {
		document.form_validation.Phone.value = "";
		document.getElementById('phoneAlert').innerHTML = "<span style='color:red'>should start with 9 or 8 or 7!</span>";
		document.form_validation.Phone.focus();
		return false;
	}
	document.getElementById('phoneAlert').innerHTML = "<span style='color:green'>Great!</span>";
	return true;
}
</script>