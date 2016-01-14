<?php 
 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));  
 echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));
 echo $this->Html->css(array('validationEngine.jquery'));
?>
<script>
jQuery(document).ready(function(){	
		jQuery("#LanguageEditExpressionsForm").validationEngine();
	});
</script>
  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Edit 
                <div class="pull-right">
                 <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back ",array("action"=> "translator",$site_id,$language_id),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));?>
<?php echo $this->Form->hidden('site_id',array('value' => $site_id)); ?>
<?php echo $this->Form->hidden('language_id',array('value' => $language_id)); ?>
      <div class="row-fluid">
<div class="span12" >			
			
          <?php
			if(isset($extrct_array)){
				foreach($extrct_array as $key=>$expression){
					?>
					 <div class="control-group <?php echo ($this->Form->error($model.".".$key.".msgid"))? "error":"";?>">
					   <?php echo $this->Form->label($model.".".$key.".msgid", "Msgid: *",array("class"=>"control-label")); ?>
						<div class="controls">
						<?php echo $this->Form->text($model.".".$key.".msgid",array('class'=>'validate[required]','readonly'=>'readonly','value'=>$expression['msgid'])); ?><span class="help-inline"><?php echo $this->Form->error($model.".".$key.".msgid",array("wrap"=>false)); ?></span>
						</div>
						</br>
						<?php echo $this->Form->label($model.".".$key.".msgstr", "Msgstr: *",array("class"=>"control-label")); ?>
						<div class="controls">
						<?php echo $this->Form->text($model.".".$key.".msgstr",array('class'=>'validate[required]','value'=>$expression['msgstr'])); ?><span class="help-inline"><?php echo $this->Form->error($model.".".$key.".msgstr",array("wrap"=>false)); ?></span>
						</div>
					  </div>
					<?php
				}
			}
		  ?>
         
		  

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			
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