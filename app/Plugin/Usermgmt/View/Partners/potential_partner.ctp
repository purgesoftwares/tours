<?php
echo $this->Html->css(array(
	'jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min',
	'jquery.fancybox.css?v=2.1.5',
));
echo $this->Html->script(array(
	'jquery.fancybox.js?v=2.1.5',
	'jquery-ui'
));
?>
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'partners','action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('Something went wrong. Please try again!');
						}
						else{
							$( this ).dialog( "close" );
							window.location.reload(true);
						}
					}
				});
					
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

<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1>
					<?php echo __($pageHeading,true); ?><div class="pull-right">
					<?php 
					echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add',true),array('action'=> 'add_potential_partner'),array('class'=>'btn btn-primary','escape'=>false));	
					?> <?php 
					  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport_potential'),array('class'=>'btn btn-primary','escape'=>false));	
					  echo '&nbsp;';
					  echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf_potential'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				  </div>
				  </h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
			<div class=" pull-left"><?php  echo $this->element('paging_info');  ?></div>
			<div class=" pull-right">
			<?php 
			echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			echo $this->Form->text('email',array('placeholder'=> __('Search By Email',true),'class'=>'input-medium')).'&nbsp;';
			echo $this->Form->text('name',array('placeholder'=> __('Search By Name',true),'class'=>'input-medium')); 
			?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?>
			<?php echo $this->Form->end();?></div>
                

<table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
	<td  align="left" class="" style="width:80px;"><?php   echo $this->Paginator->sort('name', __('Name',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:80px;"><?php   echo $this->Paginator->sort('commercial_agent', __('Commercial Agent',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:80px;"><?php   echo $this->Paginator->sort('commercial_code', __('Commercial code',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:80px;"><?php   echo $this->Paginator->sort('discount', __('Discount',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:80px;"><?php   echo $this->Paginator->sort('end_date', __('End Date',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:90px;"><?php  echo $this->Paginator->sort('email',__('Email',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:100px;" ><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:150px;"><?php echo __('Action'); ?></td>
	
  </tr>
  </thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $key=>$records ) { 
		?>
		<tr style="height:30px;" class="gallerytr">
		<td  align="left" >
				<?php echo $records[$model]['name'];?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['commercial_agent'];?>
			</td>
			<td  align="left" >
				<?php echo isset($records[$model]['comercial_code']) ? $records[$model]['comercial_code'] : '-'; ?>
			</td>
			<td  align="left" >
				<?php echo isset($records[$model]['discount']) ? $records[$model]['discount'].'%' : '-'; ?>
			</td>
			<td  align="left" >
				<?php echo (isset($records[$model]['end_date']) && !empty($records[$model]['end_date'])) ? date('d-M-Y',$records[$model]['end_date']): '-'; ?>
			</td>
			<td  align="left" ><a href='mailto:<?php echo $records[$model]['email'];?>'>
				<?php echo $records[$model]['email'];?> </a>
			</td>
			
			<td  align="left">
				<?php echo $records[$model]['created'];  ?>
			</td>
			
			<td  align="center">
			<div class="dropdown" style='float:left'>
				  <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
					<?php echo __('Action'); ?> <span class="caret"></span>
				  </a>
				   <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				   	<li>
					<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'edit_potential_partner',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Assign Comercial Agent',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'assign_comercial_agent',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('View Detail',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'view_potential_partner_detail',$records[$model]['id']),array('class'=>'','escape' => false));
					?>
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
			} 
			?><tr><td align="right" colspan="10" >&nbsp;</td></tr>
			</tbody>
			  </table>
			 <!--paging information-->
		<?php echo $this->element('pagination');
		} else { ?>
		<tr>
		<td align="center" style="text-align:center;" colspan="10" class=""><?php echo __('No Result Found'); ?></td>
		</tr>
	  <?php } ?>        
      </td>
    </tr>
	</thead> 
</table>