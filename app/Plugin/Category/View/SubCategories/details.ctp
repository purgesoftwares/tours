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
					url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'categories','action' => 'admin_delete')); ?>",
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
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
				<div class="row-fluid"><h1><?php echo __($pageHeading,true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
		</tr>
		<tr>
			<td>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Category Name',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $category_result[$model]['name_'.$this->Session->read('Config.language')];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Parent Category',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php 
								if($this->Session->read('Config.language') == 'pt'){
									echo $category_result[$model]['parent_name_pt'];
								}else {
									echo $category_result[$model]['parent_name_en'];
								}
							?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Slogan',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $category_result[$model]['credit_'.$this->Session->read('Config.language')];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.description', __('Category Description',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $category_result[$model]['description_'.$this->Session->read('Config.language')];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Category Image',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php
							$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
							$file_name    = $category_result[$model]['image_name'];
							$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',250,250,base64_encode($file_path),$file_name),true);
							$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
							if(is_file($file_path . $file_name)) {
								$images = $this->Html->image($image_url,array('alt' => $image_title,'title' => $image_title));
							 ?>
							<a class='colorbox-image' rel="group-1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($image_title); ?>'>
								<?php echo $images; ?>
							</a>
							<?php } else {
								echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
							}
							?>
							<?php // echo $category_result[$model]['image_name'];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.created', __('Category Created',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo date("m/d/Y",$category_result[$model]['created']);?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.modified', __('Category Modified',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo date("m/d/Y",$category_result[$model]['modified']);?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		
	</thead> 
</table>