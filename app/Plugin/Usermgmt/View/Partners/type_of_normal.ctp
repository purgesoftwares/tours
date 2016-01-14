<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __('Types of Normal accounts',true); ?>
					<div class=" pull-right">
						<?php
							echo $this->Html->link(__('Normal Account default settings'),array('plugin'=>'settings','controller'=>'settings','action'=>'prefix','PartnerAccount'),array('class'=>'btn btn-primary'));
						?>
					</div>
				  </h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
			<div class=" pull-left">&nbsp;<?php  //echo $this->element('paging_info');  ?></div>
			<div class=" pull-right">&nbsp;
			</div>
                

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
				<?php echo $records['PartnerNormal']['name'];?>
			</td>
			<td  align="left" >
				<?php echo Configure::read('CURRENCY_SYMBOL').$records['PartnerNormal']['price'];?>
			</td>
			<td  align="left" >
				<?php echo ($records['PartnerNormal']['status']==1)?'Active':'Not Active';?>
			</td>
			<td  align="left" >
				<?php echo date('d-M-Y',$records['PartnerNormal']['created']);?>
			</td>
			<td  align="center">
				<?php
				echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'partners','action' => 'edit_normal_type',$records['PartnerNormal']['id']),array('class'=>'btn btn-primary','escape' => false));
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