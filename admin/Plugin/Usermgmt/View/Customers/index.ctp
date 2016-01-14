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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'customers','action' => 'status_inactive')); ?>",
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'customers','action' => 'delete')); ?>",
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'partners','action' => 'change_status')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('Something went wrong. Please try again!');
						}else {
						
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
</SCRIPT>
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
										<?php 
										  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
									?> <?php 
										  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
										  echo '&nbsp;';
										  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));	
									?> 
									  </div>
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										
										<tr>
											
											<th class='hidden-480'><?php echo __('User Photo'); ?></th>
											<th><?php echo __('Username'); ?></th>
											<th><?php echo __('Email'); ?></th>
											<th class='hidden-350'><?php echo __('Status'); ?></th>
											<th class='hidden-1024'><?php echo __('Created'); ?></th>
											<th ><?php echo __('Options'); ?></th>
										</tr>
									</thead>
									<tbody>
									
						<?php 
						if( !empty($result) ) {
							$i =  1; 	
							foreach( $result as $records ) { 
						?>
										<tr>
											
											<td>
											<?php 
											if(isset($records[$model]['user_image_folder'])) {
											$file_path    = USER_IMAGE_STORE_PATH.$records[$model]['user_image_folder'].DS ;
											$file_name    = $records[$model]['user_image'];
											$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
												$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
											if(is_file($file_path . $file_name)) {
												$images = $this->Html->image($image_url,array('alt' => $records[$model]['first_name'],'title' => $records[$model]['first_name']));
											?>
											<a class='colorbox-image' rel="group-1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['first_name']); ?>'>
											<?php echo $images; ?>
											</a>
											<?php					
											}else {
												echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
											}  
											}else {
													echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
												}	
										?>
											</td>
											
											<td><?php echo $records[$model]['username'];?>
											</td>
											<td><?php echo $records[$model]['email'];?></td>
											<td class='hidden-350'>
											<?php 
											if($records[$model]['active'] == 1){
											?>	
											
											<span style='cursor:pointer;' class="label label-satgreen" onclick='return show_message("<?php echo __('Are you sure you want to change status of this user?'); ?>",this);' rel='tooltip' title="<?php echo __('Click here to inactive.'); ?>" alt='active' id='inactive_<?php echo $records[$model]['id']; ?>' ><?php echo __('Active');?></span>
											
											<?php } else { ?>
											<span style='cursor:pointer;' class="label label-satred" onclick='return show_message("<?php echo __('Are you sure you want to change status of this user?'); ?>",this);' rel='tooltip' title="<?php echo __('Click here to active.'); ?>" alt='Inactive' id='inactive_<?php echo $records[$model]['id']; ?>' ><?php echo __('Inactive');?></span>
											
											<?php } ?>
											
											
											<?php 
											if($records[$model]['is_suspend'] == 1){
											?>	
											
											<span style='cursor:pointer;' class="label label-satred" onclick='return suspend_message("<?php echo __('Are you sure you want to suspend this user?'); ?>",this);' rel='tooltip' title="<?php echo __('Click here to suspend.'); ?>" alt='active' id='suspend_<?php echo $records[$model]['id']; ?>' ><span id='suspendtext'><?php echo __('Suspended');?></span></span>
											
											<?php } else { ?>
											<span  style='cursor:pointer;' class="label label-satgreen" onclick='return suspend_message("<?php echo __('Are you sure you want to resume this user?'); ?>",this);' rel='tooltip' title="<?php echo __('Click here to resume.'); ?>" alt='Inactive' id='suspend_<?php echo $records[$model]['id']; ?>' ><span id='suspendtext'><?php echo __('Not Suspended');?></span></span>
											
											<?php } ?>
											</td>
											<td class='hidden-1024'><?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['created']));  ?></td>
											<td class='hidden-480'>
												
												<?php echo $this->Html->link('<i class="icon-edit"></i>', array('plugin' => 'usermgmt','controller' => 'customers','action' => 'edit',$records[$model]['id']),array('class'=>'btn','rel' => 'tooltip','title'=>__('Edit'),'escape' => false)); ?>
												<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('plugin' => 'usermgmt','controller' => 'customers','action' => 'change_password',$records[$model]['id']),array('class'=>'btn','rel'=>'tooltip','title'=>__('Change Password'),'escape' => false)); ?>
												<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this user?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
												
												
											</td>
										</tr>
									 <?php
									$i++;
									} 
									?>
									<?php 
									} else { $i=0;?>
									
								  <?php } ?>  	
										
										
									</tbody>
								</table>
								
								
							</div>
						</div>
					</div>
				</div>