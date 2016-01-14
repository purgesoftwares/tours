<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Edit");?><?php echo ' '.$singularize;?>
                <div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To"). ' '.$humanize,array("action"=> "index",$dropdown_type),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr>
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-horizontal form-validate",'enctype' => 'multipart/form-data'));?>
      
		<ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#pt"><?php echo __('Portuguese'); ?></a></li>
              <li><a data-toggle="tab" href="#en"><?php echo __('English'); ?></a></li>
              <li class="">
                <a data-toggle="tab" href="#sp"><?php echo __('Spanish'); ?></a>
              </li>
			  
        </ul>
		
      <div id="myTabContent" class="tab-content row" style="padding:7px 33px;">
		
		<div class="tab-pane fade" id='en' >
		
			<div class="clearfx control-group <?php echo ($this->Form->error('name_en'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.name_en', __('Name',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input <?php echo ($this->Form->error('name_en'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".name_en",array('class'=>'textbox validate[required]','data-rule-required'=>true));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.name_en', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('description_en'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.description_en', __('Description',true).' :', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input" style="margin-left:150px;">
					<?php echo $this->Form->textarea($model.".description_en",array('class'=>'textbox'));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.description_en', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('credit_en'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.credit_en', __('Slogan',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input <?php echo ($this->Form->error('credit_en'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".credit_en",array('class'=>'textbox validate[required]','data-rule-required'=>true));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.credit_en', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="tab-pane fade in active" id='pt' >
		
			<div class="clearfx control-group <?php echo ($this->Form->error('name_pt'))? 'error':'';?>">
				<?php 
					echo $this->Form->label($model.'.name_pt', __('Name',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
				?>
				<div class="input <?php echo ($this->Form->error('name_pt'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".name_pt",array('class'=>'textbox validate[required]','data-rule-required'=>true));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.name_pt', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('description_pt'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.description_pt', __('Description',true).' :', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input" style="margin-left:150px;">
					<?php echo $this->Form->textarea($model.".description_pt",array('class'=>'textbox'));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.description_pt', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('credit_pt'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.credit_pt', __('Slogan',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input <?php echo ($this->Form->error('credit_pt'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".credit_pt",array('class'=>'textbox validate[required]','data-rule-required'=>true));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.credit_pt', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id='sp' >
		
			<div class="clearfx control-group <?php echo ($this->Form->error('name_sp'))? 'error':'';?>">
				<?php 
					echo $this->Form->label($model.'.name_sp', __('Name',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
				?>
				<div class="input <?php echo ($this->Form->error('name_sp'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".name_sp",array('class'=>'textbox validate[required]'));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.name_sp', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('description_sp'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.description_sp', __('Description',true).' :', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input" style="margin-left:150px;">
					<?php echo $this->Form->textarea($model.".description_sp",array('class'=>'textbox'));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.description_sp', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
			<div class="clearfx control-group <?php echo ($this->Form->error('credit_sp'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.credit_sp', __('Slogan',true).' :<span class="required">*</span>', array('style' => "float:left;width:130px;") ); 
			?>
				<div class="input <?php echo ($this->Form->error('credit_sp'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->text($model.".credit_sp",array('class'=>'textbox validate[required]'));  ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.credit_sp', array('wrap' => false) ); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="clearfx control-group <?php echo ($this->Form->error('image_name'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.image_name', __('Image',true).' :<span class="required"></span>', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="input" style="margin-left:150px;">
				<?php echo $this->Form->file($model.".image_name");  ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.image_name', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		<div class="clearfx control-group <?php echo ($this->Form->error('parent_id'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.parent_id', __('Parent Category',true).' :<span class="required"></span>', array('style' => "float:left;width:150px;") ); 
			?>
			<div class="input <?php echo ($this->Form->error('parent_id'))? 'error':'';?>" style="margin-left:150px;" >
				<?php echo $this->Form->select($model.'.parent_id', $categories, array('empty' => false)); ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.parent_id', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		<div class="clearfx control-group">
			<div class="input" style="margin-left:150px;">
				
				<?php
					$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
					$file_name    = $image_name;
					$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',250,250,base64_encode($file_path),$file_name),true);
					$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
					if(is_file($file_path . $file_name)) {
						$images = $this->Html->image($image_url,array('alt' => $image_title,'title' => $image_title));
					 ?>
					<a class='colorbox-image' rel="group-1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($image_title); ?>'>
						<?php echo $images; ?>
					</a>
					<?php } else {
						echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
					}
							?>
				<span class="help-inline" style="color: #B94A48;">
				</span>
			</div>
		</div>

           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> ". __("Reset"),array('action'=>'edit',$dropdown_type,$id),array("class"=>"btn primary","escape"=>false));
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

           

 