<script language="javascript">
$(function(){
	var Message	=	'<?php echo __('Confirmation'); ?>';
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
					url: "<?php echo $this->Html->url(array('action' => 'delete_image')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							
							$('#delete_'+user_id).closest('div.imageBox').fadeOut('slow', 
								function(here){ 
									//$(here).parents('tr:first').remove();                    
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

	
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}

</script>
<div id='delete_user_div'></div>
  <?php
echo $this->Html->css(array(
	'plugins/fancybox/fancybox/jquery.fancybox-1.3.4.css' 
));
echo $this->Html->script(array(
	'plugins/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js',
	'plugins/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js',
	'jquery-ui',
	'floating-gallery'
));
?>
<style type="text/css">
	
	.GalleryContainer{ height:100%;width:100%;}
	.imageBox,.imageBoxHighlighted{
		width:160px;	/* Total width of each image box */
		height:200px;	/* Total height of each image box */
		float:left;
	}
	.imageBox_theImage{
		width:125px;	/* Width of image */
		height:125px;	/* Height of image */

		/*
		Don't change these values *
		*/
		background-position: center center;
		background-repeat: no-repeat;
		margin: 0 auto;
		margin-bottom:2px;
	}

	.imageBox .imageBox_theImage{
		border:1px solid #DDD;	/* Border color for not selected images */
		padding:2px;
	}
	.imageBoxHighlighted .imageBox_theImage{
		border:3px solid #316AC5;	/* Border color for selected image */
		padding:0px;

	}
	.imageBoxHighlighted span{	/* Title of selected image */
		background-color: #316AC5;
		color:#FFFFFF;
		padding:2px;
	}

	.imageBox_label{	/* Title of images - both selected and not selected */
		text-align:center;
		font-family: arial;
		font-size:11px;
		padding-top:2px;
		margin: 0 auto;
	}

	/*
	DIV that indicates where the dragged image will be placed
	*/
	#insertionMarker{
		height:200px;
		width:6px;
		position:absolute;
		display:none;

	}

	#insertionMarkerLine{
		width:6px;	/* No need to change this value */
		height:195px;	/* To adjust the height of the div that indicates where the dragged image will be dropped */

	}

	#insertionMarker img{
		float:left;
	}

	/*
	DIV that shows the image as you drag it
	*/
	#dragDropContent{

		opacity:0.4;	/* 40 % opacity */
		filter:alpha(opacity=40);	/* 40 % opacity */

		/*
		No need to change these three values
		*/
		position:absolute;
		z-index:10;
		display:none;

	}


	</style>

