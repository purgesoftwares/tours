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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'employees','action' => 'status_inactive')); ?>",
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'employees','action' => 'delete')); ?>",
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'employees','action' => 'change_status')); ?>",
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
									<?php if(AuthComponent::user('user_role_id')!=4){ ?>
										<?php 
									  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
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
				<th><?php echo __('Username'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th class=''><?php echo __('Phone'); ?></th>
				
				<th class='hidden-1024'><?php echo __('Created'); ?></th>
				<?php if(AuthComponent::user('user_role_id')!=4){ ?>
				<th ><?php echo __('Options'); ?></th>
				<?php } ?>
			</tr>
		</thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $records ) { 
		?>
		<tr class="gallerytr">
		
			<?php 
				/* if(isset($records[$model]['user_image_folder'])) {
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
			 */
			 
			 
			?>
			
			
		
			<td  align="left" >
				<?php echo $records[$model]['username']; ?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['first_name'].' '.$records[$model]['last_name'];?>
			</td>
			<td  align="left" ><a href='mailto:<?php echo $records[$model]['email'];?>'>
				<?php echo $records[$model]['email'];?> </a>
			</td>
			<td align="left">
			
			<?php echo 'Mo.- '.$records[$model]['mobile'].'<br/>'; ?>
			<?php echo 'Tl.- '.$records[$model]['telephone']; ?>
			</td>
			<td  align="left">
				<?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['created']));  ?>
			</td>
			<?php if(AuthComponent::user('user_role_id')!=4){ ?>
			<td  align="center">
			
			<div class="dropdown" style='float:left'>
				  <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
					<?php echo __('Action'); ?> <span class="caret"></span>
				  </a>
				  
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
						<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'employees','action' => 'edit',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<li>
						<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Change Password',true), array('plugin' => 'usermgmt','controller' => 'employees','action' => 'change_password',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<li>
					<?php 
					if($records[$model]['active'] == 1){
					?>	
					<a href='javascript::void(0)' onclick='return show_message("<?php echo __('Are you sure you want to inactive this user?'); ?>",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to inactive.'); ?>"><i class="icon-remove icon-white"></i> <?php echo __('Inactive');?></a>	
						
					<?php	
						} else { ?>
					<a href='javascript::void(0)' onclick='return show_message("<?php echo __('Are you sure you want to active this user?'); ?>",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to active.'); ?>"><i class="icon-ok-sign icon-white"></i> <?php echo __('Active').'&nbsp;&nbsp;';?></a>	
					<?php	} ?>
					</li>
					
					
					
					<li>
						<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this user?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to delete.'); ?>"><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>
					</li>
					
			</div>
			
			</td>
			<?php } ?>
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