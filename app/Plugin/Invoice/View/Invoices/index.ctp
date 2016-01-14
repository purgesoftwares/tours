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
					url: "<?php echo $this->Html->url(array('action' => 'status_inactive')); ?>",
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
					url: "<?php echo $this->Html->url(array('action' => 'delete')); ?>",
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
									<?php echo __("!! You currently have the following PAST DUE Balance:",true); ?>
									</h3>
									
								
							</div>
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Due Date'); ?></th>
											<th><?php echo __('Shoot Title'); ?></th>
											<th><?php echo __('Status'); ?></th>
											<th><?php echo __('Balance'); ?></th>
											<th><?php echo __('View'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										$due_date = explode('-',$records[$model]['due_date']);
										if(!$records[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])<strtotime('today')){
										//pr($records);
										?>
										<tr>
											<td><?php echo $records[$model]['due_date'];?></td>
											<td><?php echo $this->Html->link($records[$model]['title'],array('action'=>'view',$records[$model]['id']));?></td>
											<td class=''>
											<?php if(!$records[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])>=strtotime('today')){ ?>
											<?php echo "PENDING";  ?>
											<?php }elseif(!$records[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])<strtotime('today')){ ?>
											<?php echo "PAST DUE";  ?>
											<?php }elseif($records[$model]['status']){ ?>
											<?php echo "PAID";  ?>
											<?php }  ?>
											</td>
											<td><?php echo  '$'.$records[$model]['total']; ?></td>
											<td><?php echo $this->Html->link("View",array('action'=>'view',$records[$model]['id']),array("class"=>"btn btn-primary"));?></td>
											
										</tr>
									<?php }} } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
</div>
<br/>
<br/>
<div class="row-fluid">
					<div class="span12">
					
						<div class="box box-color box-bordered"   style="border-top: #368ee0 solid 2px;" >
							
								
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Due Date'); ?></th>
											<th><?php echo __('Shoot Title'); ?></th>
											<th><?php echo __('Status'); ?></th>
											<th><?php echo __('Balance'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										//pr($records);
										$due_date = explode('-',$records[$model]['due_date']);
										?>
										<tr>
											<td><?php echo $records[$model]['due_date'];?></td>
											<td><?php echo $this->Html->link($records[$model]['title'],array('action'=>'view',$records[$model]['id']));?></td>
											<td class=''>
												<?php if(!$records[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])>=strtotime('today')){ ?>
											<?php echo "PENDING";  ?>
											<?php }elseif(!$records[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])<strtotime('today')){ ?>
											<?php echo "PAST DUE";  ?>
											<?php }elseif($records[$model]['status']){ ?>
											<?php echo "PAID";  ?>
											<?php }  ?>
											</td>
											<td><?php echo  '$'.$records[$model]['total']; ?></td>
											
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>