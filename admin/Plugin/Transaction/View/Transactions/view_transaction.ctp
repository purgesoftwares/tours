  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("View");?> <?php echo $singularize;?>
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To" ).' '. $humanize,array("action"=> "index",$dropdown_type),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
	  <style>
	  .control-label{ margin-top:0px; padding-top:0px;}
	  label{ margin-top:0px; padding-top:0px;}
	  .form-horizontal .control-label{ margin-top:0px; padding-top:0px;}
	  </style>
      
<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));?>
      <div class="row-fluid">
<div class="span12" >
			
          <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".order_id"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".order_id", __('Order Number').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['order_id']; ?><span class="help-inline"><?php echo $this->Form->error($model.".order_id",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".invoiceNR"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".invoiceNR", __('InvoiceNR').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['invoiceNR']; ?><span class="help-inline"><?php echo $this->Form->error($model.".invoiceNR",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			
			  
          </div> 
		  
          <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".seller"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".seller", __('Load Seller').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Seller']['first_name']; ?><span class="help-inline"><?php echo $this->Form->error($model.".seller",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".transporter"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".transporter", __('Load Transporter').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Transporter']['first_name']; ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group ">
			   <?php echo $this->Form->label($model.".seller_email", __('Seller Email').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Seller']['email']; ?><span class="help-inline"><?php echo $this->Form->error($model.".seller_email",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group ">
			   <?php echo $this->Form->label($model.".transporter_email", __('Transporter Email').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Transporter']['email']; ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter_email",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group ">
			   <?php echo $this->Form->label($model.".seller_mobile", __('Seller Mobile No.').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Seller']['mobile']; ?><span class="help-inline"><?php echo $this->Form->error($model.".seller_mobile",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group ">
			   <?php echo $this->Form->label($model.".transporter_mobile", __('Transporter Mobile No.').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data['Transporter']['mobile']; ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter_mobile",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".load_location"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".load_location", __('Load Location').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['load_location']; ?><span class="help-inline"><?php echo $this->Form->error($model.".load_location",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".unload_location"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".unload_location", __('Unload Location').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['unload_location']; ?><span class="help-inline"><?php echo $this->Form->error($model.".unload_location",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".money_in"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".money_in", __('Money In').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['money_in']; ?><span class="help-inline"><?php echo $this->Form->error($model.".money_in",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".money_out"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".money_out", __('Money Out').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['money_out']; ?><span class="help-inline"><?php echo $this->Form->error($model.".money_out",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
			<div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".seller_pay_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".seller_pay_date", __('Seller Payment Date').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['seller_pay_date']; ?><span class="help-inline"><?php echo $this->Form->error($model.".seller_pay_date",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".transporter_pay_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".transporter_pay_date", __('Transporter Payment Date').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['transporter_pay_date']; ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter_pay_date",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div>
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".loadnig_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".loadnig_date", __('Loading Date').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['loadnig_date']; ?><span class="help-inline"><?php echo $this->Form->error($model.".loadnig_date",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".loading_reference"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".loading_reference", __('Loading Reference').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['loading_reference']; ?><span class="help-inline"><?php echo $this->Form->error($model.".loading_reference",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".currency"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".currency", __('Currency').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $data[$model]['currency']; ?><span class="help-inline"><?php echo $this->Form->error($model.".currency",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			
			  
          </div> 
		  
		   
          
</div>
<?php echo $this->Form->end();?>

</div>
          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 