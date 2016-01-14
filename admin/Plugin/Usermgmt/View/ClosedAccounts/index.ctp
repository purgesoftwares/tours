<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __($pageHeading,true); ?><div class="pull-right">
					<?php 
					  // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate CSV',true),array('action'=>'generatereport'),array('class'=>'btn btn-primary','escape'=>false));	
					  // echo '&nbsp;';
					  // echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Generate PDF',true),array('action'=>'generate_pdf'),array('class'=>'btn btn-primary','escape'=>false));	
						?> 
				  </div></h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
			<div class=" pull-left"><?php  echo $this->element('paging_info');  ?></div>
			<div class=" pull-right">
			<?php 
			echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array('label' => false, 'div' => false)));
			echo $this->Form->text('suggested_by',array('placeholder'=> __('Search By Suggested',true),'class'=>'input-medium')).'&nbsp;';
			echo $this->Form->text('company_name',array('placeholder'=> __('Search By Company',true),'class'=>'input-medium')).'&nbsp;';
			//echo $this->Form->text('country',array('placeholder'=> __('Search By country',true),'class'=>'input-medium')); 
			?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " .__("Search", true),array('class'=>'btn btn-primary','escape'=>false));?>
			<?php echo $this->Form->end();?></div>
                

<table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
  	<td  align="left" class="" style="width:12%;"><?php   echo $this->Paginator->sort('user_image', __('User Photo',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:12%;"><?php   echo $this->Paginator->sort('first_name', __('First Name',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:12%;"><?php   echo $this->Paginator->sort('last_name', __('Last Name',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:12%;"><?php   echo $this->Paginator->sort('username', __('User Name',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:12%;"><?php  echo $this->Paginator->sort('email',__('Email',true),array('char'=>true));?></td>
	<td  align="left" class="" style="width:15%"><?php   echo $this->Paginator->sort('created',__('Created',true),array('char'=>true));?></td>
	<td align="center" class="" style="width:25%"><?php echo __('Action'); ?></td>
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
			<?php 
				if(isset($records[$model]['user_image_folder'])) {
					$file_path		=	USER_IMAGE_STORE_PATH.$records[$model]['user_image_folder'].DS ;
					$file_name		=	$records[$model]['user_image'];
					$image_url		=	$this->Html->url(array('plugin'=>'Imageresize','controller' => 'Imageresize', 'action' => 'get_image',100,100,base64_encode($file_path),$file_name),true);
					$big_image_url		=	$this->Html->url(array('plugin'=>'Imageresize','controller' => 'Imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
					if(is_file($file_path . $file_name)) {
						$images = $this->Html->image($image_url,array('alt' => $records[$model]['first_name'],'title' => $records[$model]['first_name']));
					?>
					<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['first_name']); ?>'>
						<?php echo $images; ?>
					</a>
					<?php	
					}else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					}
				}else {
				
				echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
				}	
				?>
		</td>
			
		<td  align="left" >
				<?php echo $records[$model]['first_name'];?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['last_name'];?>
			</td>
			<td  align="left" >
				<?php echo $records[$model]['username'];?>
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
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Reactivate',true), array('plugin' => 'usermgmt','controller' => 'closed_accounts','action' => 'reactive_account',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<?php /*?>
					<li>
						<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit',true), array('plugin' => 'usermgmt','controller' => 'promoters','action' => 'edit',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<li>
						<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Change Password',true), array('plugin' => 'usermgmt','controller' => 'promoters','action' => 'change_password',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<li>
					<?php 
					if($records[$model]['active'] == 1){
					?>	
					<a href='javascript::void(0)' onclick='return show_message("<?php echo __('Are you sure you want to inactive this user?'); ?>",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to inactive.'); ?>"><i class="icon-remove icon-white"></i> <?php echo __('Inactive');?></a>	
						
					<?php	
						} else { ?>
					<a href='javascript::void(0)' onclick='return show_message("<?php echo __('Are you sure you want to active this user?'); ?>",this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to active.'); ?>"><i class="icon-ok-sign icon-white"></i> <?php echo __('Active').'&nbsp;&nbsp;';?></a>	
					<?php	} ?>
					</li>
					<li>
						<a href='javascript::void(0)' onclick='return delete_user("<?php echo __('Are you sure you want to delete this user?'); ?>",this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="<?php echo __('Click here to delete.'); ?>"><i class="icon-trash icon-white"></i> <?php echo __('Delete');?></a>
					</li>
					<li>
						<?php
						echo $this->Html->link('<i class="icon-pencil icon-white"></i> '.__('Edit Privileges',true), array('plugin' => 'usermgmt','controller' => 'promoters','action' => 'user_permissions',$records[$model]['id']),array('class'=>'','escape' => false));
						?>
					</li>
					<?php */?>
				</ul>
				<?php 
					if(isset($records[$model]['reactivate_account']) && $records[$model]['reactivate_account'] == '1'){
					?>
					  <a class="btn btn-info dropdown-toggle" role="button"  href="javascript:void(0)" style='text-decoration:none'>
						<?php echo __('Requested'); ?>
					  </a>
					<?php
					}
					?>
			</div>
			
			</td>
		</tr>
      <?php
			$i++;
			} 
			?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
			</tbody>
			  </table>
			 <!--paging information-->
		<?php echo $this->element('pagination');
		} else { ?>
		<tr>
		<td align="center" style="text-align:center;" colspan="7" class=""><?php echo __('No Result Found'); ?></td>
		</tr>
	  <?php } ?>        
      </td>
    </tr>
	</thead> 
</table>