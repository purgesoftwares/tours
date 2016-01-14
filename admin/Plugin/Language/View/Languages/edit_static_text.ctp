<?php 
 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));  
 echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));
 echo $this->Html->css(array('validationEngine.jquery'));
?>
<script>
jQuery(document).ready(function(){	
		jQuery("#QuestionEditForm").validationEngine();
	});
</script>
  <table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Edit <?php echo $singularize;?>
                <div class="pull-right">
                 <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Languages",array("action"=> "index",$site_id,$language_id),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));?>
<?php echo $this->Form->hidden($model.'.site_id',array('value' => $site_id)); ?>
<?php echo $this->Form->hidden($model.'.language_id',array('value' => $language_id)); ?>
      <div class="row-fluid">
<div class="span12" >			
			
          
          <div class="control-group <?php echo ($this->Form->error($model.".price_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".price_text", "Price Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".price_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".price_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".disease_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".disease_text", "Disease Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".disease_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".disease_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".gene_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".gene_text", "gene_text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".gene_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".gene_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".method_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".method_text", "Method Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".method_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".method_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".turnarround_time_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".turnarround_time_text", "Turnarround Time Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".turnarround_time_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".turnarround_time_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".sample_type_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".sample_type_text", "Sample Type Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".sample_type_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".sample_type_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".comments_text"))? "error":"";?>">
           <?php echo $this->Form->label($model.".comments_text", "Comments Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".comments_text",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".comments_text",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".disease_not_found"))? "error":"";?>">
           <?php echo $this->Form->label($model.".disease_not_found", "Disease Not found Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".disease_not_found",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".disease_not_found",array("wrap"=>false)); ?></span>
            </div>
			<script type="text/javascript">
			// <![CDATA[
					CKEDITOR.replace('LanguageTextDiseaseNotFound',
					{
						height: 350,
						width: 800,
						enterMode : CKEDITOR.ENTER_BR
					});
			//]]>		
			</script>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".gene_not_found"))? "error":"";?>">
           <?php echo $this->Form->label($model.".gene_not_found", "Gene Not found Text:",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".gene_not_found",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".gene_not_found",array("wrap"=>false)); ?></span>
            </div>
			<script type="text/javascript">
			// <![CDATA[
					CKEDITOR.replace('LanguageTextGeneNotFound',
					{
						height: 350,
						width: 800,
						enterMode : CKEDITOR.ENTER_BR
					});
			//]]>		
			</script>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".method_not_found"))? "error":"";?>">
           <?php echo $this->Form->label($model.".method_not_found", "Method Not found Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".method_not_found",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".method_not_found",array("wrap"=>false)); ?></span>
            </div>
			<script type="text/javascript">
			// <![CDATA[
					CKEDITOR.replace('LanguageTextMethodNotFound',
					{
						height: 350,
						width: 800,
						enterMode : CKEDITOR.ENTER_BR
					});
			//]]>		
			</script>
          </div>
		  

          <div class="control-group <?php echo ($this->Form->error($model.".sample_not_found"))? "error":"";?>">
           <?php echo $this->Form->label($model.".sample_not_found", "Sample Type Not found Text: ",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".sample_not_found",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".sample_not_found",array("wrap"=>false)); ?></span>
            </div>
			<script type="text/javascript">
			// <![CDATA[
					CKEDITOR.replace('LanguageTextSampleNotFound',
					{
						height: 350,
						width: 800,
						enterMode : CKEDITOR.ENTER_BR
					});
			//]]>		
			</script>
          </div>
		  

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array('action'=>'edit',$dropdown_type,$id),array("class"=>"btn primary","escape"=>false));
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
<script>
jQuery(document).ready(function(){	
		
		$('.text,.textarea,.radio,.checkbox').css('display','none');
		$('.'+$('#QuestionType').val()).css('display','block');
				
		$('#QuestionType').on('change',function(){
			
				$('.text,.textarea,.radio,.checkbox').css('display','none');
				$('.'+$(this).val()).css('display','block');
			
		});
			
		$('.add_more').on('click',function(){
			
				var type = $('#QuestionType').val();
				
				if(type=='radio' || type =='checkbox'){
					var no = $(this).attr('alt');
					
					var html = '<div><input id="QuestionOptions'+no+'" class="validate[required]" type="text" name="data[Question]['+type+'][options]['+no+']"></div></br><button class="remove" alt="'+no+'" type="button">Remove</button></br></br>';
					$('.'+type).append(html);
					$(this).attr('alt',parseInt(no)+1);
				}
				
			
		});
			
		$('.remove').live('click',function(){
				var no = $(this).attr('alt');
				//var type = $('#QuestionType').val();
				//$(this).prev('.add_more').attr('alt',no);
				//$('.'+type+' .add_more').attr('alt',no);
				
				$(this).prev().remove();
				$(this).prev().remove();
				$(this).next().remove();
				$(this).next().remove();
				$(this).remove();
				
		});
		

});
</script>
           

 