<?php
echo $this->Html->css(array(
	'jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min',
));
echo $this->Html->script(array(
	'jquery-ui'
));
?>
<script language="javascript">
$(function(){

	var Message	=	"<?php echo __('Confirmation'); ?>";	
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
					url: "<?php echo $this->Html->url(array('plugin' => 'cms','controller' => 'pages','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!"); ?>');
						}
						else{
							$( this ).dialog( "close" );
							window.location.reload(true);
						}
					}
				});
					
				},
				'<?php echo __("No"); ?>': function() {
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
$(document).ready(function(){
	$('.btn').tooltip();
}) 	
</script>
<div id='delete_user_div'></div>
<table class="table table-bordered table-striped">
 <thead>
	<tr>
		<th style="background-color: #EEEEEE;">
		<div class="row-fluid">
		   <h1><?php echo __("Manage Pages"); ?>
			   <div class="pull-right">
				 <?php 
					// echo $this->Html->link('<i class="icon-plus icon-white"></i> Add New Page',array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
					?> 
			  </div>
		   </h1>
		</div>
		</th>
	</tr>
	<tr>
		<td>
			<div class="row-fluid">
				<div class="span4">
					<?php  echo $this->element('paging_info'); ?>
				</div>
				<div style="float:right;">
				<?php echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array(
					'label' => false,
					'div' => false
				)));?>
				<?php echo $this->Form->text('name',array('placeholder'=>__('Search By Name'),'class'=>'input-medium')); ?>&nbsp; &nbsp; <?php echo $this->Form->button("<i class='icon-search icon-white'></i>". __("Search"),array('class'=>'btn btn-primary','escape'=>false));?>
						   &nbsp;&nbsp;
				<?php echo $this->Form->end();?>
				</div>
			</div>

          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
			<tr style="height:30px;">
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('name',__('Name'), array('char' => true)); ?>
				</td>
				<!--<td width="18%" align="left">
					<?php  echo $this->Paginator->sort('body',__('Description'),array('char' => true)); ?>
				</td>-->
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('page_type',__('Page Type'),array('char' => true)); ?>
				</td>
				<td width="12%" align="left">
					<?php  echo $this->Paginator->sort('meta_description',__('Meta Description'),array('char' => true)); ?>
				</td>
				<td width="9%" align="left">
					<?php  echo $this->Paginator->sort('meta_keywords',__('Meta Key'), array('char' => true)); ?>
				</td>
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('modified',__('Modified'),array('char'=>true));?>	
				</td>
				<td align="center" width="18%"><center><?php echo __("Action"); ?></center></td>
		  </tr>
                <?php 
              if( !empty($result) ) {
				
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
			  ?>
              <tr style="height:30px;" class="gallerytr">
				<td  align="left">
					<?php echo $records[$model]['name']; ?>
				</td>
				<!--<td  align="left" style="text-align:justify;">
					<?php echo $this->Text->truncate($records[$model]['body'],50); ?>
				</td>-->
				 <td width="10%" align="left" style="text-align:justify;">
					<?php echo $this->Text->truncate($records[$model]['page_type'],30);  ?>
				</td>
                <td  align="left" style="text-align:justify;">
					<?php echo $records[$model]['meta_description'];  ?>
				</td>
                <td  align="left" style="text-align:justify;">
					<?php echo $records[$model]['meta_keywords'];  ?>
				</td>
                <td align="left">
					<?php 
						echo date(Configure::read('date_format.basic'),$records[$model]['modified']);
					 ?>
				</td>
				<td width="15%" align="center">
					<center>
					<!--edit action-->
					  <?php // echo $this->Html->link('Edit', array('plugin' => 'cms', 'controller' => 'pages','action' => 'edit', $records[$model]['id'],$prefix_routing=>true), array('class' => 'btn btn-primary', 'escape' => false) )
	   
					  echo $this->Html->link('<i class="icon-pencil icon-white"></i>'. __("Edit"), array('plugin' => 'cms', 'controller' => 'pages','action' => 'edit', $records[$model]['id']), array('class' => 'btn btn-primary', 'escape' => false) )." ";
					 // echo $this->Html->link('<i class="icon-trash icon-white"></i> Delete', array('action' => 'delete',$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false));
					  ?>
					  	<a href='javascript::void(0)' onclick='return delete_user(" <?php echo __("Are you sure you want to delete this page?"); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-danger' data-toggle="tooltip" data-placement="top" title=" <?php echo __("Click here to delete."); ?>"><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>
					  &nbsp;
					  
					</center>
			    </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <!-- <tr>
						<td align="right" colspan="6" class="border_right">  <?php echo $this->Html->image('dot.gif',array('height'=>10,'width'=>'1'));?> </td>
					 </tr> -->
			</table>
					  <?php echo $this->element('pagination'); ?> 
              <?php } 
			 		else { ?>
               <tr>
                <td align="center" style="text-align:center;" colspan="7" class="border_right"> <?php echo __("No Result Found "); ?></td>
              </tr></table>
              <?php } ?>
        
      </td>
    </tr>
  </thead>
 
</table>