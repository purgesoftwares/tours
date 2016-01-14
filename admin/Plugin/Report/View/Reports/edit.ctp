  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Edit");?> <?php echo $singularize;?>
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To").' '. $humanize,array("action"=> "index",$dropdown_type),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array('url'=>array('action'=>'edit',$client_id,$id),"class"=>"form-validate form-horizontal"));?>
      <div class="row-fluid">
<div class="span12" >
			
         <div class="control-group <?php echo ($this->Form->error($model.".title"))? "error":"";?>">
           <?php echo $this->Form->label($model.".title", __('Invoice Title').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".title",array('class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".title",array("wrap"=>false)); ?></span>
            </div>
          </div>
          <div class="control-group <?php echo ($this->Form->error($model.".payment"))? "error":"";?>">
           <?php echo $this->Form->label($model.".payment", __('Invoice Payment').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".payment",array('class'=>'','data-rule-required'=>true,'data-rule-number'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".payment",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".due_date"))? "error":"";?>">
           <?php echo $this->Form->label($model.".due_date", __('Invoice Due date').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".due_date",array('class'=>'datepick','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".due_date",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".send_reminder"))? "error":"";?>">
           <?php echo $this->Form->label($model.".send_reminder", __('Send Reminder').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->checkbox($model.".send_reminder",array('value'=>1,'class'=>'','data-rule-required'=>false)); ?><span class="help-inline"><?php echo $this->Form->error($model.".send_reminder",array("wrap"=>false)); ?></span>
            </div>
          </div>
		   	  

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> ". __("Reset"),array('action'=>'edit',$id),array("class"=>"btn primary","escape"=>false));
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

           

 