<script>
 product_price_list = <?php echo json_encode($product_price_list); ?>;
 photographer_price_list = <?php echo json_encode($photographer_price_list); ?>;
 client_comment_list = <?php echo json_encode($client_comment_list); ?>;
$(function(){
	// $("#ShootDate").attr("readonly",true);
	
	$.datepicker.setDefaults({dateFormat: 'mm-dd-yy',changeMonth: true,
			  changeYear: true,yearRange: '-100:+100'});
			  
	$("#ShootDate").datepicker({
			dateFormat: 'mm-dd-yy',
			showOn: 'button',
			changeMonth: true,
			changeYear: true,
			buttonImage: '<?php echo WEBSITE_ADMIN_IMG_URL; ?>cal_picker.png',
			buttonImageOnly: true,
			onSelect: function() {
				 $(this).blur();
			}
			  
	});
	
	$("#GalleryDate").datepicker({
			dateFormat: 'mm-dd-yy',
			showOn: 'button',
			changeMonth: true,
			changeYear: true,
			buttonImage: '<?php echo WEBSITE_ADMIN_IMG_URL; ?>cal_picker.png',
			buttonImageOnly: true,
			onSelect: function() {
				 $(this).blur();
			}
			  
	});
	$("#InvoiceDueDate").datepicker({
			dateFormat: 'mm-dd-yy',
			showOn: 'button',
			changeMonth: true,
			changeYear: true,
			buttonImage: '<?php echo WEBSITE_ADMIN_IMG_URL; ?>cal_picker.png',
			buttonImageOnly: true,
			onSelect: function() {
				 $(this).blur();
			}
			  
	});
	
	$('.ui-datepicker-trigger').css({'padding-left':'5px'});
});

