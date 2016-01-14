<div class="row-fluid">
				<div class="span12" >
					<div class="control-group <?php echo ($this->Form->error($model.".product_id.".$num))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".product_id.".$num, /* __('Product'). */" ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".product_id.".$num,$product_list,array('empty'=>"Select Product","data-rule-required"=>true,'style'=>"float:left;",'onchange'=>"javascript:update_product_price();")); ?>
						<i class="icon-minus icon-white" style="float:left; margin:8px;" onclick="javascript:{  $(this).parent().parent().parent().remove(); update_product_price(); }"></i>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".product_id.".$num,array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>