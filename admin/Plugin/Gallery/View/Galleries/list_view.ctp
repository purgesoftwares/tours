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
	
$(document).ready(function(){

	$("input[type=file]").on('change',function(){
		gallery_id	=	$(this).attr('id').replace("delete_","choose_gallery_images_");
		$("#GalleryIndexForm".gallery_id).submit();
	});
	$("#Sort_by").on('change',function(){
		val = $(this).val();
		
		if(val==0){
			window.location = $("#gallery_title_asc").attr('href');
		}else if(val==1){
			window.location = $("#gallery_title_desc").attr('href');
		}else if(val==2){
			window.location = $("#created_asc").attr('href');
		}else if(val==3){
			window.location = $("#created_desc").attr('href');
		}
	});
});
</script>
<div style="display:none;">
<?php  echo $this->Paginator->sort('gallery_title',__('gallery_title'),array('char'=>true,'direction'=>'asc','id'=>'gallery_title_asc'));?>
<?php  echo $this->Paginator->sort('gallery_title',__('gallery_title'),array('char'=>true,'direction'=>'desc','id'=>'gallery_title_desc'));?>
<?php  echo $this->Paginator->sort('created',__('created'),array('char'=>true,'direction'=>'desc','id'=>'created_asc'));?>
<?php  echo $this->Paginator->sort('created',__('created'),array('char'=>true,'direction'=>'desc','id'=>'created_desc'));?>
</div>
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
											echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New').' '. $singularize,array('action'=> 'add',$client_id),array('class'=>'btn btn-primary','escape'=>false));
											
											
										?> 
									</div>
								
							</div>
							<div style="height:100px; padding:5px;">
									<div class=" pull-left"><?php  echo $this->element('paging_info');  ?></div>
									
									
									<div class=" pull-right">
									<?php 
										echo $this->Html->link( __('Photo board').' <i class="icon-th icon-white"></i> ',array('action'=> 'index',$client_id),array('class'=>'btn btn-primary','escape'=>false));
									?> 
									<?php 
										echo $this->Html->link( __('List View').' <i class="icon-list icon-white"></i> ',array('action'=> 'list_view',$client_id),array('class'=>'btn btn-primary','escape'=>false));
									?>
									
									
									</div>
									<div class=" pull-right">
									<?php 
									echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
									echo $this->Form->text('gallery_title',array('placeholder'=> __('Search A Gallery',true),'class'=>'input-medium')).'&nbsp;';
									?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?>&nbsp;&nbsp;
									<?php echo $this->Form->end();?>
									</div>
									<br style="clear:both;"/>
									<div class=" pull-right">
									<?php echo $this->Form->select('Sort By',array("Address(Ascending)","Address(Descending)","Date(Oldest)","Date(Newest)"),array('empty'=>'Sort By','id'=>'Sort_by')); ?></div>
							</div>
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Gallery Name'); ?></th>
											
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
											<td><?php echo $records[$model]['gallery_title'];?></td>
											<td class='hidden-1024'><?php echo date("m/d/Y",$records[$model]['created']);  ?></td>
											<td class=''>
											
											
												<?php echo $this->Form->create('Gallery'.$records[$model]['id'],array('url'=>array('plugin'=>'gallery','controller'=>'galleries','action'=>'upload_images'),'enctype'=>"multipart/form-data",'class'=>"form-validate form-horizontal",'novalidate'=>"novalidate",'file'=>true)); ?>
												<input type="hidden" name="gallery_id" value="<?php echo $records[$model]['id']; ?>" >
												<input type="file" name="images[]" multiple="multiple" id="choose_gallery_images_1" data-rule-required="1" >
												
												<?php echo $this->Form->button(__("Upload", true),array('class'=>'btn btn-primary','escape'=>false));?>
												<?php echo $this->Form->end(); ?>
												
												<a href="<?php echo $this->Html->url(array('action' => 'view_gallery',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('View'); ?>"><i class="icon-eye"> View</i></a>	
											<a href="javascript:void(0);" onclick="loadChooseresolution(<?php echo $records[$model]['id'] ?>);" class="btn" rel="tooltip" title="<?php echo __('Download All'); ?>"><i class="icon-download"> Download All</i></a>	
												
												<script>
													function loadChooseresolution(id){
														var url = "<?php echo $this->Html->url(array('action' => 'download_gallery_images'),true) ?>/"+id;
														// alert(url);
														$("#high_resolution_link").attr('href',url+'/1');
														$("#low_resolution_link").attr('href',url+'/0');
														
															$("#chooseResolution").modal('show');
													}
												</script>
												
												<?php if($records[$model]['status']==2){ ?>
													<a href="<?php echo $this->Html->url(array('action' => 'release_now',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Release Now'); ?>"><i class="icon-edit"> Release Now</i></a>												
												<?php }elseif($records[$model]['status']==3){ ?>
												<a href="javascript:void(0);" class="btn" rel="tooltip" title="<?php echo __('Released'); ?>"><?php echo __('Released'); ?></a>												
												<?php } ?>
												<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this Gallery?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
												
											</td>
										</tr>
										<?php $i++;
										} 
										?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
										</tbody>
									</table>
									<?php echo $this->element('pagination');
									} else { ?>
									<tr>
									<td align="center" style="text-align:center;" colspan="9" class=""><?php echo __('No Result Found'); ?></td>
									</tr>
								  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
					
				
<!-- Modal -->
<div class="modal fade" id="chooseResolution" tabindex="-1" role="dialog" aria-labelledby="chooseResolution" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="chooseResolution">Choose images Resolution to download</h4>
      </div>
      <div class="modal-body">
        <div class="row-fluid">
				<div class="span5" >
					<div class="control-group "> 
						
						<div class="controls"> 
						<?php echo $this->Html->link("Download Original Resolution",array('action'=>'download_gallery_images'),array('class'=>'btn btn-primary', 'id'=>"high_resolution_link")); ?>
						</div>
					</div>
				</div> 
				<div class="span5" >
					<div class="control-group "> 
						
						<div class="controls">
							<?php echo $this->Html->link("Download Low Resolution",array('action'=>'download_gallery_images'),array('class'=>'btn btn-primary', 'id'=>"low_resolution_link")); ?>
						</div>
					</div>
				</div> 
			
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
