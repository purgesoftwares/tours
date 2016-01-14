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
					url: "<?php echo $this->Html->url(array('plugin' => 'transaction','controller' => 'transactions','action' => 'mark_completed')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							// $( this ).dialog( "close" );
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
					$(this).dialog("close");
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
	$( "#paid_message_div").dialog({
	
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'transaction','controller' => 'transactions','action' => 'mark_paid')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							// $( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							/* $('#delete_'+user_id).closest('tr').find('td').fadeOut('slow', 
								function(here){ 
									$(here).parents('tr:first').remove();                    
								});  */
								window.location = '';
						}
					}
				});
				$(this).dialog("close");
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
		user_id	=	$(obj).attr('id').replace("complete_","");
		$( "#show_message_div").empty().html(msg);
		$( "#show_message_div").dialog('open');return false;
		
	} 
	
function paid_message(msg,obj){
		user_id	=	$(obj).attr('id').replace("paid_","");
		$( "#paid_message_div").empty().html(msg);
		$( "#paid_message_div").dialog('open');return false;
		
	} 
	
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}

</script>
<div id='show_message_div'></div>
<div id='paid_message_div'></div>
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
									<?php if(AuthComponent::user('user_role_id')!=4){ ?>
										<?php 
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('plugin'=>'transaction','controller'=>'transactions','action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
											}
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));
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
											<th><?php echo __('Out'); ?></th>
											<th><?php echo __('Profit'); ?></th>
											<th><?php echo __('Status'); ?></th>
											<th><?php echo __('Created'); ?></th>
											<?php if(AuthComponent::user('user_role_id')!=4){ ?>
											<th><?php echo __('Actions'); ?></th>
											<?php } ?>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										// pr($result);
										foreach( $result as $records ) { 
										?>
										<tr>
											<td><?php echo $records[$model]['order_id']; ?></td>
											<td><?php echo $records[$model]['invoiceNR']; ?></td>
											<td><?php echo $records['Seller']['first_name']; ?></td>
											<td><?php echo $records['Transporter']['first_name']; ?></td>
											<td><?php echo $records[$model]['money_in'].$records[$model]['currency']; ?></td>
											<td><?php echo $records[$model]['money_out'].$records[$model]['currency']; ?></td>
											<td><?php echo $records[$model]['profit'].$records[$model]['currency']; ?></td>
											<td><?php echo ($records[$model]['status'])?(($records[$model]['paid'])?"Paid":"Active"):"Canceled"; ?></td>
											<td ><?php 
												echo $records[$model]['created'];
											 ?></td>
											<?php if(AuthComponent::user('user_role_id')!=4){ ?>
											<td>
												<a href="<?php echo $this->Html->url(array('action' => 'edit',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Edit'); ?>"><i class="icon-edit"></i></a>
												<?php if(authComponent::user('user_role_id')==Configure::read('user_role_id.admin')){ ?>
												<?php if(!$records[$model]['paid']){ ?>
												<a style ="margin-top:5px;" href='javascript::void(0)' onclick='return paid_message("<?php echo __('Are you sure you want to mark as paid this transaction?'); ?>",this);' id='paid_<?php echo $records[$model]['id']; ?>' class="btn" rel="tooltip" title="<?php echo __('Mark As Paid'); ?>"><i class="icon-ok icon-white"></i></a>
												<?php } ?>
												<a style ="margin-top:5px;" href='javascript::void(0)' onclick='return show_message("<?php echo __('Are you sure you want to complete this transaction?'); ?>",this);' id='complete_<?php echo $records[$model]['id']; ?>' class="btn" rel="tooltip" title="<?php echo __('Mark As Completed'); ?>"><i class="icon-ok-sign icon-white"></i></a>
												
												
												<?php } ?>
												<?php echo $this->Html->link('<i class="icon-envelope icon-white"></i>',array('action'=>'generate_order_pdf',$records[$model]['id']),array('class'=>'btn','rel'=>'tooltip','title'=>'Send Order PDF','style'=>'margin-top:5px;','escape'=>false)); ?>
												<a style ="margin-top:5px;" href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this transaction?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
												
												
											</td>
											<?php } ?>
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>