</script>
<style>
/* .fc-event{ font-size:1.34em;} */
#add_new_shoot_model{left:40%; width:800px; position:absolute; top:-5%;}
.modal-body{max-height:1650px;}
#ShootTimeHour{width:100px;}
#ShootTimeMin{width:100px;}
#ShootTimeMeridian{width:100px;}
#GalleryTimeHour{width:60px;}
#GalleryTimeMin{width:60px;}
#GalleryTimeMeridian{width:60px;}
</style>
<div class="row-fluid">
		<div class="span12">
		
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						<i class="icon-table"></i>
						<?php echo __($pageHeading,true); ?>
						</h3>
						<div class="pull-right">
							
						</div>
					
				</div>
				<div class="box-content nopadding">
					
					<div id="calendar">
					</div>
					
					
					<script>
						$(document).ready(function(){
						/* eventAfterRender: function(event, element) {
														console.log(element);
														element.qtip({
															content: event.description
														});
													}, */
													
							
							$('#ShootTimeHour').val('10');
							$('#ShootTimeMin').val('00');
							$('#ShootTimeMeridian').val('am');
							$('#GalleryTimeHour').val('10');
							$('#GalleryTimeMin').val('00');
							$('#GalleryTimeMeridian').val('am');
							
							$('#calendar').fullCalendar({
							
										 eventClick: function(calEvent, jsEvent, view) {

													alert('Event: ' + calEvent.title);
													// alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
													// alert('View: ' + view.name);

													// change the border color just for fun
													$(this).css('border-color', 'red');

												},
											dayClick: function(date, jsEvent, view) {

												console.log(date);
												// console.log(jsEvent);
												function pad(s) { return (s < 10) ? '0' + s : s; }
												console.log(view);
												$("#add_new_shoot").css('top',view.clientY+document.documentElement.scrollTop).css('left',view.clientX+10).attr('date',[ pad(date.getMonth()+1),pad(date.getDate()), date.getFullYear()].join('-')).show();
												
												$.ajax({
												  'type':'post',
												  url: '<?php echo $this->Html->url(array('plugin'=>'shoot','controller'=>'shoots','action'=>'get_day_shoots')); ?>',
												  'data' : {'date':[ pad(date.getMonth()+1),pad(date.getDate()), date.getFullYear()].join('-') },
												 'dataType':'html',
												  success: function(response){
													$("#date_shoots").html(response);
												  }
												});
												

											},
												

											eventSources: [

												// your event source
												{
													events: [ // put the array in the `events` property
														<?php  if(!empty($result)){
															foreach($result as $event){
															$date = explode('-',$event[$model]['date']);
															?>
															{
																title : '<?php echo $event[$model]['hour'].':'.$event[$model]['min'].$event[$model]['meridian'].' '.$event[$model]['address_1']; ?>',
																start  : '<?php echo date('Y-m-d',strtotime($date[1].'-'.$date[0].'-'.$date[2])); ?>'
																
															},
															
														<?php	}
														}  ?>
										
													],
													
												eventRender: function(event, element) {
														
														element.qtip({
															content: event.title
														});
													},
													
													color: 'green!important',     // an option!
													textColor: 'white!important' // an option!
												},
												{
													events: [ // put the array in the `events` property
														<?php /* if(!empty($transporter_result)){
															foreach($transporter_result as $event){ ?>
															{
																title : '<?php echo $event[$model]['order_id'].' -'.$event[$model]['money_out'].$event[$model]['currency']; ?>',
																start  : '<?php echo date('Y-m-d',strtotime($event[$model]['transporter_pay_date'])); ?>',
																url :'<?php echo $this->Html->url(array('plugin'=>'transaction','controller'=>'transactions','action'=>'view_transaction',$event[$model]['order_id'])); ?>'
															},
														<?php	}
														}  */?>
										
													],
													
													color: 'red!important',     // an option!
													textColor: 'white!important' // an option!
												}
																
												// any other event sources...

											],
											 editable: true,
											eventDrop: function(event, delta, revertFunc) {
												// console.log(delta);
												// console.log(event);
												
												 $.ajax({
												  'type':'post',
												  url: '<?php echo $this->Html->url(array('plugin'=>'transaction','controller'=>'transactions','action'=>'change_pay_date')); ?>',
												  'data' : {'title':event.title,'date': (event.start.getMonth()+1)+'-'+ event.start.getDate()+'-'+ event.start.getFullYear() },
												 'dataType':'json',
												  success: function(response){
													
												  }
												});
												/* alert(event.title + " was dropped on " + event.start.getDate()+ (event.start.getMonth()+1)+ event.start.getFullYear());

												if (!confirm("Are you sure about this change?")) {
													revertFunc();
												} */

											}
										

										});
										// $("#calendar").fullCalendar( 'renderEvents' );
										
										$('span .fc-event-title').each(function(){
											$(this).html("<b>"+$(this).text()+"</b>");
										});
							
							
							$("#add_new_shoot").on('click',function(){
								$(this).hide();
								
								$("#ShootDate").val($(this).attr('date'));
								$("#add_new_shoot_model").modal('show');
								$("#InvoiceDueDate").val($("#ShootDate").val());
								
								var shoot_date = $("#ShootDate").val();
								shoot_date = shoot_date.split('-');
								shoot_date[1] = parseInt(shoot_date[1])+1;
								if(shoot_date[1]<10){
									shoot_date[1] = '0'+shoot_date[1];
								}
								shoot_date = shoot_date.join('-');
								$("#GalleryDate").val(shoot_date);
								$("#GalleryTimeHour").val($("#ShootTimeHour").val());
								$("#GalleryTimeMin").val($("#ShootTimeMin").val());
								$("#GalleryTimeMeridian").val($("#ShootTimeMeridian").val());
							
							});
							
							$("#ShootAddress1,#ShootAddress2,#ShootCity,#ShootState,#ShootZipcode").on('change',function(){
								
								$("#ShootTitle").val([$("#ShootAddress1").val(),$("#ShootAddress2").val(),$("#ShootCity").val(),$("#ShootState").val(),$("#ShootZipcode").val()].join(' '));
								$("#GalleryGalleryTitle").val([$("#ShootAddress1").val(),$("#ShootAddress2").val()].join(' '));
								
							});
							$("#ShootPrice").val(product_price_list[$("#ShootProductId").val()]);
							$("select[id^='ShootProductId'").on('change',function(){
								var new_price = 0;
								$("select[id^='ShootProductId'").each(function(){ 
									var thprice = parseFloat(product_price_list[$(this).val()]);
									console.log(thprice);
									if( typeof thprice != "undefined" && thprice>0){
										new_price += parseFloat(product_price_list[$(this).val()]);
									}
								});
								$("#ShootPrice").val(new_price);
								
							});
							$("#ShootPrice").on('change',function(e){
								
								var r = confirm("Are you sure you would like to change the shoot price?");
								if (r == true) {
									
								} else {
									$("#ShootPrice").val(product_price_list[$("#ShootProductId").val()]);
									update_product_price();
								}
							});
					
							$("#save_new_shoot").on('click',function(e){
								//for "+$("#ShootDate").val()+"
								var r = confirm("Are you sure you would like to book this shoot on "+$("#ShootDate").val()+"?");
								if (r == true) {
									$("#ShootIndexForm").submit();
								} else {
									return false;
								}
							});
					
							$("#ShootPayment").val(((photographer_price_list[$("#ShootPhotographerId").val()]/100)*$("#ShootPrice").val()).toFixed(2));
							$("#ShootPhotographerId,select[id^='ShootProductId']").on('change',function(){
								$("#ShootPayment").val(((photographer_price_list[$("#ShootPhotographerId").val()]/100)*$("#ShootPrice").val()).toFixed(2));
							});
							// console.log(client_comment_list);
							$("#ShootGlobalComment").val(client_comment_list[$("#ShootClientId").val()]);
							$("#ShootClientId").on('change',function(){
								$("#ShootGlobalComment").val(client_comment_list[$("#ShootClientId").val()]);
							});
							
							$("#InvoiceDueDate").val($("#ShootDate").val());
							
							$("#ShootDate").on('click',function(){
								$("#InvoiceDueDate").val($("#ShootDate").val());
							});
							
							$("#ShootDate,#ShootTimeHour,#ShootTimeMin,#ShootTimeMeridian,#ShootAddress1").on('click',function(){
								
								var shoot_date = $("#ShootDate").val();
								shoot_date = shoot_date.split('-');
								shoot_date[1] = parseInt(shoot_date[1])+1;
								shoot_date = shoot_date.join('-');
								$("#GalleryDate").val(shoot_date);
								$("#GalleryTimeHour").val($("#ShootTimeHour").val());
								$("#GalleryTimeMin").val($("#ShootTimeMin").val());
								$("#GalleryTimeMeridian").val($("#ShootTimeMeridian").val());
							});
							
						});
						
						function update_product_price(){
							var new_price = 0;
								$("select[id^='ShootProductId'").each(function(){ 
									var thprice = parseFloat(product_price_list[$(this).val()]);
									// console.log(thprice);
									if( typeof thprice != "undefined" && thprice>0){
										new_price += parseFloat(product_price_list[$(this).val()]);
									}
								});
								$("#ShootPrice").val(new_price);
						}
					</script>
				<!--<button class="btn" id="add_new_shoot" style="display:none;position:relative;">+ Add New Shoot</button>
				</div>-->
			</div>
			<div id="date_shoots">
						
					</div>
		</div>
	</div>
	
	
	<!-- Modal -->
