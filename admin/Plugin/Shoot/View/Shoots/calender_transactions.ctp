<style>
/* .fc-event{ font-size:1.34em;} */
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
										<?php 
											// echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('plugin'=>'transaction','controller'=>'transactions','action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
											 // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));
											//echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));		
										?> 
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
																
										$('#calendar').fullCalendar({

														eventSources: [

															// your event source
															{
																events: [ // put the array in the `events` property
																	<?php if(!empty($result)){
																		foreach($result as $event){ ?>
																		{
																			title : '<?php echo $event[$model]['order_id'].' +'.$event[$model]['money_in'].$event[$model]['currency']; ?>',
																			start  : '<?php echo date('Y-m-d',strtotime($event[$model]['seller_pay_date'])); ?>',
																			url :'<?php echo $this->Html->url(array('plugin'=>'transaction','controller'=>'transactions','action'=>'view_transaction',$event[$model]['order_id'])); ?>'
																		},
																		
																	<?php	}
																	} ?>
													
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
																	<?php if(!empty($transporter_result)){
																		foreach($transporter_result as $event){ ?>
																		{
																			title : '<?php echo $event[$model]['order_id'].' -'.$event[$model]['money_out'].$event[$model]['currency']; ?>',
																			start  : '<?php echo date('Y-m-d',strtotime($event[$model]['transporter_pay_date'])); ?>',
																			url :'<?php echo $this->Html->url(array('plugin'=>'transaction','controller'=>'transactions','action'=>'view_transaction',$event[$model]['order_id'])); ?>'
																		},
																	<?php	}
																	} ?>
													
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
															  'data' : {'title':event.title,'date':event.start.getDate()+'-'+ (event.start.getMonth()+1)+'-'+ event.start.getFullYear() },
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

									});
								</script>
							</div>
						</div>
					</div>
				</div>