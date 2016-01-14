<ul class='leftMenu'>
			<li>
				<?php echo $this->Html->link(__('Payment Report'),array('plugin'=>"report",'controller'=>'reports','action'=>'index'),array('escape'=>false)); ?>
			</li>
			
			<li>
				<?php echo $this->Html->link(__('Photographer Payments'),array('plugin'=>"report",'controller'=>'reports','action'=>'photographer_payments'),array('escape'=>false)); ?>
			</li>
			
			<li>
				<?php echo $this->Html->link(__('Editor Payments'),array('plugin'=>'report','controller'=>'reports','action'=>'editor_payments'),array('escape'=>false)); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Sales Report'),array('plugin'=>'report','controller'=>'reports','action'=>'sales_report'),array('escape'=>false)); ?>
			</li>
			
			
			</ul>