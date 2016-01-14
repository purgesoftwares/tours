<?php
  $AdminData = array('username'=>'Admin');
  $pc	=	$this->params['plugin'].'/'.$this->params['controller'];	
  $pca	=	$this->params['plugin'].'/'.$this->params['controller'].'/'.$this->params['action'];	
  $dashboardclass		=	'';
  $userclass			=	'';
  $schedule_class			=	'';
  $manageclass			=	'';
  $clientsclass			=	'';
  $editing_listclass			=	'';
  $catclass				=	'';

  if(in_array($pc,array('/pages'))){
	$dashboardclass	=	'active';
  }else if(in_array($pc,array('usermgmt/customers','usermgmt/promoters','usermgmt/partners'))){
	$userclass	=	'active';
  }else if(in_array($pc,array('usermgmt/clients'))){
	$clientsclass	=	'active';
  }else if(in_array($pca,array('shoot/shoots/editing_list'))){
	$editing_listclass	=	'active';
  }else if(in_array($pc,array('shoot/shoots'))){
	$schedule_class	=	'active';
  }else if(in_array($pc,array('product/products','usermgmt/photographers'))){
	$manageclass	=	'active';
  }else {
	$catclass	=	'active';
  }
?>
<div class="container-fluid">
		<?php echo $this->Html->link($this->Html->image('logo2.jpg'),array('plugin'=>false,'controller'=>'pages','action'=>'display'),array('id'=>'brand','escape'=>false)); ?>
			
			<ul class='main-nav'>
			
			</ul>
			<div class="user">
				
				<div class="dropdown">
					<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown"><?php echo __('Welcome'); ?> <?php echo AuthComponent::user('username'); ?>
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
						<?php echo $this->Html->link(__('Account settings'),array('plugin'=>false,'controller'=>'users','action'=>'myaccount'),array('escape'=>false)); ?>
							
						</li>
						
						<?php 
							/* if($this->Session->check('access_mode')){
							$mode = $this->Session->read('access_mode');
							$allow_mode = $this->Session->read('allow_access_mode');
							$user_role_id = authComponent::user('user_role_id');
							if($user_role_id != 1 && $allow_mode == 1){
							if($mode==2){ ?>
							<li><?php echo $this->Html->link(__('Switch to Administrator Mode'),array('plugin'=>false,'controller'=>'users','action'=>'change_access_mode'),array('escape'=>false)); ?></li>
							<?php }elseif($mode==1){ ?>
							<li><?php echo $this->Html->link(__('Switch to Promoter Mode'),array('plugin'=>false,'controller'=>'users','action'=>'change_access_mode'),array('escape'=>false)); ?></li>
							<?php } } }  */?>
							
						
						<li>
							<?php echo $this->Html->link(__('Sign Out'),array('plugin'=>false,'controller'=>'users','action'=>'logout',time()),array('escape'=>false)); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>