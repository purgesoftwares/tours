<div id="left">
		<?php if($this->params['controller']=="reports"){ ?>
			<?php echo $this->element('reports_left'); ?>
		<?php } ?>
			<?php /*<ul class='leftMenu'>
			<li>
				<?php echo $this->Html->link(__('Dashboard'),array('plugin'=>false,'controller'=>'/'),array('escape'=>false)); ?>
			</li>
			<?php if(AuthComponent::user('user_role_id')==1 || AuthComponent::user('user_role_id')==4){ ?>
			<li>
				<?php echo $this->Html->link(__('Schedule'), array('plugin'=>'shoot','controller'=>'shoots','action'=>'index') ,array('escape'=>false)); ?>
			</li>
			<?php } ?>
			<li>
				<?php echo $this->Html->link(__('Clients'),array('plugin'=>'usermgmt','controller'=>'clients','action'=>'index'),array('escape'=>false)); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Editing List'),array('plugin'=>'shoot','controller'=>'shoots','action'=>'editing_list'),array('escape'=>false)); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Manage'),"javascript:void(0)",array('escape'=>false)); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Reports'),"javascript:void(0)",array('escape'=>false)); ?>
			</li>
		
			<?php if(AuthComponent::user('user_role_id')==1){ ?>
			<li>
				<?php echo $this->Html->link(__('Settings'),array('plugin'=>'settings','controller'=>'settings','action'=>'prefix','Site'),array('escape'=>false)); ?>
			</li>
			<?php } ?>
				
			
			</ul>
		
			 
			<li class='dropdown' >
				 
				<?php echo $this->Html->link(__('<span>Transaction Management <span> <b class="caret"></b>'),array('plugin'=>'transaction','controller'=>'transactions','action'=>'index'),array('escape'=>false,'class'=>"dropdown-toggle",'data-toggle'=>"dropdown")); ?>
				<ul class="dropdown-menu"  >
					<li>
						<?php echo $this->Html->link(__('Active Transactions'),array('plugin'=>'transaction','controller'=>'transactions','action'=>'index'),array('escape'=>false)); ?>
					</li>
					<li>
						<?php echo $this->Html->link(__('Completed Transactions'),array('plugin'=>'transaction','controller'=>'transactions','action'=>'completed'),array('escape'=>false)); ?>
					</li>
					<li>
						<?php echo $this->Html->link(__('Cancelled Transactions'),array('plugin'=>'transaction','controller'=>'transactions','action'=>'cancelled'),array('escape'=>false)); ?>
					</li>
				</ul>
			</li> */ ?>

		</div>