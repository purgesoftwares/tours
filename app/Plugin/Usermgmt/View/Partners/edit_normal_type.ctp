<?php 
echo $this->Html->css(array('validationEngine.jquery','colorpicker'));
echo $this->Html->script(array('jquery.validationEngine-en','jquery.validationEngine','bootstrap-colorpicker','ckeditor/ckeditor', 'ckeditor/adapters/jquery.js'));
?>
<script type="text/javascript">
 	jQuery(document).ready(function(){	
		jQuery("#PartnerEditUpgradationTypeForm").validationEngine();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit Ugradation type'); ?>
            <div class="pull-right">
               <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back to normal types',true)."", array("action" => "type_of_normal"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
			echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'partners', 'action' => 'edit_normal_type',$id),'enctype' => 'multipart/form-data'));
		  ?>
        <div class="row-fluid">
          <div class="span12" >
          </div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('name'))? 'error':'';?>">
						<?php 
							echo $this->Form->label('PartnerNormal.name', __('Type',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('name'))? 'error':'';?>" style="margin-left:150px;" >
							<?php 
							echo $this->Form->text("PartnerNormal.name",array('class'=>'textbox validate[required]','placeholder'=>__('Enter Type'))); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
			
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('price'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.price', __('Price',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('price'))? 'error':'';?>" style="margin-left:150px;" >
							<?php 
							echo Configure::read('CURRENCY_SYMBOL').' '.$this->Form->text("PartnerNormal.price",array('class'=>'textbox validate[required]','placeholder'=>'Enter Price','style'=>'width:195px')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.price', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
			
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error("PartnerNormal.description"))? "error":"";?>">
						   <?php echo $this->Form->label("PartnerNormal.description", __('Description').": ",array("class"=>"")); ?>
						<div class="input <?php echo ($this->Form->error('description'))? 'error':'';?>" style="margin-left:150px;" >
							 <?php echo $this->Form->textarea("PartnerNormal.description",array('id'=>'description')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.description', array('wrap' => false) ); ?>
							</span>
						</div>
						<script type="text/javascript">
							// <![CDATA[
									CKEDITOR.replace('description',
									{
										height: 350,
										width: 800,
										enterMode : CKEDITOR.ENTER_BR
									});
							//]]>		
					</script>
					</div>
				</div>
			
			</div>
			
			<div class="row-fluid">
			<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("PartnerNormal.status"))? "error":"";?>">
						<div class="controls">
							<div class="input-prepend" style="margin-left:156px"> <span class="add-on"> <?php echo $this->Form->checkbox("PartnerNormal.status",array("label"=>false)); ?></span>
							  <input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", "Active"); ?>" disabled="disabled" style="width:180px;" class="medium">
							</div>
						</div>
					</div>
				</div>  
				
			</div>
			<div class="form-actions">
              <div class="input" > <?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "type_of_highlight"), array("class" => "btn", "escape" => false) ); 
			?>&nbsp;&nbsp;
              </div>
            </div>
      
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>