<script>
$(document).ready(function(){
	$('.btn').tooltip();
	 /* $("#single_1").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
      }); */
	  
	  $("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			
			
			$("#Sort_by").val('<?php echo $image_order; ?>');
	$("#Sort_by").on('change',function(){
		val = $(this).val();
		
		if(val=='asc'){
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery',$this->data[$model]['id'],'asc')); ?>";
		}else if(val=='desc'){
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery',$this->data[$model]['id'],'desc')); ?>";
		}else if(val=='manual'){
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery',$this->data[$model]['id'],'manual')); ?>";
		} 
	});
			
}) 	
</script>


  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Edit");?> <?php echo $pageHeading;?>
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To").' '. $humanize,array("action"=> "index",$this->data[$model]['client_id']),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
      <div class="row-fluid">
<div class="span12" >
			
         <div style="height:60px; padding:5px;">
									
									<div class=" pull-right">
									<?php 
										echo $this->Html->link( __('Grid View').' <i class="icon-th icon-white"></i> ',array('action'=> 'view_gallery',$id,$image_order),array('class'=>'btn btn-primary','escape'=>false));
									?> 
									<?php 
										echo $this->Html->link( __('List View').' <i class="icon-list icon-white"></i> ',array('action'=> 'view_gallery_list',$id,$image_order),array('class'=>'btn btn-primary','escape'=>false));
									?>
									
									
									</div>
									
									<div class=" pull-right">
									<?php echo $this->Form->select('Sort By',array('asc'=>"File Name(Ascending)",'desc'=>"File Name(Descending)",'manual'=>"Manual"),array('empty'=>false,'id'=>'Sort_by')); ?>&nbsp;&nbsp;&nbsp;</div> 
							</div>
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered"  id="mySortingTable">
									
									<tbody>
									<tr>
									<td>
									<div id="GalleryContainer" >
									<?php 
									if( !empty($this->data['Images']) ) {
										$i =  1; 	
										foreach( $this->data['Images'] as $records ) { 
										//pr($records);
										?>
										
										<div class="imageBox" id="<?php echo $records['id']; ?>" style="float:left; padding:14px; height:200px;">
											<div style="height:125px;" class="imageBox_theImage">
												<?php 
												$file_path		=	USER_IMAGE_STORE_PATH.$records['image_folder'].DS;
												$file_name		=	$records['image'];
												$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',125,125,base64_encode($file_path),$file_name),true);
												$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',2000,2000,base64_encode($file_path),$file_name),true);
												if(is_file($file_path . $file_name)) {
													$images = $this->Html->image($image_url,array('alt' => '','title' => ''));
												?>
												<a id="single_1"  rel="example_group" href="<?php echo $big_image_url; ?>" title='<?php echo 'Image'; ?>'>
													<?php echo $images; ?>
												</a>
												<?php	
												}else {
													echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
												}
												?>
											</div>
											<div class="imageBox_label" >
											<h5><?php echo $this->Text->truncate($file_name,20);?></h5>
											</div>
											<div>
												<a href="javascript:void(0);" onclick="loadChooseresolution(<?php echo $records['id'] ?>);" class="btn" rel="tooltip" title="<?php echo __('Download'); ?>"><i class="icon-download"> Download</i></a>	
												<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this Image?'); ?>",this);' id='delete_<?php echo $records['id']; ?>' class='btn' rel="tooltip" data-placement="top" title="<?php echo __('Delete'); ?>"><i class="icon-remove"></i></a>
												
												<script>
													function loadChooseresolution(id){
														var url = "<?php echo $this->Html->url(array('action' => 'download_image'),true) ?>/"+id;
														// alert(url);
														$("#high_resolution_link").attr('href',url+'/1');
														$("#low_resolution_link").attr('href',url+'/0');
														
															$("#chooseResolution").modal('show');
													}
												</script>
											</div>
										</div>
										
										<?php $i++;
										} 
										?>
										<div id="insertionMarker">
										<?php echo $this->Html->image('marker_top.gif'); ?>
										<?php echo $this->Html->image('marker_middle.gif',array('id'=>"insertionMarkerLine")); ?>
										<?php echo $this->Html->image('marker_bottom.gif'); ?>
</div>
<div id="dragDropContent">
</div>

</div>
</td></tr>
										</tbody>
									</table>
									
									<?php 
									} else { ?>
									<?php echo __('No Result Found'); ?></div>
									<div id="insertionMarker">
	<?php echo $this->Html->image('marker_top.gif'); ?>
										<?php echo $this->Html->image('marker_middle.gif',array('id'=>"insertionMarkerLine")); ?>
										<?php echo $this->Html->image('marker_bottom.gif'); ?>
</div>
<div id="dragDropContent">
</div>
<div id="debug" style="clear:both">
</div>
									</td>
									</tr>
									</tbody>
								</table>
								  <?php } ?>	
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
						<?php echo $this->Html->link("Download Original Resolution",array('action'=>'download_image'),array('class'=>'btn btn-primary', 'id'=>"high_resolution_link")); ?>
						</div>
					</div>
				</div> 
				<div class="span5" >
					<div class="control-group "> 
						
						<div class="controls">
							<?php echo $this->Html->link("Download Low Resolution",array('action'=>'download_image'),array('class'=>'btn btn-primary', 'id'=>"low_resolution_link")); ?>
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


							
							<div class="box-content nopadding" >
								<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));
									echo $this->Form->hidden('id',array('value'=>$this->data[$model]['id']));
								?>
									<div class="span12" >
			
										<h4>
											Virtual Tour Options
										</h4>
										
									  <div class="control-group <?php echo ($this->Form->error($model.".alt_title"))? "error":"";?>">
									   <?php echo $this->Form->checkbox($model.".include_project_title", array("style"=>"width:20px; margin:10px;")); ?>Include Project Title(Shoot Title is default) <br/>
									   <div style="margin-left:100px;">
									   <?php echo $this->Form->label($model.".alt_title", __('Alternate Name').": ",array("class"=>"control-label",'style'=>'font-weight:bold')); ?>
										<div class="controls">
										<?php echo $this->Form->text($model.".alt_title",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".alt_title",array("wrap"=>false)); ?></span>
										</div>
										</div>
									  </div>
									  
									   <div class="control-group <?php echo ($this->Form->error($model.".alt_agent_title"))? "error":"";?>">
									   <?php echo $this->Form->checkbox($model.".include_agent_title", array("style"=>"width:20px; margin:10px;")); ?>Include Agent Name <br/>
									   <div style="margin-left:100px;">
									   <?php echo $this->Form->label($model.".alt_agent_title", __('Alternate Name').": ",array("class"=>"control-label",'style'=>'font-weight:bold')); ?>
										<div class="controls">
										<?php echo $this->Form->text($model.".alt_agent_title",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".alt_agent_title",array("wrap"=>false)); ?></span>
										</div>
										</div>
									  </div>
									  <div class="control-group <?php echo ($this->Form->error($model.".alt_agent_phone"))? "error":"";?>">
									   <?php echo $this->Form->checkbox($model.".include_agent_contact", array("style"=>"width:20px; margin:10px;")); ?>Include Agent Contact Information <br/>
									   <div style="margin-left:100px;">
									   <?php echo $this->Form->label($model.".alt_agent_phone", __('Alternate Phone').": ",array("class"=>"control-label",'style'=>'font-weight:bold')); ?>
										<div class="controls">
										<?php echo $this->Form->text($model.".alt_agent_phone",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".alt_agent_phone",array("wrap"=>false)); ?></span>
										</div>
										</div>
										
										<div style="margin-left:100px;margin-top:10px;">
									   <?php echo $this->Form->label($model.".alt_agent_email", __('Alternate Email').": ",array("class"=>"control-label",'style'=>'font-weight:bold')); ?>
										<div class="controls">
										<?php echo $this->Form->text($model.".alt_agent_email",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".alt_agent_email",array("wrap"=>false)); ?></span>
										</div>
										</div>
										
									  </div>
									  
									   <div class="control-group <?php echo ($this->Form->error($model.".alt_agent_title"))? "error":"";?>">
									   <?php echo $this->Form->checkbox($model.".include_mls_number", array("style"=>"width:20px; margin:10px;")); ?>Include MLS Number <br/>
									   <div style="margin-left:100px;">
									   <?php echo $this->Form->label($model.".mls_number", __('MLS #').": ",array("class"=>"control-label",'style'=>'font-weight:bold')); ?>
										<div class="controls">
										<?php echo $this->Form->text($model.".mls_number",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".mls_number",array("wrap"=>false)); ?></span>
										</div>
										</div>
									  </div>
									  
										  
									   <div class="form-actions">
										<div class="input">
										<?php echo $this->html->link(__("Create Virtual Tour", true),'javascript:void(0);',array("class"=>"btn btn-primary",'id'=>'create_virtual_tour','onclick'=>'javascript:void(0);')); ?>&nbsp;&nbsp;
										<?php echo $this->html->link(__("Copy Tour URL", true),'javascript:void(0);',array("class"=>"btn btn-primary",'disabled'=>'disabled','id'=>'copy_tour_url')); ?>&nbsp; <i class="icon-info-sign" id="popoverData" href="#" data-content='You must click on "Create Virtual Tour" at least once to make URL available. Click again to save any changes.' rel="popover" data-placement="bottom" data-trigger="hover" ></i>
										
										</div>
									  </div>
									  
							</div>
								<?php echo $this->Form->end();?>	
							
							</div>
							
