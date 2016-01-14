<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __('Types of Upgradations',true); ?>
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
	<td  align="left" class=""><b><?php  echo __('Action'); ?></b></td>
  </tr>
  </thead>
   <tbody >
	<?php 
	$result		=	Configure::read('upgradation_types');
	if( !empty($result) ) {
		$i =  1; 	
		foreach( $result as $key=>$records ) { 
		?>
		<tr style="height:30px;" class="gallerytr">
			<td  align="left" >
				<?php echo $records;?>
			</td>
			<td  align="center">
			<?php
			echo $this->Html->link('<i class="icon-ok-sign icon-white"></i> '.__('View List',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'upgradation_detials',$key),array('class'=>'btn btn-primary','escape' => false));
			?>
			</td>
		</tr>
      <?php
			$i++;
			} 
			?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
			</tbody>
			  </table>
			 <!--paging information-->
		<?php //echo $this->element('pagination');
		} else { ?>
		<tr>
		<td align="center" style="text-align:center;" colspan="9" class=""><?php echo __('No Result Found'); ?></td>
		</tr>
	  <?php } ?>        
      </td>
    </tr>
	</thead> 
</table>