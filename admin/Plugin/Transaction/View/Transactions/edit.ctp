  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Edit");?> <?php echo $singularize;?>
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
      
<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));?>
      <div class="row-fluid">
<div class="span12" >
			
          <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".seller"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".seller", __('Load Seller').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->select($model.".seller",$clients,array('empty'=>'Select Load Seller','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".seller",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".transporter"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".transporter", __('Load Transporter').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->select($model.".transporter",$clients,array('empty'=>'Select Load Transporter','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".load_location"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".load_location", __('Load Location').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->textarea($model.".load_location",array('placeholder'=>'Enter Load Location','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".load_location",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".unload_location"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".unload_location", __('Unload Location').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->textarea($model.".unload_location",array('placeholder'=>'Enter Unload Location','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".unload_location",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".money_in"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".money_in", __('Money In').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".money_in",array('placeholder'=>'Enter Money In','class'=>'','data-rule-required'=>true,'data-rule-number'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".money_in",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".money_out"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".money_out", __('Money Out').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".money_out",array('placeholder'=>'Enter Money Out','class'=>'','data-rule-required'=>true,'data-rule-number'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".money_out",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  
          </div> 
		  
		  <div class="row-fluid">
			<div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".seller_pay_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".seller_pay_date", __('Seller Payment Date').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".seller_pay_date",array('placeholder'=>'Enter seller payment date','class'=>'datepick','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".seller_pay_date",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".transporter_pay_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".transporter_pay_date", __('Transporter Payment Date').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".transporter_pay_date",array('placeholder'=>'Enter Transporter Payment Date','class'=>'datepick','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".transporter_pay_date",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div>
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".loadnig_date"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".loadnig_date", __('Loading Date').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".loadnig_date",array('placeholder'=>'Enter Loading date','class'=>'datepick','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".loadnig_date",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".loading_reference"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".loading_reference", __('Loading Reference').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->textarea($model.".loading_reference",array('placeholder'=>'Enter Loading Reference','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".loading_reference",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".invoiceNR"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".invoiceNR", __('InvoiceNR').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".invoiceNR",array('placeholder'=>'Enter InvoiceNR','class'=>'','data-rule-required'=>false)); ?><span class="help-inline"><?php echo $this->Form->error($model.".invoiceNR",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".driver_details"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".driver_details", __('Driver Details').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->textarea($model.".driver_details",array('placeholder'=>'Enter Driver Details','class'=>'','data-rule-required'=>false)); ?><span class="help-inline"><?php echo $this->Form->error($model.".driver_details",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		  
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".truck_number"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".truck_number", __('Truck Number').": ",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".truck_number",array('placeholder'=>'Enter Truck Number','class'=>'','data-rule-required'=>false)); ?><span class="help-inline"><?php echo $this->Form->error($model.".truck_number",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".payment_terms"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".payment_terms", __('Payment Terms').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->text($model.".payment_terms",array('placeholder'=>'Enter Payment Terms','class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".payment_terms",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		
		  <div class="row-fluid">
		  <div class="span5" >
			<div class="control-group <?php echo ($this->Form->error($model.".currency"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".currency", __('Currency').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->select($model.".currency",array('RON'=>"RON",'EURO'=>"EURO"),array('empty'=>false,'class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".currency",array("wrap"=>false)); ?></span>
				</div>
			</div> 
			</div> 
			<div class="span5" >
		    <div class="control-group <?php echo ($this->Form->error($model.".status"))? "error":"";?>">
			   <?php echo $this->Form->label($model.".status", __('Status').": *",array("class"=>"control-label")); ?>
				<div class="controls">
				<?php echo $this->Form->select($model.".status",array('1'=>"Active", 0=>"Canceled"),array('empty'=>false,'class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".status",array("wrap"=>false)); ?></span>
				</div>
			  </div> 
			  </div> 
			  
          </div> 
		  
		 
		
			  
          </div> 
		   
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("page", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> " . __("Reset"),array('action'=>'add',$dropdown_type),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
          
</div>
<?php echo $this->Form->end();?>

</div>
          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 