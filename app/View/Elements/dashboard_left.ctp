<div id="left">

			<ul class='leftMenu'>
			<li>
				<?php echo $this->Html->link(__('Home'),array('plugin'=>false,'controller'=>'/'),array('escape'=>false)); ?>
			</li>
			
			<li>
				<?php echo $this->Html->link(__('Galleries'), array('plugin'=>'gallery','controller'=>'galleries','action'=>'index') ,array('escape'=>false)); ?>
			</li>
			
			<li>
				<?php echo $this->Html->link(__('Billing'),array('plugin'=>'invoice','controller'=>'invoices','action'=>'index'),array('escape'=>false)); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Profile'),array('plugin'=>'usermgmt','controller'=>'clients','action'=>'profile'),array('escape'=>false)); ?>
			</li>
			
			<li>
				<?php echo $this->Html->link(__('Logout'),array('plugin'=>false,'controller'=>'users','action'=>'logout'),array('escape'=>false)); ?>
			</li>
			
				
			
			</ul>
		
			<?php /* 
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