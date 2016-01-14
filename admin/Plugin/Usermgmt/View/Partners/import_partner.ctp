<?php
echo $this->Html->css(array('jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min','validationEngine.jquery'));
echo $this->Html->script(array('jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min','jquery.validationEngine-en','jquery.validationEngine'));
?>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Upload Excel');?>            
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php echo $this->Form->create($model,array("class"=>"form-horizontal",'type'=>'file')); ?>
        <div class="row-fluid">
          <div class="span12" >
          </div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".user_image"))? "error":"";?>"> <?php echo $this->Form->label($model.".user_image", __('Partner List excel file').": *",array("class"=>"control-label")); ?>
					<div class="controls">  <?php echo $this->Form->file($model.".user_image",array('class'=>'validate[required]')); ?><br/>
					<span>
					<?php echo $this->Html->link(__('See Example'),array('plugin'=>'usermgmt','controller'=>'partners','action'=>'downloadReport','example.xls'),array('escape'=>false)); ?>
				
					</span>
					<span class="help-inline"><?php echo $this->Form->error($model.".user_image",array("wrap"=>false)); ?></span> <br/><small><?php echo __('(Only xls file allowed)');?></small></div>
					
					</div>
					
				</div>
			</div>
			<div class="form-actions">
              <div class="input" > <?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;
			  </div>
            </div>
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>