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
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".title_en"))? "error":"";?>">
					<?php echo $this->Form->label($model.".title_en", __('Title').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".title_en",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".title_en",array("wrap"=>false)); ?></span>
					</div>
					</div>
					
					<div class="control-group <?php echo ($this->Form->error($model.".short_description_en"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".short_description_en", __('Short Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".short_description_en",array('id'=>'short_description_en')); ?><span class="help-inline"><?php echo $this->Form->error($model.".short_description_en",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'short_description_en',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".long_description_en"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".long_description_en", __('Long Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".long_description_en",array('id'=>'long_description_en')); ?><span class="help-inline"><?php echo $this->Form->error($model.".long_description_en",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'long_description_en',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_description_en"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_description_en", __('Meta Description').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_description_en",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_description_en",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keyword_en"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keyword_en", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keyword_en",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keyword_en",array("wrap"=>false)); ?></span>
            </div>
          </div>

</div>
<div class="tab-pane fade in active" id='pt' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".title_pt"))? "error":"";?>">
					<?php echo $this->Form->label($model.".title_pt", __('Title').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".title_pt",array('class'=>'',"data-rule-required"=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".title_pt",array("wrap"=>false)); ?></span>
					</div>
					</div>
					<div class="control-group <?php echo ($this->Form->error($model.".short_description_pt"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".short_description_pt", __('Short Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".short_description_pt",array('id'=>'short_description_pt')); ?><span class="help-inline"><?php echo $this->Form->error($model.".short_description_pt",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'short_description_pt',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
		  <div class="control-group <?php echo ($this->Form->error($model.".long_description_pt"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".long_description_pt", __('Long Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".long_description_pt",array('id'=>'long_description_pt')); ?><span class="help-inline"><?php echo $this->Form->error($model.".long_description_pt",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'long_description_pt',
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
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keyword_pt"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keyword_pt", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keyword_pt",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keyword_pt",array("wrap"=>false)); ?></span>
            </div>
          </div>
  
</div>
<div class="tab-pane fade" id='sp' >
			
					<div class="control-group <?php 	 echo ($this->Form->error($model.".title_sp"))? "error":"";?>">
					<?php echo $this->Form->label($model.".title_sp", __('Title').": *",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->text($model.".title_sp",array('class'=>'validate[required]')); ?><span class="help-inline"><?php echo $this->Form->error($model.".title_sp",array("wrap"=>false)); ?></span>
					</div>
					</div>
			
					<div class="control-group <?php echo ($this->Form->error($model.".short_description_sp"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".short_description_sp", __('Short Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".short_description_sp",array('id'=>'short_description_sp')); ?><span class="help-inline"><?php echo $this->Form->error($model.".short_description_sp",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'short_description_sp',
							{
								height: 350,
								width: 600,
								enterMode : CKEDITOR.ENTER_BR
							});
					//]]>		
					</script>
			
          </div>
					<div class="control-group <?php echo ($this->Form->error($model.".long_description_sp"))? "error":"";?>">
				   <?php echo $this->Form->label($model.".long_description_sp", __('Long Description').":",array("class"=>"control-label")); ?>
					<div class="controls">
						<?php echo $this->Form->textarea($model.".long_description_sp",array('id'=>'long_description_sp')); ?><span class="help-inline"><?php echo $this->Form->error($model.".long_description_sp",array("wrap"=>false)); ?></span>
					</div>
					<script type="text/javascript">
					// <![CDATA[
							CKEDITOR.replace( 'long_description_sp',
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
		  
		  <div class="control-group <?php echo ($this->Form->error($model.".meta_keyword_sp"))? "error":"";?>">
           <?php echo $this->Form->label($model.".meta_keyword_sp", __('Meta Keyword').":",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->textarea($model.".meta_keyword_sp",array('style'=>'width:500px; height:100px;')); ?><span class="help-inline"><?php echo $this->Form->error($model.".meta_keyword_sp",array("wrap"=>false)); ?></span>
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
		 
<?php echo $this->Form->end();?>


          
        
      </td>
    </tr>
  </thead>
 
</table>

           

 