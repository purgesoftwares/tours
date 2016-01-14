<style>
.form-horizontal .control-label{width:90%}
</style>
<script>

	$(document).ready(function(){
		$("input[type=radio]").on("click",function(){
			
			if($("#PaymentTypePaypal").prop('checked')==true){
				$("#credit_card").hide();
				$("#paypal").show();
			}else{
				$("#paypal").hide();
				$("#credit_card").show();
			
			}
		});
		
		$("#paymentPayForm").on("submit",function(){
			if($("#CreditCardNumber").val() && $("#CreditCardExpirationMonthMonth").val() && $("#CreditCardExpirationYearYear").val() && $("#BillingFirstName").val() && $("#BillingLastName").val() && $("#BillingAddress").val() && $("#BillingCity").val() && $("#BillingState").val() && $("#BillingZip").val()){
				$.ajax({
					'url':"<?php echo $this->Html->url(array('plugin'=>'invoice','controller'=>'invoices','action'=>'pay_cc'));?>",
					'type':'post',
					'data':$("#paymentPayForm").serialize(),
					'dataType':'json',
					'success':function(r){
						if(r.success){
							alert(r.message+" You will now be redirected to your account");
							setTimeout(function(){ window.location = "<?php echo $this->Html->url(array("plugin"=>"invoice",'controller'=>"invoices",'action'=>"view",$id)); ?>"; }, 1000);
						}else{
							alert(r.message);
						}
					}
				});
			}else{
				alert("Please Fill the form with valid information");
			}
		});
	});

</script>
<div class="row-fluid" >
					<div class="span12" style="font-size:32px;">
	<table cellpadding="10px">
		<tr>
			<td>
				<?php echo $this->Html->image("MasterCard_Logo.svg.png",array('width'=>"130px")); ?>
			</td>
			<td>
				<?php echo $this->Html->image("Visa-Card-With-High-balance-small.jpg",array('width'=>"130px")); ?>
			</td>
			<td>
				<?php echo $this->Html->image("american-express.png",array('width'=>"130px")); ?>
			</td>
			<td>
				<?php echo $this->Html->image("Paypal.jpg",array('width'=>"130px")); ?>
			</td>
		</tr>
		<tr>
			<td align="center" >
				<?php echo $this->Form->radio("payment_type",array('master_card'=>"Master Card"),array("legend"=>false,"checked"=>"checked")); ?>
			</td  >
			<td align="center" >
				<?php echo $this->Form->radio("payment_type",array('visa'=>"Visa"),array("legend"=>false)); ?>
			</td>
			<td align="center" >
				<?php echo $this->Form->radio("payment_type",array('american_express'=>"American Express"),array("legend"=>false)); ?>
			</td>
			<td align="center" >
				<?php echo $this->Form->radio("payment_type",array('paypal'=>"Paypal"),array("legend"=>false)); ?>
			</td>
		</tr>
		
	</table>
</div>
</div>
<br/>
<div class="row-fluid" id="paypal" style="display:none;">
		<div class="span12">  
			  <div class="control-group ">
				
				<div class="span4">
				</div>
				<div class="span5">
				<div class="controls">
				<br/>
			<br/>
					<?php echo $this->Html->link("Pay & Continue",array('action'=>'do_payment',base64_encode($id)),array("class"=>"btn btn-primary")); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
</div>
<div class="row-fluid" id="credit_card">

	<?php 
	// echo $this->Form->create("payment",array("url"=>array("plugin"=>"invoice","controller"=>"invoices",'action'=>"pay_cc")));
	echo $this->Form->create("payment",array("url"=>"javascript:void(0);","class"=>"form-validate form-horizontal"));
		echo $this->Form->hidden('id',array("value"=>$id));
	?>
		<div class="span12">
			<div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label($model.".amount", __('<b>Payment Amount</b>').": ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php 
							$remailing_amount = $this->data[$model]['total']-$this->data[$model]['discount_amount']-$this->data[$model]['paid'];
							echo "$".$remailing_amount ?>
				</div>
				</div>
			  </div>
			</div>  
			  <h4>Billing Information</h4>
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("CreditCard.number", __('Card Number').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->text("CreditCard.number",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true,'data-rule-number'=>true)); ?>
				</div>
				</div>
			  </div>
			 </div>
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("CreditCard.expiration", __('Expiration Date').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->month("CreditCard.expiration.month",array("empty"=>"Month",'monthNames' => false,"style"=>"width:105px","class"=>"control-label",'escape'=>false,'data-rule-required'=>true,'data-rule-number'=>true)); ?>
					<?php echo $this->Form->year("CreditCard.expiration.year",date("Y"),date("Y")+15,array("empty"=>"Year","style"=>"width:110px","class"=>"control-label",'escape'=>false,'data-rule-required'=>true,'data-rule-number'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			<h4>Billing Address</h4>
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.first_name", __('First Name').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->text("Billing.first_name",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.last_name", __('Last Name').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->text("Billing.last_name",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.address", __('Address').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->textarea("Billing.address",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.city", __('City').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->text("Billing.city",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.state", __('State').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->select("Billing.state",$states,array("empty"=>"Select State","class"=>"control-label",'escape'=>false,'data-rule-required'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			<div class="span12">  
			  <div class="control-group ">
				<div class="span3">
				<?php echo $this->Form->label("Billing.zip", __('Zip Code').":* ",array("class"=>"control-label",'escape'=>false)); ?>
				</div>
				<div class="span5">
				<div class="controls">
					<?php echo $this->Form->text("Billing.zip",array("class"=>"control-label",'escape'=>false,'data-rule-required'=>true,'data-rule-number'=>true)); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			<br/>
			
			<div class="span12">  
			  <div class="control-group ">
				
				<div class="span4">
				</div>
				<div class="span5">
				<div class="controls">
				<br/>
			<br/>
					<?php echo $this->Form->submit("Pay & Continue",array("class"=>"btn btn-primary")); ?>
				</div>
				</div>
			  </div>
			  		
			</div>
			
			
</div>