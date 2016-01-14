<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Add New");?> <?php echo $singularize;?>
                <div class="pull-right">
                <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>".__("Back To") .$humanize,array("action"=> "index",$dropdown_type),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr>
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));?>
      <div class="row-fluid">
<div class="span12" >
			
		<div class="control-group <?php echo ($this->Form->error($model.".name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".name", __("Name").": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".name"); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
            </div>
          </div>
          <div class="">
				<?php 
				
				
				echo $this->Form->hidden($model.".dropdown_type",array('value'=>$dropdown_type)); 
			  ?>
          </div>

		  <div class="control-group <?php echo ($this->Form->error($model.".description"))? "error":"";?>">
           <?php echo $this->Form->label($model.".description", __("Description").":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".description",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".description",array("wrap"=>false)); ?></span>
            </div>
          </div>	  
		 
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("page", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i>". __(" Reset"),array('action'=>'add',$dropdown_type),array("class"=>"btn primary","escape"=>false));
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