      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <h3><i class="fa fa-angle-right"></i> Add Filter</h3>

		<?php $id = $_GET['id']; ?>
		
      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
           <?php $attributes = array('class' => 'form-horizontal style-form'); 
           echo form_open('admin/filter/add_filter?id='.$id, $attributes); ?>
           <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Filter Name</label>
            <div class="col-sm-10">
				<?php echo form_error('FilterName'); ?>
				<input type="text" name="FilterName" value="<?php echo set_value('FilterName'); ?>"  class="form-input" placeholder="John Doe">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Add City</label>
            <div class="col-sm-10">
				<?php echo form_error('city'); ?>
				<select name="city[]" id="city" class='form-dropdown' multiple="multiple" size="5">  
					 <option value="0">Select City</option>  
					 <?php foreach($cities as $result_data) : ?>
						<option value="<?php echo $result_data->city; ?>"><?php echo $result_data->city; ?></option>
					 <?php endforeach; ?>
				</select> 
				
            </div>
          </div>

		<input type="hidden" name="agents[]" id="agents" value="0" class='form-dropdown' />



          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Min Age :</label>
            <div class="col-sm-3">
				<?php echo form_error('min_age'); ?>
				<input type="text" name="min_age" value="<?php echo set_value('min_age'); ?>"  class="salary-dropdown" placeholder="Min Age">
            </div>
            <label class="col-sm-2 col-sm-2 control-label">Max Age :</label>
            <div class="col-sm-3">
				<?php echo form_error('max_age'); ?>
				<input type="text" name="max_age" value="<?php echo set_value('max_age'); ?>"  class="salary-dropdown" placeholder="Max Age">
            </div>
          </div>
          <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Income :</label>
        <div class="col-sm-10">
          <?php echo form_error('income'); ?>
          <input type="text" name="income" id="income_id" class="form-input" placeholder="Income" onkeypress="return income_number_validation(this.value);" />
          <span id="income_in_word"></span>
        </div>

      </div>
      <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Min Loan Amount :</label>
        <div class="col-sm-10">
          <?php echo form_error('income'); ?>
          <input type="text" name="min_loan_amount" id="min_loan_amount" class="form-input" onkeypress="return income_number_validation(this.value);" placeholder="min_loan_amount" />
          <span id="income_in_word"></span>
        </div>

      </div>
          
          <input type="hidden" name="verification" id="verification" value="CV" />
        <?php 
        $products = array(
		  'Personal Loan',
		  'Home Loan',          
          'Loan Against Property',
		  'Car Loan',          
          'Education Loan',
		  'Gold Loan',
		  'Credit Cards'
          );
          ?>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Add Product : </label>
          <div class="col-sm-10">
            <?php echo form_error('product'); ?>
            <select name="product[]" id="product" class='form-dropdown' multiple="multiple">  
             <option value="0">Select Product</option> 
             <?php foreach($products as $result_data) : ?>
            <option value="<?php echo $result_data; ?>" ><?php echo $result_data; ?></option>
          <?php endforeach; ?>
        </select> 
      </div>
    </div>
    
                <?php 
        $employeement_status = array(
		  'Salaried',
		  'Professionals',          
          'Self Employed'
          );
		  		

          ?>
    <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Employment Status : </label>
          <div class="col-sm-10">
            <?php echo form_error('employeement_status'); ?>
            <select name="employeement_status[]" id="employeement_status" class='form-dropdown' multiple="multiple" >  
             <option value="0">Select Employment Status</option> 
             <?php $productdata = explode(',',$rows->employeement_status); ?>
             <?php foreach($employeement_status as $result_data) : ?>
             <?php if(in_array($result_data,$productdata)){
              ?>
              <option value="<?php echo $result_data; ?>" selected><?php echo $result_data; ?></option>
              <?php 
            }else{ ?>
            <option value="<?php echo $result_data; ?>" ><?php echo $result_data; ?></option>
            <?php } ?>
          <?php endforeach; ?>
        </select> 
      </div>
    </div>
    
     <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Disable Filter : </label>
            <div class="col-sm-10">
            <?php echo form_error('disable_filter'); ?>
             <input type="checkbox" class='form-checkbox' name="disable_filter"> 
            </div>
          </div>

          <input type="hidden" name="user_id" id="user_id" value="<?php echo $_GET['id'];  ?>" />
          <button type="submit" class="btn btn-theme">Add Filter</button>
        </form>
      </div>
    </div><!-- col-lg-12-->      	
    </div><!-- /row -->
  
  <script>

$(document).ready(function(){
var x;	
$("#income_id").keyup(function(){
	var str_array="";
	var str=$("#income_id").val();
 //var str='1,2345678';
	 
	var str_array = str.split(',');
	var countArray=str_array.length;
	if(countArray<5){
	if(countArray>1){
		 x=str.replace(',','');
		 //console.log(x);
		}else {
		 x=str;
			}
	//console.log(str);
x=x.replace(',','');	
//var x=123456783;
x=x.toString();
var lastThree = x.substring(x.length-3);
var otherNumbers = x.substring(0,x.length-3);
if(otherNumbers != '')
    lastThree = ',' + lastThree;
var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
var rest=inWords1(x);
//console.log(rest);
$('#income_in_word').html(rest);
document.getElementById('income_id').value=res;
	}
	});
});	
	
	
$(document).ready(function(){
var x;	
$("#min_loan_amount").keyup(function(){
	var str_array="";
	var str=$("#min_loan_amount").val();
 //var str='1,2345678';
	 
	var str_array = str.split(',');
	var countArray=str_array.length;
	if(countArray<5){
	if(countArray>1){
		 x=str.replace(',','');
		 //console.log(x);
		}else {
		 x=str;
			}
	//console.log(str);
x=x.replace(',','');	
//var x=123456783;
x=x.toString();
var lastThree = x.substring(x.length-3);
var otherNumbers = x.substring(0,x.length-3);
if(otherNumbers != '')
    lastThree = ',' + lastThree;
var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
var rest=inWords1(x);
//console.log(rest);
$('#loan_in_word').html(rest);
document.getElementById('min_loan_amount').value=res;
	}
	});
});

	
	
var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];	
	
		function inWords1(num) {
	var num=num.replace(',','');
	//console.log(num);
	    if ((num = num.toString()).length > 9) return 'overflow';
	    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
	    if (!n) return; var str = '';
	    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
	    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
	    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
	    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
	    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
	    //console.log(str);
	    return str;
		//document.geElementById('pase').innerHTML(str);
	}
    
    
function income_number_validation(event){


	var count = event.length;
	console.log(count);
   var keyCode=(window.event.which) ? parseInt(window.event.which) : parseInt(window.event.keyCode);
   	if (count <=9) {
        if (keyCode <= 57 && keyCode >= 48){ //if not a number
            return true; //disable key press
    }
	}else {
		
		return false;
		}
   return false;
}  
    
    </script>