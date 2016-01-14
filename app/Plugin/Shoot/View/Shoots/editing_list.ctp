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
											 // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport_completed'),array('class'=>'btn btn-primary','escape'=>false));
											//echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));		
										?> 
									</div>
								
							</div>
							<div class="box-content nopadding">
								<div class="pull-right" style="padding:10px;">
									<?php echo $this->Form->select('month',$al_months,array('empty'=>"Select Month","id"=>"select_month",'style'=>'float:left;','value'=>$search_month)).'&nbsp;'; ?>&nbsp;
									<?php echo '&nbsp;'.$this->Form->label('status',"Status: ",array('style'=>'float:left;margin-left:10px')); ?>
									<?php echo $this->Form->select('status',Configure::read('shoot_status'),array('empty'=>"ALL","id"=>"select_status",'value'=>$search_status)); ?>
								
								</div>
								<br>
								<br>
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Due date'); ?></th>
											<th><?php echo __('Time'); ?></th>
											<th><?php echo __('Shoot Title'); ?></th>
											<th><?php echo __('Photographer'); ?></th>
											<th><?php echo __('Status'); ?></th>
											<th><?php echo __('Editing Time'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										// pr($records);
										?>
										<tr>
											<td><?php echo $records[$model]['date']; ?></td>
											<td><?php echo $records[$model]['hour'].":".$records[$model]['min'].strtoupper($records[$model]['meridian']); ?></td>
											<td><?php echo $records[$model]['title']; ?></td>
											<td><?php echo $records['Photographer']['first_name']; ?></td>
											<td><?php echo $this->Form->select($records[$model]['id'].'.status',Configure::read('shoot_status'),array('empty'=>false,"value"=>$records[$model]['status'],'id'=>'status_'.$records[$model]['id'],'data-id'=>$records[$model]['id'])); ?></td>
											<td><?php echo $this->Form->text($records[$model]['id'].'.editing_time',array('style'=>'width:100px;','placeholder'=>'Editing Time(In minutes)',"value"=>$records[$model]['editing_time'],'id'=>'editing_time_'.$records[$model]['id'],'data-id'=>$records[$model]['id'])); ?></td>
											
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function(){
					
						$("#select_month,#select_status").on('change',function(){
							
							select_month = $("#select_month").val();
							if(select_month=='') select_month = 0;
							window.location = "<?php echo $this->Html->url(array('action'=>'editing_list')); ?>/"+select_month+"/"+$("#select_status").val();
						});
						$('select[id^=status_]').on('change',function(){
							this_el = $(this);
							$.ajax({
									'url':"<?php echo $this->Html->url(array('action'=>'update_status'));?>",
									'type':'post',
									'dataType':'json',
									'data':{ 'id': $(this).data('id'), 'status':$(this).val() },
									'success':function(response){
									
										if(response.status=='4' || response.status==4){
											this_el.closest('tr').find('td').fadeOut('slow', 
											function(here){ 
												$(here).parents('tr:first').remove();                    
											}); 
										}
										window.reload = true;
									}
								});
						});
						$('input[id^=editing_time_]').on('change',function(){
							this_el = $(this);
							$('span.error').remove();
							$.ajax({
									'url':"<?php echo $this->Html->url(array('action'=>'update_editing_time'));?>",
									'type':'post',
									'dataType':'json',
									'data':{ 'id': $(this).data('id'), 'editing_time':$(this).val() },
									'success':function(responce){
										if(responce.status==0)
										this_el.after('<span class="error">'+responce.message+'</span>');
									}
								});
						});
					
					});
				</script>