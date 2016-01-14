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
						//$( this ).dialog( "close" );
						alert('Something went wrong. Please try again!');
					}
					else{
						
						window.location.reload(true);
					}
				}
			});
				$( this ).dialog( "close" );
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'partners','action' => 'delete')); ?>",
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
					$( this ).dialog( "close" );
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		$('.additional_resource').hide();
		$('.premium_account').hide();
		$('.additional_news_item').hide();
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

function show_hide(obj){
	$id=	$(obj).attr('id');
	if($id=='PartnerAccounttype0'){
		$('.additional_news_item').hide();
		$('.additional_resource').hide();
		$('.premium_account').hide();
		$('.normaltype').show();
	}
	if($id=='PartnerAccounttype1'){
		
		$('.additional_news_item').hide();
		$('.additional_resource').hide();
		$('.normaltype').hide();
		$('.premium_account').show();
	}
	if($id=='PartnerAccounttype2'){
		
		$('.additional_news_item').hide();
		$('.premium_account').hide();
		$('.normaltype').hide();
		$('.additional_resource').show();
	}
	if($id=='PartnerAccounttype3'){
		
		$('.additional_resource').hide();
		$('.premium_account').hide();
		$('.normaltype').hide();
		$('.additional_news_item').show();
	}
}
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
<div id='suspend_message_div'></div>
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
										echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
										?> 
										<?php 
										  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
										  echo '&nbsp;';
										  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));	
									?> 
									  </div>
								
							</div>
							<div class="box-content nopadding">
			
<table width="100%"  class="table table-hover table-nomargin dataTable table-bordered" align="center" border="0" cellspacing="0" cellpadding="0">
<thead>
		<tr>
			
			<th class='hidden-480'><?php echo __('User Photo'); ?></th>
			<th><?php echo __('Username'); ?></th>
			<th class='hidden-350'><?php echo __('Account type'); ?></th>
			<th><?php echo __('Email'); ?></th>
			<th class='hidden-1024'><?php echo __('Created'); ?></th>
			<th><?php echo __('View'); ?></th>
			<th ><?php echo __('Options'); ?></th>
		</tr>
	</thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $key=>$records ) { 
		//pr($records);
		?>
		<tr class="gallerytr">
		<td  align="left" >
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
			
			<td  align="left" >
				<?php echo $records[$model]['username']; ?>
			</td>
			<td  align="left" >
			<?php 
			if(isset($records[$model]['accountupgradeted']) && isset($records[$model]['upgradationtype']) && !empty($records[$model]['upgradationtype'])){
				
					echo __('Premium'); 
				
			}else{
				echo __('Normal'); 
			}			?>
			</td>
			<td  align="left" ><a href='mailto:<?php echo $records[$model]['email'];?>'>
				<?php echo $records[$model]['email'];?> </a>
			</td>
			
			<td  align="left">
				<?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['created']));  ?>
			</td>
			<td  align="left">
			
				 <div class="dropdown" style='float:left'>
				  <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
					<?php echo __('View'); ?> <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
					<?php
						echo $this->Html->link(__('Stores',true), array('plugin' => 'store','controller' => 'stores','action' => 'partner_stores',$records[$model]['id']) ,array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link(__('Campaigns',true),  array('plugin' => 'campaign','controller' => 'campaigns','action' => 'partner_campaigns',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
				  </ul>
			</div>
			</td>
			<td  align="center">
			<div class="dropdown" style='float:left'>
				  <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
					<?php echo __('Action'); ?> <span class="caret"></span>
				  </a>
				   <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
					<?php
					echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'edit',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
					echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Change Password',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'change_password',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<?php /* <li>
					<?php
					//pr($records);
					echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Manage Media Image',true), array('plugin' => 'media','controller' => 'media','action' => 'index',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
					echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Manage Media Video',true), array('plugin' => 'media','controller' => 'media','action' => 'manage_media_video',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
					//echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('View Dashboard',true), array('plugin' => false,'controller' => 'users','action' => 'partner_dashboard',$records[$model]['id']),array('class'=>'','escape' => false));
					echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('View Dashboard',true), '../../../users/partner_dashboard/'.$records[$model]['id'],array('class'=>'','target'=>'_blank','escape' => false));
					?>
					</li> */ ?>
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
					<?php 
					if($records[$model]['is_suspend'] == 1){
					?>	
					<a href='javascript::void(0)' onclick='return suspend_message("<?php echo __('Are you sure you want to suspend this user?'); ?>",this);' id='suspend_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to suspend.'); ?>"><span id='suspendtext'><i class="icon-remove icon-white"></i> <?php echo __('Suspended');?></span></a>	
						
					<?php	
						} else { ?>
					<a href='javascript::void(0)' onclick='return suspend_message("<?php echo __('Are you sure you want to resume this user?'); ?>",this);' id='suspend_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to resume.'); ?>"><span id='suspendtext'><i class="icon-ok-sign icon-white"></i> <?php echo __('Not Suspended').'&nbsp;&nbsp;';?></span></a>	
					<?php	} ?>
					</li>
					<li>
					<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this user?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to delete.'); ?>"><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>
					</li>
					
					</ul>
				</div>
				&nbsp;
			</td>
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
		</tbody>
	</table>
								
			</div>
		</div>
	</div>
</div>