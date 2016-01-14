<?php 
 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js','jquery.validationEngine-en','jquery.validationEngine'));
echo $this->Html->css(array('jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min','validationEngine.jquery'));
 
?>
<script>
jQuery(document).ready(function(){	
		jQuery("#QuestionAddForm").validationEngine();


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
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1>Add New <?php echo $singularize;?>
                <div class="pull-right">
                <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To ".$humanize,array("action"=> "index",$site_id),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr>
      <td>
	  
	  <?php  $languages  = array('af'=>	'Afrikaans', 	'sq' =>	'Albanian','ar' =>	'Arabic ','eu' =>	'Basque (Basque)',	'bg' =>	'Bulgarian','be' =>	'Belarusian', 'ca' =>	'Catalan','zh' =>	'Chinese' ,'hr' =>	'Croatian', 'cs' =>	'Czech','da' =>	'Danish', 'nl'=>'Deutsch', 'et' => 'Estonian', 'en' => 'English', 'fo' =>'Faeroese', 'fa' =>	'Farsi', 'fi' =>	'Finnish', 'fr' =>	'French ', 'gd' =>	'Gaelic (Scotland)', 'ga' =>	'Irish', 'de' =>	'German',  'el' =>	'Greek', 'he' =>	'Hebrew', 'hi' =>	'Hindi', 'hu' =>	'Hungarian', 'is' =>	'Icelandic', 'id' =>	'Indonesian', 'it' =>	'Italian (Standard)', 'ja' =>	'Japanese', 'ko' =>	'Korean', 'lv' =>	'Latvian', 'lt' =>	'Lithuanian', 'mk' =>	'Macedonian (FYROM)', 'ms' =>	'Malaysian', 'mt' =>	'Maltese', 'no' =>	'Norwegian', 'pl' =>	'Polish', 'pt' =>	'Portuguese (Portugal)', 'rm' =>	'Rhaeto-Romanic ', 'ro' =>	'Romanian',  'ru' =>	'Russian', 'sz' =>	'Sami (Lappish)', 'sr' =>	'Serbian (Cyrillic)', 'sr' =>	'Serbian (Latin)', 'sk' =>	'Slovak ', 'sl' =>	'Slovenian', 'sb' =>	'Sorbian', 'es' =>	'Spanish (Spain)',  'sv' =>	'Swedish',  'th' =>'Thai', 'ts' =>	'Tsonga', 'tn' =>	'Tswana', 'tr' =>	'Turkish', 'uk' =>	'Ukrainian', 'ur' =>	'Urdu', 've' =>	'Venda', 'vi' =>	'Vietnamese', 'xh' =>	'Xhosa', 'yi' =>	'Yiddish', 'zu' =>	'Zulu'); 
//pr($languages); die;

 echo $this->Form->create($model,array("class"=>"form-horizontal")); ?>
<?php echo $this->Form->hidden($model.'.site_id',array('value' => $site_id)); ?>
      <div class="row-fluid">
<div class="span12" >
		
          <div class="control-group <?php echo ($this->Form->error($model.".name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".name", "Name: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".name",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
          <div class="control-group <?php echo ($this->Form->error($model.".short_name"))? "error":"";?>">
           <?php echo $this->Form->label($model.".short_name", "Language: *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->select($model.".short_name",$languages,array('class'=>'validate[required]','empty'=>false)); ?>
			
			<span class="help-inline"><?php echo $this->Form->error($model.".short_name",array("wrap"=>false)); ?></span>
            </div>
          </div>
         
		 
			<div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("page", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> Reset",array('action'=>'add',$dropdown_type),array("class"=>"btn primary","escape"=>false));
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

           

 