<script>

manual_url = "<?php echo $this->Html->url(array('action'=>'view_gallery',$this->data[$model]['id'],'manual')); ?>";
function saveImagesOrder()
{
	var orderString = "";
	var objects = document.getElementsByTagName('div');
	
	for(var no=0;no<objects.length;no++){
		if(objects[no].className=='imageBox' || objects[no].className=='imageBoxHighlighted'){
			if(objects[no].id != "foo" && objects[no].parentNode.id != "dragDropContent"){ // Check if it's not the fake image, or the drag&drop box
				if(orderString.length>0){
					orderString = orderString + ',';
					}
				orderString = orderString + objects[no].id;
				}
			}			
		}
	console.log(orderString);
		$.ajax({
					url : "<?php echo $this->Html->url(array('action'=>'save_images_gallery_order')); ?>",
					'type':'post',
					data : { 'orderString': orderString  },
					dataType : 'json',
					success : function(r){
						// alert(r.message);
						
					}
				});
	
}

	$(document).ready(function(){
	
		/* $('#GalleryContainer div,#GalleryContainer img,#GalleryContainer a').on('mouseup',function () {
			setTimeout(function(){ saveImagesOrder(); }, 1000);
			
		 }); */
	
		$("#create_virtual_tour").on('click',function(){
			
			$.ajax({
				
				url : "<?php echo $this->Html->url(array('action'=>'save_virtual_tour')); ?>",
				'type':'post',
				data : $("#GalleryViewGalleryForm").serialize(),
				dataType : 'json',
				success : function(r){
					alert(r.message);
					$("#copy_tour_url").removeAttr("disabled");
					$("#copy_tour_url").on('click',function(){
						 window.prompt("Copy to clipboard: Ctrl+C, Enter", "<?php echo substr(strstr(WEBSITE_URL,"//"),2,strlen(WEBSITE_URL)-1)."slideshow/index/".base64_encode($this->data[$model]['id']); ?>");
					});
					
				}
				});
			
		});
		
		$("#GalleryAltTitle").on('change',function(){
			if($(this).val()!=''){
				$('#GalleryIncludeProjectTitle').attr('checked','checked');
			}
		});
		$("#GalleryAltAgentTitle").on('change',function(){
			if($(this).val()!=''){
				$('#GalleryIncludeAgentTitle').attr('checked','checked');
			}
		});
		$("#GalleryAltAgentPhone,#GalleryAltAgentEmail").on('change',function(){
			if($(this).val()!=''){
				$('#GalleryIncludeAgentContact').attr('checked','checked');
			}
		});
		$("#GalleryMlsNumber").on('change',function(){
			if($(this).val()!=''){
				$('#GalleryIncludeMlsNumber').attr('checked','checked');
			}
		});
		$("#GalleryIncludeProjectTitle").on('change',function(){
			if(this.checked==false){
				$('#GalleryAltTitle').val('');
			}
		});
		$("#GalleryIncludeAgentTitle").on('change',function(){
			if(this.checked==false){
				$('#GalleryAltAgentTitle').val('');
			}
		});
		$("#GalleryIncludeAgentContact").on('change',function(){
			if(this.checked==false){
				$('#GalleryAltAgentPhone,#GalleryAltAgentEmail').val('');
			}
		});
		$("#GalleryIncludeMlsNumber").on('change',function(){
			if(this.checked==false){
				$('#GalleryMlsNumber').val('');
			}
		});
		
		$('#popoverData').popover();
	});
</script>


<script type="text/javascript">



</script>



</div>

</div>
          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 