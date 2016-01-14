<?php 
//	echo $this->Html->css(array('jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min','validationEngine.jquery'));
//echo $this->Html->script(array('jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min','jquery.validationEngine-en','jquery.validationEngine'));
?>
<script>
$(function(){
	$("#PageFrom").datepicker({
		maxDate: 0,
		changeMonth: true,
		changeYear: true,
        onSelect: function(selected) {
         $("#PageTo").datepicker("option","minDate", selected)
        }
    });
	$("#PageTo").datepicker({
		maxDate: 0,
		changeMonth: true,
		changeYear: true,
        onSelect: function(selected) {
         $("#PageFrom").datepicker("option","maxDate", selected)
        }
    });
	
	});
	jQuery(document).ready(function(){	
		jQuery("#PageAccountFileForm").validationEngine();
});

</script>
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php  echo __('Export PHC file',true);	?> 
                </h1>

                </div>
              </th>
    		</tr>
    <tr>
      <td>
      
<?php echo $this->Form->create($model,array('url'=>array('action'=>'generatereport'),"class"=>"form-horizontal"));?>
      <div class="row-fluid">
<div class="span12" >
			
          
          <div class="control-group <?php echo ($this->Form->error($model.".from"))? "error":"";?>">
           <?php echo $this->Form->label($model.".from", __('From ').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".from",array('class'=>'validate[required] datepick')); ?><span class="help-inline"><?php echo $this->Form->error($model.".from",array("wrap"=>false)); ?></span>
            </div>
          </div>
         	 
          <div class="control-group <?php echo ($this->Form->error($model.".to"))? "error":"";?>">
           <?php echo $this->Form->label($model.".to", __('To ').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".to",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".to",array("wrap"=>false)); ?></span>
            </div>
          </div>
         	  
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Export"),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i>" . __("Reset"),array('action'=>'add'),array("class"=>"btn primary","escape"=>false));
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

           

 