<?php 
 // echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));  
 // echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));
 // echo $this->Html->css(array('validationEngine.jquery'));
?>
<script>
jQuery(document).ready(function(){	
		// jQuery("#LanguageEditExpressionsForm").validationEngine();
	});
</script>
  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __('Edit'); ?> 
                <div class="pull-right">
                 <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back'),array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));?>
<?php echo $this->Form->hidden('language_id',array('value' => $language_id)); ?>
<?php echo $this->Form->hidden('page_id',array('value' => $page-1)); ?>
      <div class="row-fluid">
<div class="span12" >			
			
          <?php
		
			// pr($extrct_array[0]);die;
			// pr($extrct_array[$page-1]);die;
			$ekey	=	$page-1;
			if(isset($extrct_array[$page-1])){
				foreach($extrct_array[$page-1] as $key=>$expression){
					?>
					 <div class="control-group <?php echo ($this->Form->error($model.".".$ekey.".".$key.".msgid"))? "error":"";?>">
					   <?php echo $this->Form->label($model.".".$ekey.".".$key.".msgid", "Msgid: *",array("class"=>"control-label")); ?>
						<div class="controls">
						<?php echo $this->Form->text($model.".".$ekey.".".$key.".msgid",array('class'=>'validate[required]','readonly'=>'readonly','value'=>$expression['msgid'])); ?><span class="help-inline"><?php echo $this->Form->error($model.".".$ekey.".".$key.".msgid",array("wrap"=>false)); ?></span>
						</div>
						</br>
						<?php echo $this->Form->label($model.".".$ekey.".".$key.".msgstr", "Msgstr: *",array("class"=>"control-label")); ?>
						<div class="controls">
						<?php 
						echo $this->Form->text($model.".".$ekey.".".$key.".msgstr",array('class'=>'validate[required]','value'=>$expression['msgstr'])); ?><span class="help-inline"><?php echo $this->Form->error($model.".".$ekey.".".$key.".msgstr",array("wrap"=>false)); ?></span>
						</div>
					  </div>
					<?php
				}
				
				}
				
		  ?>
         
		  

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			
			?>
            </div>
          </div>
          



</div>
<?php echo $this->Form->end();?>

</div>
          
		  
        <?php
// pr($pages); die;
if(count($pages)>1){
 ?>
<div class="pagination pagination-right"  ><ul>
<?php 
	foreach($pages as $page_no){
	
		echo '<li class="'.(($page==$page_no+1)?'active':'').'">';
		echo $this->Html->link(($page_no+1),array('plugin'=>'language','controller'=>'languages','action'=>'edit_expressions',$language_id,$type,'page'=>($page_no+1)));
		
		echo '</li>';
	}
?></ul>
</div>
<?php 
}
?>


      </td>
    </tr>
  </thead>
 
</table>
