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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'partners','action' => 'status_inactive')); ?>",
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
					url: "<?php echo $this->Html->url(array('plugin' => 'district','controller' => 'districts','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
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
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('plugin'=>'district','controller'=>'districts','action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
											
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
											
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));
										?> 
									</div>
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('District Name'); ?></th>
											<th><?php echo __('Created'); ?></th>
											<th><?php echo __('Action'); ?></th>
											
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
											<td><?php echo utf8_encode($records[$model]['name']);?></td>
											<td class='hidden-1024'><?php echo date("m/d/Y",$records[$model]['created']);  ?></td>
											<td class='hidden-480'>
												<a href="<?php echo $this->Html->url(array('action' => 'edit',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Edit'); ?>"><i class="icon-edit"></i></a>												
												<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this district?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
												
											</td>
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>