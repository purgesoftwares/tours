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
			
          <div class="control-group <?php echo ($this->Form->error($model.".name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".name", __('Country Name').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".name",array('class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
            </div>
          </div>
		 

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
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

           

 