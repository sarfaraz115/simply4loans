<div id="headerwrap">	
  <div style="margin:20px;text-align:justify;">
	<p style="font-size:25px;font-weight:bold;margin-bottom:20px;">Apply Home Loan Transfer</p>
<div style="clear:both;"></div>
			<div class="row" style="background-color:#fff;padding-top:20px;">
			<div class="col-md-10 col-md-offset-1" ><?php include('application/views/form.php'); ?>
</div>
</div>
    <div class="container">
    
    <div class="row  www" style="margin-top:40px;">
 				<div class="col-md-4 col-sm-4 " >
 					<div class="col-md-12" >
 					<a href="#tab_1_1" data-toggle="tab" title="Home Loan Transfer Guide"><h4 class="head-bg1 active">Home Loan Transfer Guide</h4></a>
 				</div></div>
 				<div class="col-md-3 col-sm-3 ">
 					<div class="col-md-12" >
 					<a href="#tab_1_2" data-toggle="tab" title="Blogs/Articles"><h4 class="head-bg2 ">Blogs/ Articles</h4> </a>       
 				</div></div>
 				<div class="col-md-3 col-sm-3 ">
 				<div class="col-md-12" >
 					<a href="#tab_1_3" data-toggle="tab" title="FAQ's"><h4 class="head-bg3 ">FAQ's</h4></a>
 				</div>		 </div>					
	 		</div>
         <div class="row right-click" style="width:100%;">
      
         <div class="col-md-12 col-sm-12 " style="background-color:#fff; padding:10px; width:100;">
         <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1" style="text-align:left; padding-left:18px; font-size:13px; height:400px; overflow:auto;">
																		<p >Home loan transfer, also popularly known as balance transfer is considered to be easiest way to reduce your interest payout on the existing loan. In simpler words it means, transferring your loan from your existing lender (bank) to another lender (bank) for a better interest rate offered.</p>

																		<p>This is very popular in Home Loan particularly as they are of substantial size running in lacs to crores. Hence for a usual tenure of 20 years, the total interest payout becomes very high and hence attracts borrower's interest every time he/she looks at the loan statement.</p>

																		<p>Home loan rates nowadays varies anywhere between 9 to 12% so it does make sense to either renegotiate rate of interest with your existing bank or transfer  it to other bank offering a better rate.</p>
																		<p>However, one need to do a cost benefit analysis. Not always a rate reduction balance transfer will make economic sense. If your existing loan has very low tenure left or the the difference in the new rate and existing rate is not very high, such transfer can be a loss of money  wasted in transaction.</p>

																		<p>The other bank consider your balance transfer as a fresh only so there would be processing fee involved & documentation fee. Also, in EMI concept initial EMI has higher proportion of interest and proportion of principal keeps increasing as you continue on payments. Hence in case of low tenure remaining, most of your EMI is going in payment of your principal taken. At this moment, taking a balance transfer will be a calculated stupidity. Home loan transfer works best when one is in his/her initial period of home loan.</p>

																		<p><strong>Benefits:</strong></p>
																		<p><ul style="padding-left:15px;">
																			<li>Reduction in interest rate of loan which leads to direct savings</li>
																			<li>It can also sometime help you shift from your existing bank whose customer services are  very poor to another bank/lender with better services & offers</li>
																			</ul>
																			</p>
																			<b>Eligibility & Documentation</b>
																			<p>Since the balance transfer is considered as the fresh loan by the other bank, its documentation & eligibility remains the same as normal home loan.
																			</p>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2" style="text-align:left; padding-left:18px; font-size:13px;">
                                                       <!--<p>
                                                       <ul style="list-style-type:none; font-size:13px;">
                                                      <li><b style="font-size:14px;">Credit Card: What All to Look At</b></li>
                                                      <li><b>Which Credit Card to Choose for Shopping?</b></li>
                                                      <li>With hundreds of credit cards available, it is a difficult to choose the right one.<a href="#">Read more</a>
                                                       </li>
                                                      <li><b>6 Reasons Why Your Credit Card Application Can be Rejected </b></li>
                                                      <li>Are you wondering why your credit card application was denied? Dont expect the card issuer to call you and explain the reasons for the refusal.<a href="#">Read more</a></li>
                                                      <li><b>Top 5 Credit Cards with Zero Annual Fees</b></li>
                                                      <li>Gone are the days when having a credit card and flaunting it among your peers and relatives was a sign of high status.<a href="#">Read more</a></li>
                                                      
                                                       </ul>
                                                       </p>-->
                                                       
                                                       
                                                       
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3"  style="text-align:left; padding-left:18px; font-size:13px;">
                                                        <p>
                                                         <ul style="list-style-type:none; font-size:13px;">
                                                         <li><b>Can one transfer loan to any bank?</b></li>
                                                           <li>Yes, one can. But you should meet the eligibility criteria of the bank where you want to transfer the loan. If a bank doesn't give home loan to a particular location, it may not even take the balance transfer for the property in that location</li>
													        <br />
                                                         <li><b>How long does it take to transfer home loan from one to another bank?</b></li>
                                                         <p></p>
														 <li>Home loan transfer is a cumbersome process. One has to take NOC from existing bank, then do complete documentation with the new bank. Hence, one should ensure that there is sufficient saving happening through these efforts in the long run.</li>
														 </ul>
                                                        </p>
                                                        
                                                    </div>
                                                   </div>
                                            </div>
         
         </div>
         </div>
         </div>
         </div>
         </div>

<script>

 $(function(){
        $("#submit").click(function(event){
            event.preventDefault();

var url="http://www.simply4loans.com/index.php/MainController/addLoanDetails";
            $.ajax({
                    url:url,
                    type:'POST',
                    data:$("#form1").serialize(),
                    success:function(result){
                    if(result){
                     $("#second_form").hide();
                    $("#second_form1").html(result);
                    
                       console.log(result);
			}else{
			 $("#second_form").show();
			}
                    }

            });
        });
    });
</script>
