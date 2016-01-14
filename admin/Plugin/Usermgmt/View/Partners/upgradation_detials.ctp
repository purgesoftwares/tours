<?php
echo $this->Html->css(array(
	'jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min'
));
echo $this->Html->script(array(
	'jquery-ui'
));
?>
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
					url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt','controller' => 'partners','action' => 'delete_upgradations')); ?>",
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
		$('.upgradation').hide();
		$('#PartnerAccounttype0').click(function(){
		$('.upgradation').hide();
		$('.normaltype').show();
		});
		$('#PartnerAccounttype1').click(function(){
		$('.normaltype').hide();
		$('.upgradation').show();
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
</script>
<div id="delete_user_div"></div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __('Types of Upgradations',true); ?>
				   <div class="pull-right">
					  <?php
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back To Types'),array("action"=> "type_of_upgradation"),array("class"=>"btn btn-primary","escape"=>false));
						?>
					</div>
				  </h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
			
<table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
  	<td  align="left" class=""><b><?php  echo __('Type'); ?></b></td>
	<td  align="left" class=""><b><?php  echo __('Price'); ?></b></td>
	<td  align="left" class=""><b><?php  echo __('Status'); ?></b></td>
	<td  align="left" class=""><b><?php  echo __('Created'); ?></b></td>
	<td align="center" class="" ><b><?php echo __('Action'); ?></b></td>
  </tr>
  </thead>
   <tbody >
	<?php 
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $records ) { 
		?>
		<tr style="height:30px;" class="gallerytr">
		
		<td  align="left" >
				<?php echo $records['PartnerUpgradation']['name'];?>
			</td>
			<td  align="left" >
				<?php echo Configure::read('CURRENCY_SYMBOL').$records['PartnerUpgradation']['price'];?>
			</td>
			<td  align="left" >
				<?php echo ($records['PartnerUpgradation']['status']==1)?'Active':'Not Active';?>
			</td>
			<td  align="left" >
				<?php echo date('d-M-Y',$records['PartnerUpgradation']['created']);?>
			</td>
			<td  align="center">
				<?php
				echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'edit_upgradation_type',$records['PartnerUpgradation']['id']),array('class'=>'btn btn-primary','escape' => false));
			?>
			
			<!--
			comment because we dont allow user to delete type
			<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this upgradations?'); ?>",this);' id='delete_<?php echo $records['PartnerUpgradation']['id']; ?>' class='btn btn-danger' title="<?php echo __('Click here to delete.'); ?>"><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>-->
		</td>
		</tr>
      <?php
			$i++;
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
      </td>
    </tr>
	</thead> 
</table>