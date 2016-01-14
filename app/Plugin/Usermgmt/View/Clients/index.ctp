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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'clients','action' => 'status_inactive')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('Something went wrong. Please try again!');
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'clients','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('Something went wrong. Please try again!');
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
	
	$( "#suspend_message_div").dialog({
			
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'clients','action' => 'change_status')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('Something went wrong. Please try again!');
						}else {
						
							$('#suspendtext').html('');
							if(r == 'Suspended'){
								$('#suspendtext').html('<i class="icon-remove icon-white"></i> ' + r);
							}else {
								$('#suspendtext').html('<i class="icon-ok-sign icon-white"></i> ' + r);
							}
							
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
function suspend_message(msg,obj){
		user_id	=	$(obj).attr('id').replace("suspend_","");
		$( "#suspend_message_div").empty().html(msg);
		$( "#suspend_message_div").dialog('open');return false;
		
	}
</script>
<div id='show_message_div'></div>
<div id='delete_user_div'></div>
<div id='suspend_message_div'></div>
<div class="row-fluid">
					<div class="span12">
					
						<div class="box box-color box-bordered">
						
						<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									<?php echo __($pageHeading,true); ?>
									</h3>
									<div class="pull-right">
									<?php if(AuthComponent::user('user_role_id')==1){ ?>
										<?php 
									  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add New Client',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
									  echo '&nbsp;';
									  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Manage Types',true),array('plugin'=>'master','controller'=>'categories','action'=>'index','client_types'),array('class'=>'btn btn-primary','escape'=>false));	
								?> 
								<?php } ?>
								<?php 
									  // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
									  echo '&nbsp;';
									  // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));	
								?> 
									  </div>
								
							</div>
                
	<div class="box-content nopadding">
	<table width="100%"  class="table table-hover table-nomargin dataTable table-bordered" align="center" border="0" cellspacing="0" cellpadding="0">
	 <thead>
			
			<tr>
				
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Type'); ?></th>
				
				<th class='hidden-1024'><?php echo __('Last Activity'); ?></th>
				<th ><?php echo __('Action'); ?></th>
				
			</tr>
		</thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $records ) { 
		?>
		<tr class="gallerytr">
		
			
		
			<td  align="left" >
				<?php echo $records[$model]['first_name'].' '.$records[$model]['last_name'];?>
			</td>
			<td  align="left" ><a href='mailto:<?php echo $records[$model]['email'];?>'>
				<?php echo $records[$model]['email'];?> </a>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['type'];?>
			</td>
			
			
			<td  align="left">
				<?php echo $this->Time->timeAgoInWords($records[$model]['last_activity']);  ?>
			</td>
			<td  align="left">
				<?php echo $this->Html->link('Profile',array('action'=>'profile',$records[$model]['id']),array('class'=>"btn btn-primary")).'&nbsp;'; ?>
				<?php echo $this->Html->link('Galleries',array('plugin'=>'gallery','controller'=>'galleries','action'=>'index',$records[$model]['id']),array('class'=>"btn btn-primary")); ?>
				<?php echo $this->Html->link('Billing',array('plugin'=>'invoice','controller'=>'invoices','action'=>'index',$records[$model]['id']),array('class'=>"btn btn-primary")); ?>
			</td>
		</tr>
      <?php
			$i++;
			} 
			
		} ?>
			</tbody>
			  </table>
			 
		
		  </div>
		</div>
	</div>
</div>