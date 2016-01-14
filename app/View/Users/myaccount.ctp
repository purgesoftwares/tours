<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __('My Account'); ?>
                <div class="pull-right">
                <?php
							 /* echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Dashboard",array("action"=> "dashboard"),array("class"=>"btn btn-primary","escape"=>false)); */
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));
  echo $this->Form->hidden('id');

?>
      <div class="row-fluid">
<div class="span12" >
			
	
		<div class="control-group <?php echo ($this->Form->error($model.".username"))? "error":"";?>">
           <?php echo $this->Form->label($model.".username", __("User Name").": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".username",array('class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".username",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
          <!-- <div class="control-group <?php echo ($this->Form->error($model.".name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".name", __("Name").": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".name",array('class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
            </div>
          </div>  -->
		  
          <div class="control-group <?php echo ($this->Form->error($model.".email"))? "error":"";?>">
           <?php echo $this->Form->label($model.".email", __("Email").": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".email",array('class'=>'','data-rule-required'=>true,'data-rule-email'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".email",array("wrap"=>false)); ?></span>
            </div>
          </div>
          
          <div class="control-group <?php echo ($this->Form->error($model.".old_password"))? "error":"";?>">
           <?php echo $this->Form->label($model.".old_password", __("Old Password").": *",array("class"=>"control-label")); ?>
            <div class="controls">
				<?php echo $this->Form->password($model.".old_password",array('class'=>'','data-rule-required'=>true)); ?>
				<span class="help-inline"><?php echo $this->Form->error($model.".old_password",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".password"))? "error":"";?>">
           <?php echo $this->Form->label($model.".password", __("New Password").": *",array("class"=>"control-label")); ?>
            <div class="controls">
				<?php echo $this->Form->password($model.".password",array('value'=>'','class'=>'','data-rule-required'=>true)); ?>
				<span class="help-inline"><?php echo $this->Form->error($model.".password",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".cpassword"))? "error":"";?>">
			<?php echo $this->Form->label($model.".cpassword",__("Confirm Password").": *",array("class"=>"control-label")); ?>
            <div class="controls">
			<?php echo $this->Form->password($model.".cpassword",array('class'=>'','data-rule-required'=>true)); ?>
				<span class="help-inline"><?php echo $this->Form->error($model.".cpassword",array("wrap"=>false)); ?></span>
            </div>
          </div>
          
            
          <!-- <div class="control-group <?php echo ($this->Form->error($model.".active"))? "error":"";?>">
           
            <div class="controls">
             <div class="input-prepend">
           <span class="add-on"> <?php echo $this->Form->input($model.".active",array("label"=>false)); ?></span><input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", "Active"); ?>" disabled="disabled" style="width:185px;" class="medium">
           </div>
            </div>
          </div>  -->
          
          
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save"),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i>".__('Reset'),array("action"=> "myaccount"),array("class"=>"btn primary","escape"=>false));
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

           

 