<div class="modal fade" id="add_new_shoot_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="display:none;">
  <div class="modal-dialog">
  <?php echo $this->Form->create($model,array("class"=>"form-horizontal form-validate",'type'=>'file')); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Shoot Info</h4>
      </div>
      <div class="modal-body">
		
			
			<div class="row-fluid">
				<div class="span12" >
				<div class="control-group <?php echo ($this->Form->error($model.".date"))? "error":"";?>"> <?php echo $this->Form->label($model.".date", __('Date').": ",array("class"=>"control-label")); ?>
					<div class="controls">  <?php echo $this->Form->text($model.".date",array('readonly'=>'readonly','class'=>'',"data-rule-required"=>true)); ?>
					<?php echo $this->Form->input($model.".time",array('type'=>'time','class'=>'')); ?>
					<span class="help-inline"><?php echo $this->Form->error($model.".dob",array("wrap"=>false)); ?></span> </div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<label>Address of shoot</label>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".address_1"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".address_1", __('address 1').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".address_1",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".address_1",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".address_2"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".address_2", __('address 2').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".address_2"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".address_2",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".city"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".city", __('City').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".city",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".city",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".state"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".state", __('State').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".state",$states,array('empty'=>false,"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".state",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".zipcode"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".zipcode", __('Zip Code').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".zipcode",array('class'=>'validate[]',"data-rule-number"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".zipcode",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".title"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".title", __('Shoot Title').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".title",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".title",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".size"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".size", __('Size of Shoot(in sq. ft.)').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".size",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".size",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div id = "products-wrapper">
			<div class="row-fluid">
				<div class="span12" >
					<div class="control-group <?php echo ($this->Form->error($model.".product_id.0"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".product_id.0", __('Product').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".product_id.0",$product_list,array('empty'=>false,"data-rule-required"=>true,'style'=>"float:left")); ?>
						
						
						<i class="icon-plus icon-white" id="add_product" href="#" data-content='Click here to add multiple products to shoot .' rel="popover" data-placement="right" data-trigger="hover" data-num="1" style="float:left; margin:8px;"></i>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".product_id.0",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".price"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".price", __('Shoot Price').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".price",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".price",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".client_id"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".client_id", __('Client').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php 
						$client_list['Add New'] = 'Add New Client';
						// pr($client_list);
						echo $this->Form->select($model.".client_id",$client_list,array('empty'=>"Select Client","data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".client_id",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".photographer_id"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".photographer_id", __('Assign Photographer').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".photographer_id",$photographer_list,array('empty'=>false,"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".photographer_id",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".payment"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".payment", __('Payment').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".payment",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".payment",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".client_present"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".client_present", __('Client Present?').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($model.".client_present",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".client_present",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".combo_code"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".combo_code", __('CBS/Combo Code').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".combo_code",array("data-rule-required"=>false)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".combo_code",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".comment"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".comment", __('Comments').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".comment"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".comment",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".global_comment"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".global_comment", __('Global Comments').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".global_comment",array("rows"=>8)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".global_comment",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<h3>
				 Invoice Info
				</h3>
			<div>
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php 
					$gallery = "Invoice";
					echo ($this->Form->error($gallery.".send_confirmation"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".send_confirmation", __('Send Confirmation').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($gallery.".send_confirmation",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".send_confirmation",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div><div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".create_invoice"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".create_invoice", __('Create Invoice').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($gallery.".create_invoice",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".create_invoice",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div><div class="row-fluid">
				
				<div class="span10" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".due_date"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".due_date", __('Due Date').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($gallery.".due_date",array('readonly'=>'readonly','class'=>'',"data-rule-required"=>true)); ?>
					
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".recipient"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".recipient", __('Recipient').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($gallery.".recipient",array()); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".recipient",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".send_reminder"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".send_reminder", __('Send Reminder').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($gallery.".send_reminder",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".send_reminder",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			</div>
			
			
			
			
			
			
			<div class="row-fluid">
				<h3>
				 Gallery Info
				</h3>
			<div>
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php 
					$gallery = "Gallery";
					echo ($this->Form->error($gallery.".create_gallery"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".create_gallery", __('Create Gallery').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($gallery.".create_gallery",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".create_gallery",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div><div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".title"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".title", __('Gallery Title').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($gallery.".gallery_title"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".title",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div><div class="row-fluid">
				
				<div class="span10" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".date"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".date", __('Release Date/Time').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($gallery.".date",array('readonly'=>'readonly','class'=>'',"data-rule-required"=>true)); ?>
					<?php echo $this->Form->input($gallery.".time",array('type'=>'time','class'=>'')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".date",array("wrap"=>false)); ?>
						<?php echo $this->Form->error($gallery.".time",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".require_payment_for_access"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".require_payment_for_access", __('Require Payment for Access').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($gallery.".require_payment_for_access",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".require_payment_for_access",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				
				<div class="span5" style="margin-left:40px;" >
					<div class="control-group <?php echo ($this->Form->error($gallery.".recipient"))? "error":"";?>"> 
						<?php echo $this->Form->label($gallery.".recipient", __('Recipient').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($gallery.".recipient",array()); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($gallery.".recipient",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
		
       
			
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-default close_button" >Cancel</a>
		<?php //echo $this->Form->submit('Save',array('class'=>'btn btn-primary','id'=>'save_a_new_shoot')); ?>
        <button type="button" class="btn btn-primary" id="save_new_shoot" >Save</button>
      </div>
    </div>
	<?php echo $this->Form->end(); ?>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_client_modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Client?</h4>
      </div>
      <div class="modal-body">
		<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".first_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".first_name", __('First Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".first_name",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".first_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".last_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".last_name", __('Last Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".last_name",array("data-rule-required"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".last_name",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div> 
			
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".telephone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".telephone", __('Phone').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".telephone",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".telephone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".email"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".email", __('Email').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".email",array('class'=>'validate[required,custom[email]]',"data-rule-required"=>true,"data-rule-email"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".email",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".password"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".password", __('Password').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".password",array('class'=>'validate[required]','value'=>$autopassword,"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".password",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_new_client_button" >Yes</button>
        <button type="button" class="btn btn-default close_client_modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_contact_modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myContactModalLabel">Add New Contact?</h4>
      </div>
      <div class="modal-body">
		<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("Contact.first_name"))? "error":"";?>"> 
						<?php echo $this->Form->label("Contact.first_name", __('First Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text("Contact.first_name",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						
						<span class="help-inline">
						<?php echo $this->Form->error("Contact.first_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("Contact.last_name"))? "error":"";?>"> 
						<?php echo $this->Form->label("Contact.last_name", __('Last Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text("Contact.last_name",array("data-rule-required"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error("Contact.last_name",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div> 
			
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("Contact.telephone"))? "error":"";?>"> 
						<?php echo $this->Form->label("Contact.telephone", __('Phone').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text("Contact.telephone",array("data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error("Contact.telephone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("Contact.email"))? "error":"";?>"> 
						<?php echo $this->Form->label("Contact.email", __('Email').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text("Contact.email",array('class'=>'validate[required,custom[email]]',"data-rule-required"=>true,"data-rule-email"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error("Contact.email",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("Contact.password"))? "error":"";?>"> 
						<?php echo $this->Form->label("Contact.password", __('Password').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text("Contact.password",array('class'=>'validate[required]','value'=>$autopassword,"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error("Contact.password",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_new_contact_button" >Yes</button>
        <button type="button" class="btn btn-default close_contact_modal">No</button>
      </div>
    </div>
  </div>
</div>




<script>
	
	$(document).ready(function(){
	
		$(".close,.close_button").on('click',function(){
			
			var r = confirm("Are you sure, you would like to clear it?");
			if (r == true) {
				$('#add_new_shoot_model').modal('hide');
				$("#ShootIndexForm input").val('');
			} else {
				return false;
			}
			
		});
	
		$("#ShootClientId").on('click',function(){
			if($(this).val() == 'Add New'){
				
				$('#addTypeModal').modal('show');
				
				
				
			}
		});
		
		$("#InvoiceRecipient,#GalleryRecipient").on('click',function(){
			if($(this).val() == 'Add New Contact'){
				
				$('#addContactModal').modal('show');
				
				
				
			}
		});
		
		
	$("#save_new_client_button").on('click',function(){
		
		$("span.ajax_re_error").remove();
		
		$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>"usermgmt",'controller'=>'clients','action'=>'addandget_client'));?>",
				'type':'post',
				'data':{'first_name':$("#ShootFirstName").val(), 'last_name':$("#ShootLastName").val(), 'telephone':$("#ShootTelephone").val(), 'email':$("#ShootEmail").val(), 'password':$("#ShootPassword").val() },
				'dataType':'json',
				'success':function(response){
					if(response.status){
						options	="";
						$.each(response.clients, function(value,name){
							options+="<option value='"+value+"'>"+name+"</options>";
						});
							options+="<option value='Add New'>Add New</options>";
						$("#ShootClientId").html(options);
						
						$("#ShootClientId").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
						
						$("#ShootClientId").val($("#ShootFirstName").val());
						$('#addTypeModal').modal('hide');
						
					}else{
						$("#ShootFirstName").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
					}
					
				}
			});
	
	});
	
	$("#save_new_contact_button").on('click',function(){
		
		$("span.ajax_re_error").remove();
		
		$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>"usermgmt",'controller'=>'clients','action'=>'addandget_contact'));?>",
				'type':'post',
				'data':{'first_name':$("#ContactFirstName").val(), 'last_name':$("#ContactLastName").val(), 'telephone':$("#ContactTelephone").val(), 'email':$("#ContactEmail").val(), 'password':$("#ContactPassword").val(),'parent_id': $("#ShootClientId").val()},
				'dataType':'json',
				'success':function(response){
					if(response.status){
						options	="";
						$.each(response.clients, function(value,name){
							options+="<option value='"+value+"'>"+name+"</options>";
						});
							options+="<option value='Add New Contact'>Add New Contact</options>";
						$("#GalleryRecipient").html(options);
						$("#InvoiceRecipient").html(options);
						
						$("#GalleryRecipient").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
						$("#InvoiceRecipient").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
						
						$("#GalleryRecipient").val($("#ContactFirstName").val()+' '+$("#ContactLastName").val());
						$("#InvoiceRecipient").val($("#ContactFirstName").val()+' '+$("#ContactLastName").val());
						$('#addContactModal').modal('hide');
						
					}else{
						$("#ContactEmail").after('<span class="help-inline ajax_re_error" style="color:red;">'+response.message+'</span>');
					}
					
				}
			});
	
	});
	
	
	$("#add_product").on('click',function(){
		
		
		num = $(this).data("num");
		$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>"shoot",'controller'=>'shoots','action'=>'add_product'));?>/"+num,
				'type':'get',
			
				'dataType':'html',
				'success':function(response){
					$("#products-wrapper").append(response);
					$("#add_product").data("num",num+1);
				}
			});
	
	});
	
		
		$(".close_client_modal").on('click',function(){
			$('#addTypeModal').modal('hide');
		});
		$(".close_contact_modal").on('click',function(){
			$('#addContactModal').modal('hide');
		});
		$("#ShootClientId").on('change',function(){
			
			$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>'usermgmt','controller'=>'clients','action'=>'get_contacts'));?>/"+$(this).val(),
				'type':'post',
				'dataType':'json',
				'success':function(contact_list){
					options	="";
					$.each(contact_list, function(value,name){
						options+="<option value='"+value+"'>"+name+"</options>";
					});
					options+="<option value='Add New Contact'>Add New Contact</options>";
					$("#GalleryRecipient").html(options);
					$("#InvoiceRecipient").html(options);
				}
			});
		
		});
		
	});
	
</script>