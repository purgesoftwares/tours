<style>
/* .fc-event{ font-size:1.34em;} */
#add_new_shoot_model{left:40%; width:800px; position:absolute; top:-5%;}
.modal-body{max-height:1450px;}
#ShootTimeHour{width:100px;}
#ShootTimeMin{width:100px;}
#ShootTimeMeridian{width:100px;}
#GalleryTimeHour{width:60px;}
#GalleryTimeMin{width:60px;}
#GalleryTimeMeridian{width:60px;}
</style>
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __("Add New"); ?> <?php echo $singularize;?>
                <div class="pull-right">
                <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To").' '.$humanize,array("action"=> "index",$client_id),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div></h1>

                </div>
              </th>
    		</tr>
    <tr>
      <td>
      
<?php echo $this->Form->create($model,array("class"=>"form-validate form-horizontal"));
echo $this->Form->hidden('client_id',array('value'=>$client_id));
?>
      <div class="row-fluid">
<div class="span12" >
			
          
          <div class="control-group <?php echo ($this->Form->error($model.".gallery_title"))? "error":"";?>">
           <?php echo $this->Form->label($model.".gallery_title", __('Gallery Title').": *",array("class"=>"control-label")); ?>
            <div class="controls">
            <?php echo $this->Form->text($model.".gallery_title",array('class'=>'','data-rule-required'=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".gallery_title",array("wrap"=>false)); ?></span>
            </div>
          </div>
		  
		  <div class="row-fluid">
				
				<div class="span10"  >
					<div class="control-group <?php echo ($this->Form->error($model.".date"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".date", __('Release Date/Time').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".date",array('readonly'=>'readonly','class'=>'',"data-rule-required"=>true)); ?>
					<?php echo $this->Form->input($model.".time",array('type'=>'time','class'=>'')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".date",array("wrap"=>false)); ?>
						<?php echo $this->Form->error($model.".time",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="row-fluid">
				
				<div class="span5"  >
					<div class="control-group <?php echo ($this->Form->error($model.".require_payment_for_access"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".require_payment_for_access", __('Require Payment for Access').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->checkbox($model.".require_payment_for_access",array('value'=>1,'checked'=>'checked')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".require_payment_for_access",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				
				<div class="span5"  >
					<div class="control-group <?php echo ($this->Form->error($model.".recipient"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".recipient", __('Recipient').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".recipient",$contact_list,array('empty'=>false)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".recipient",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> " . __("Reset"),array('action'=>'add',$dropdown_type),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
          
</div>
<?php echo $this->Form->end();?>

</div>
          
        <script>
		$(function(){
			$("#GalleryDate").datepicker({
					showOn: 'button',
					changeMonth: true,
					changeYear: true,
					buttonImage: '<?php echo WEBSITE_ADMIN_IMG_URL; ?>cal_picker.png',
					buttonImageOnly: true,
					onSelect: function() {
						 $(this).blur();
					}
					  
			});
			
			$('.ui-datepicker-trigger').css({'padding-left':'5px'});
		});
	
        </script>
		
      </td>
    </tr>
  </thead>
 
</table>

           

 