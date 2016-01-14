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
			<li class="<?php echo $dashboardclass; ?>">
				<?php echo $this->Html->link(__('Dashboard'),array('plugin'=>false,'controller'=>'/'),array('escape'=>false)); ?>
			</li>
			<?php if(AuthComponent::user('user_role_id')==1 || AuthComponent::user('user_role_id')==4){ ?>
			<li  class="<?php echo $schedule_class; ?>" >
				<?php echo $this->Html->link(__('Schedule'), array('plugin'=>'shoot','controller'=>'shoots','action'=>'index') ,array('escape'=>false)); ?>
			</li>
			<?php } ?>
			<li class="<?php echo $clientsclass; ?>" >
				<?php echo $this->Html->link(__('Clients'),array('plugin'=>'usermgmt','controller'=>'clients','action'=>'index'),array('escape'=>false)); ?>
			</li>
			<li class="<?php echo $editing_listclass; ?>">
				<?php echo $this->Html->link(__('Editing List'), array('plugin'=>'shoot','controller'=>'shoots','action'=>'editing_list'),array('escape'=>false)); ?>
			</li>
			<li class='<?php echo $manageclass; ?>'>
				<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
					<span><?php echo __('Manage'); ?></span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li>
						<?php echo $this->Html->link(__('Staff'),array('plugin'=>'usermgmt','controller'=>'photographers','action'=>'index'),array('escape'=>false)); ?>
					</li>
					<li>
						<?php echo $this->Html->link(__('Product'),array('plugin'=>'product','controller'=>'products','action'=>'index'),array('escape'=>false)); ?>
					</li>
					<?php if(AuthComponent::user('id')==1){ ?>
					<li>
						<?php echo $this->Html->link(__('Emails'),array('plugin'=>'email','controller'=>'email_templates','action'=>'index'),array('escape'=>false)); ?>
					</li>
					<li>
						<?php echo $this->Html->link(__('Admins'),array('plugin'=>'usermgmt','controller'=>'admins','action'=>'index'),array('escape'=>false)); ?>
					</li>
					<?php } ?>
				</ul>
			</li>
				
			<li>
				<?php echo $this->Html->link(__('Reports'),array('plugin'=>'report','controller'=>'reports','action'=>'index'),array('escape'=>false)); ?>
			</li>
		
			<?php if(AuthComponent::user('user_role_id')==1 && (AuthComponent::user('id')==1)){ ?>
			<li>
			
			<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
					<span><?php echo __('Settings'); ?></span>
					<span class="caret"></span>
				</a>
					<ul class="dropdown-menu ">
					<li>
						
						<?php echo $this->Html->link(__('Site Settings'),array('plugin'=>'settings','controller'=>'settings','action'=>'prefix','Site'),array('escape'=>false)); ?>
					</li>
					<li>
						
						<?php echo $this->Html->link(__('Payment Settings'),array('plugin'=>'settings','controller'=>'settings','action'=>'prefix','Payment'),array('escape'=>false)); ?>
					</li>
					</ul>
				
				
			</li>
			<?php } ?>
				
			
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