<?php
	 echo $this->Html->script(array('plugins/ckeditor/ckeditor.js'));
?>  
  <table class="table table-bordered table-striped">
 		<thead>
    		<tr>
				<th  style="background-color: #EEEEEE;">
					<div class="row-fluid">
						<h1><?php echo __("Edit Page"); ?>
						<div class="pull-right">
							<?php //echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __("Back To Pages"),$referer,array("class"=>"btn btn-primary","escape"=>false)); ?>
						</div></h1>
					</div>
				</th>
    		</tr>
			<tr >
				<td>
				<?php /* <div class="row-fluid" align='center' style='width:100%;'>
				<span onclick='language("#en",this)' class='lang' style='background-color:#ddd; padding:10px; border:1px solid #ccc; margin:0px;width:30%;'><?php echo __('English'); ?></span>
				  <span onclick='language("#pt",this)' class='lang' style='padding:10px; border:1px solid #ccc; margin:0px;width:30%;'><?php echo __('portuguese'); ?></span>
				  <span onclick='language("#sp",this)' class='lang' style='padding:10px; border:1px solid #ccc; margin:0px;width:30%;'><?php echo __('Spainish'); ?></span> </div>*/ ?>
				  	<?php echo $this->Form->create($model,array("class"=>"form-horizontal form-validate"));?>
					<?php echo $this->Form->hidden('referer',array('value'=>$referer)); ?>
					<ul class="nav nav-tabs" id="myTab">
					<li  class="active">
						<a data-toggle="tab" href="#pt"><?php echo __('Portuguese'); ?></a></li>
					<li>
						<a data-toggle="tab" href="#en"><?php echo __('English'); ?></a>
					</li>
					<li class="">
						<a data-toggle="tab" href="#sp"><?php echo __('Spanish'); ?></a>
					</li>
					</ul>
				
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade" id='en' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".name"))? "error":"";?>">
					<?php echo $this->Form->label($model.".name", __('Page Name').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".name",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".name",array("wrap"=>false)); ?></span>
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
<div class="tab-pane fade in active" id='pt' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".name_pt"))? "error":"";?>">
					<?php echo $this->Form->label($model.".name_pt", __('Page Name').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".name_pt",array('class'=>'',"data-rule-required"=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".name_pt",array("wrap"=>false)); ?></span>
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
			<?php echo $this->Form->button(__d("users", __("Save"), true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> ". __("Reset"),array("action"=> "edit",$id),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
		  <?php echo $this->Form->hidden($model.".page_type",array('class'=>'validate[required]','value'=>'cms')); ?>
<?php echo $this->Form->end();?>


          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 