  <?php
echo $this->Html->css(array(
	'plugins/fancybox/fancybox/jquery.fancybox-1.3.4.css' 
));
echo $this->Html->script(array(
	'plugins/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js',
	'plugins/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js',
	'jquery-ui',
	'jquery.rowsorter'
));
?>
<style>
table.sorting-table {cursor: move;}
    table tr.sorting-row td {background-color: #8b8;}
    table td.sorter {background-color: #f80!important; width: 10px; cursor: move;}
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
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery_list',$this->data[$model]['id'],'asc')); ?>";
		}else if(val=='desc'){
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery_list',$this->data[$model]['id'],'desc')); ?>";
		}else if(val=='manual'){
			window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery_list',$this->data[$model]['id'],'manual')); ?>";
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
									<thead>
										<tr class='thefilter'>
											
											<th class=""></th>
											<th><?php echo __('Image'); ?></th>
											
											<th><?php echo __('Action'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($this->data['Images']) ) {
										$i =  1; 	
										foreach( $this->data['Images'] as $records ) { 
										//pr($records);
										?>
										<tr id="<?php echo $records['id']; ?>">
											<td class="sorter"></td>
											<td><?php 
												$file_path		=	USER_IMAGE_STORE_PATH.$records['image_folder'].DS;
												$file_name		=	$records['image'];
												$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',100,100,base64_encode($file_path),$file_name),true);
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
												?></td>
											
											<td class=''>
												<a href="javascript:void(0);" onclick="loadChooseresolution(<?php echo $records['id'] ?>);" class="btn" rel="tooltip" title="<?php echo __('Download'); ?>"><i class="icon-download"> Download</i></a>	
												
												<script>
													function loadChooseresolution(id){
														var url = "<?php echo $this->Html->url(array('action' => 'download_image'),true) ?>/"+id;
														// alert(url);
														$("#high_resolution_link").attr('href',url+'/1');
														$("#low_resolution_link").attr('href',url+'/0');
														
															$("#chooseResolution").modal('show');
													}
												</script>
												
											</td>
										</tr>
										<?php $i++;
										} 
										?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
										</tbody>
									</table>
									<?php 
									} else { ?>
									<tr>
									<td align="center" style="text-align:center;" colspan="9" class=""><?php echo __('No Result Found'); ?></td>
									</tr>
								  <?php } ?>
										
									</tbody>
								</table>
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
										<?php echo $this->Form->button(__("Copy Tour URL", true),array("class"=>"btn btn-primary",'disabled'=>'disabled')); ?>&nbsp; <i class="icon-info-sign" id="popoverData" href="#" data-content='You must click on "Create Virtual Tour" at least once to make URL available. Click again to save any changes.' rel="popover" data-placement="bottom" data-trigger="hover" ></i>
										
										</div>
									  </div>
									  
							</div>
								<?php echo $this->Form->end();?>	
							
							</div>
							
<script>
	$(document).ready(function(){
	
		$("#create_virtual_tour").on('click',function(){
			
			$.ajax({
				
				url : "<?php echo $this->Html->url(array('action'=>'save_virtual_tour')); ?>",
				'type':'post',
				data : $("#GalleryViewGalleryForm").serialize(),
				dataType : 'json',
				success : function(r){
					alert(r.message);
					
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
$("#mySortingTable").rowSorter({

handler          : "td.sorter",

tableDragClass   : "sorting-table",

disabledRowClass : "nodrag",

dragClass        : "sorting-row",

onDragStart      :  function(tbody, row, oldIndex) {
					if($("#Sort_by").val()!="manual")
						window.location = "<?php echo $this->Html->url(array('action'=>'view_gallery_list',$this->data[$model]['id'],'manual')); ?>";
						
					},

onDrop: function(tbody, row, index, oldIndex) {
		
			$.ajax({
				url : "<?php echo $this->Html->url(array('action'=>'save_images_order')); ?>",
				'type':'post',
				data : { id: $(row).attr('id'), 'oldIndex' : oldIndex, 'index': index  },
				dataType : 'json',
				success : function(r){
					// alert(r.message);
					
				}
			});
			
			
			// console.log(tbody);
			// console.log(row);
			// console.log(index);
			// console.log(oldIndex);
			// $(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
		}
});


</script>



</div>

</div>
          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 