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
					url: "<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'sub_categories','action' => 'delete')); ?>",
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
      		<th style="background-color: #EEEEEE;">
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
		<tr>
			<th>
			
				<div class="row-fluid">
				<div class="box box-color box-bordered">
					<div class="box-title">
					<h3><?php echo __("Sub-Categories",true); ?></h3>
					</div>
				</div>
				</div>
			</th>
		</tr>
		<tr>
			<td>
                
<div class="box-content nopadding">
<table width="100%"  class="table table-hover table-nomargin dataTable table-bordered" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>

		<tr class='thefilter'>
			<th><?php echo __('Category Image'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th class='hidden-1024'><?php echo __('Created'); ?></th>
			<th class='hidden-1024'><?php echo __('Modified'); ?></th>
			<th class='hidden-480'><?php echo __('Options'); ?></th>
		</tr>
	</thead>
   
   <tbody >
	<?php 
	if( !empty($subcategory_result) ) {
	
	$i =  1; 
	// $albums_categories = $this->requestAction(array('plugin'=>'category','controller'=>'categories','action'=>'get_categories','id','categories'));	
		foreach( $subcategory_result as $records ) { 
		
		?>
		<tr>
		<td  align="left" >
				<?php 
			
					$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
					$file_name    = $records[$model]['image_name'];
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
						$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
					if(is_file($file_path . $file_name)) {
						$images = $this->Html->image($image_url,array('alt' => $records[$model]['name_'.$this->Session->read('Config.language')],'title' => $records[$model]['name_'.$this->Session->read('Config.language')]));
					?>
					<a class='colorbox-image' rel="group-1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['name_'.$this->Session->read('Config.language')]); ?>'>
					<?php echo $images; ?>
				</a>
					<?php					
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					} 
				?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['name_'.$this->Session->read('Config.language')];?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['description_'.$this->Session->read('Config.language')];?>
			</td>
			<td  align="left">
				<?php echo date("m/d/Y",$records[$model]['created']);  ?>
			</td>
			<td  align="left">
				<?php echo date("m/d/Y",$records[$model]['modified']);  ?>
			</td>
			<td  align="center">
				<a href="<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'sub_categories','action' => 'details',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('View');?>"><i class="icon-search"></i></a>
				<a href="<?php echo $this->Html->url(array('plugin' => 'category','controller' => 'sub_categories','action' => 'edit',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Edit'); ?>"><i class="icon-edit"></i></a>
				<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this Category?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
				&nbsp;
			</td>
		</tr>
		<?php
			$i++;
			} }  ?>
			</tbody>
			  </table>
			  
      </td>
    </tr>
	</thead> 
</table>