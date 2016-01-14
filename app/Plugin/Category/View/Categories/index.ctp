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
					url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'delete')); ?>",
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
</SCRIPT>
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
					echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
					?> 
				</div>
			</div>
			<div class="box-content nopadding">
<table width="100%"  class="table table-hover table-nomargin dataTable table-bordered" >
 <thead>
		<tr class='thefilter'>
				<th><?php echo __('Image'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Description'); ?></th>
				<th class='hidden-1024'><?php echo __('Created'); ?></th>
				<th class='hidden-1024'><?php echo __('Modified'); ?></th>
				<th class='hidden-480'><?php echo __('Options'); ?></th>
		</tr>
</thead><tbody>
                <?php 
              if( !empty($result) ) {
				//pr($result); ;
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
			  ?>
              <tr>
			  <td>
				<?php 			
					$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
					$file_name    = $records[$model]['image_name'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
					if(is_file($file_path . $file_name)) {
						$images = $this->Html->image($image_url,array('alt' => $records[$model]['name_'.$this->Session->read('Config.language')],'title' => $records[$model]['name_'.$this->Session->read('Config.language')]));
					?>
					<a class='colorbox-image' rel="group-1"  href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['name_'.$this->Session->read('Config.language')]); ?>'>
					<?php echo $images; ?>
					</a>
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
			</td>
				<td>
					<?php echo $records[$model]['name_'.$this->Session->read('Config.language')]; ?>
				</td>
				<td  align="left" style="text-align:justify;">
					<?php echo $this->Text->truncate($records[$model]['description_'.$this->Session->read('Config.language')],50); ?>
				</td>
				
                <td align="left">
					<?php 
						echo date(Configure::read('date_format.basic'),$records[$model]['created']);
					 ?>
				</td>
				
                <td align="left">
					<?php 
						echo date(Configure::read('date_format.basic'),$records[$model]['modified']);
					 ?>
				</td>
				<td width="15%" align="center">
					<a href="<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'details',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('View');?>"><i class="icon-search"></i></a>
					 <a href="<?php echo $this->Html->url(array('action' => 'edit',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Edit'); ?>"><i class="icon-edit"></i></a>
					 <a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this category?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
					
			    </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <?php } ?>
					  <tbody>
			</table>
			</div>
		</div>
	</div>
</div>