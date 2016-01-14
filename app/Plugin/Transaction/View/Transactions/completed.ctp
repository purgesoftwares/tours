<script language="javascript">
$(function(){
	var Message	=	'<?php echo __('Confirmation'); ?>';
	$( "#show_message_div").dialog({
	
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'transaction','controller' => 'transactions','action' => 'status_inactive')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							window.location.reload(true);
						}
					}
				});
					$(this).dialog("close");
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
	$( "#delete_user_div").dialog({
			
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'transaction','controller' => 'transactions','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							
							$('#delete_'+user_id).closest('tr').find('td').fadeOut('slow', 
								function(here){ 
									$(here).parents('tr:first').remove();                    
								}); 
							
						}
					}
				});
					$(this).dialog("close");
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
});


function show_message(msg,obj){
		user_id	=	$(obj).attr('id').replace("inactive_","");
		$( "#show_message_div").empty().html(msg);
		$( "#show_message_div").dialog('open');return false;
		
	} 
	
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}

</script>
<div id='show_message_div'></div>
<div id='delete_user_div'></div>
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
											//echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('plugin'=>'transaction','controller'=>'transactions','action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
											 echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport_completed'),array('class'=>'btn btn-primary','escape'=>false));
											//echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));		
										?> 
									</div>
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('O.N.'); ?></th>
											<th><?php echo __('Invoice'); ?></th>
											<th><?php echo __('Seller'); ?></th>
											<th><?php echo __('Transporter'); ?></th>
											<th><?php echo __('Money in'); ?></th>
											<th><?php echo __('Money out'); ?></th>
											<th><?php echo __('Profit'); ?></th>
											<th class='hidden-480' ><?php echo __('Completed'); ?></th>
											<th class='hidden-480' ><?php echo __('Added By'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										//pr($records);
										?>
										<tr>
											<td><?php echo $records[$model]['order_id']; ?></td>
											<td><?php echo $records[$model]['invoiceNR']; ?></td>
											<td><?php echo $records['Seller']['first_name']; ?></td>
											<td><?php echo $records['Transporter']['first_name']; ?></td>
											<td><?php echo $records[$model]['money_in'].$records[$model]['currency']; ?></td>
											<td><?php echo $records[$model]['money_out'].$records[$model]['currency']; ?></td>
											<td><?php echo $records[$model]['profit'].$records[$model]['currency']; ?></td>
												<td class='hidden-480'>
												<?php echo date('d-m-Y',$records[$model]['complete_date']); ?>
											</td>
											<td class='hidden-480'>
												<?php echo $records['Employee']['first_name'].' '.$records['Employee']['last_name']; ?>
											</td>
										
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>