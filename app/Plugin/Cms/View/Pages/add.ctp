<?php 
	echo $this->Html->css(array('validationEngine.jquery'));
	echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#PageEditForm").validationEngine();
		
	//$('#pt,#sp').hide();
	//$('#pt,#sp').css('display','block');
	});
	function language(e,th){
	$('#en,#pt,#sp').slideUp('slow');
	$('.lang').css('background-color','#fff');
	$(e).slideDown('slow');
	$(th).css('background-color','#ddd');
	}
</script>


<?php
	 echo $this->Html->script(array('ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));
?>  
  <table class="table table-bordered table-striped">
 		<thead>
    		<tr>
				<th  style="background-color: #EEEEEE;">
					<div class="row-fluid">
						<h1><?php echo __("Add Page"); ?>
						<div class="pull-right">
						</div></h1>
					</div>
				</th>
    		</tr>
			<tr >
				<td>
				  	<?php echo $this->Form->create($model,array("class"=>"form-horizontal"));?>
					<ul class="nav nav-tabs" id="myTab">
					<li>
						<a data-toggle="tab" href="#pt"><?php echo __('Portuguese'); ?></a></li>
					<li class="active">
						<a data-toggle="tab" href="#en"><?php echo __('English'); ?></a>
					</li>
					<li class="">
						<a data-toggle="tab" href="#sp"><?php echo __('Spanish'); ?></a>
					</li>
					</ul>
				
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id='en' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".name"))? "error":"";?>">
					<?php echo $this->Form->label($model.".name", __('Page Name').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".name",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
					</div>
					</div>
					
					<div class="control-group <?php echo ($this->Form->error($model.".body"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".body", __('Page Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".body",array('id'=>'body')); ?><span class="help-inline"><?php echo $this->Form->error($model.".body",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'body',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_description"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_description", __('Meta Description').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_description",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_description",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keywords"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keywords", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keywords",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keywords",array("wrap"=>false)); ?></span>
            </div>
          </div>

</div>
<div class="tab-pane fade" id='pt' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".name_pt"))? "error":"";?>">
					<?php echo $this->Form->label($model.".name_pt", __('Page Name').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".name_pt",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".name_pt",array("wrap"=>false)); ?></span>
					</div>
					</div>
					<div class="control-group <?php echo ($this->Form->error($model.".body_pt"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".body_pt", __('Page Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".body_pt",array('id'=>'body_pt')); ?><span class="help-inline"><?php echo $this->Form->error($model.".body_pt",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'body_pt',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_description_pt"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_description_pt", __('Meta Description').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_description_pt",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_description_pt",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keywords_pt"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keywords_pt", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keywords_pt",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keywords_pt",array("wrap"=>false)); ?></span>
            </div>
          </div>
  
</div>
<div class="tab-pane fade" id='sp' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".name_sp"))? "error":"";?>">
					<?php echo $this->Form->label($model.".name_sp", __('Page Name').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".name_sp",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".name_sp",array("wrap"=>false)); ?></span>
					</div>
					</div>
			
					<div class="control-group <?php echo ($this->Form->error($model.".body_sp"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".body_sp", __('Page Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".body_sp",array('id'=>'body_sp')); ?><span class="help-inline"><?php echo $this->Form->error($model.".body_sp",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'body_sp',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_description_sp"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_description_sp", __('Meta Description').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_description_sp",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_description_sp",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keywords_sp"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keywords_sp", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keywords_sp",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keywords_sp",array("wrap"=>false)); ?></span>
            </div>
          </div>
  
          

</div>
</div>

 <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", __("Add"), true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i>". __("Reset"),array("action"=> "add"),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
		  <?php echo $this->Form->hidden($model.".page_type",array('class'=>'validate[required]','value'=>'cms')); ?>
<?php echo $this->Form->end();?>


          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 