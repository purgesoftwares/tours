<script>
$(function(){
	$("#ClientDob").attr("readonly",true);
	
	$("#ClientDob").datepicker({
			showOn: 'button',
			changeMonth: true,
			changeYear: true,
			buttonImage: '<?php echo WEBSITE_ADMIN_IMG_URL; ?>picker.png',
			buttonImageOnly: true,
			onSelect: function() {
				 $(this).blur();
			}
			  
	});
	
	$('.ui-datepicker-trigger').css({'padding-left':'5px'});
});

</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Add'). ' ' .$pageHeading;?>
            <div class="pull-right">
              <?php
				echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back To Clients'),array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
				?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php echo $this->Form->create($model,array("class"=>"form-horizontal form-validate",'type'=>'file')); ?>
        <div class="row-fluid">
          <div class="span12" >
          </div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".first_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".first_name", __('First Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".first_name",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".first_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".last_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".last_name", __('Last Name').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".last_name",array('class'=>'validate[required]')); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".last_name",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div> 
			
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".telephone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".telephone", __('Telephone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".telephone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".telephone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".mobile"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".mobile", __('Mobile').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".mobile"); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".mobile",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			
			<!--<div class="row-fluid">
				<!--<div class="span5" >
					<div class="control-group <?php// echo ($this->Form->error($model.".username"))? "error":"";?>"> 
						<?php// echo $this->Form->label($model.".username", __('Username').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php //echo $this->Form->text($model.".username",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php //echo $this->Form->error($model.".username",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div> 
				<div class="span5" >
					<div class="control-group <?php /*  echo ($this->Form->error($model.".dob"))? "error":"";?>"> <?php echo $this->Form->label($model.".dob", __('Date of birth').": ",array("class"=>"control-label")); ?>
					<div class="controls">  <?php echo $this->Form->text($model.".dob",array('readonly'=>'readonly','class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".dob",array("wrap"=>false));  */ ?></span> </div>
					</div>
				</div>
			</div>-->
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".email"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".email", __('Email').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".email",array('class'=>'validate[required,custom[email]]',"data-rule-required"=>true,"data-rule-email"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".email",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<?php /* <div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".user_image"))? "error":"";?>"> <?php echo $this->Form->label($model.".user_image", __('Company Logo').": ",array("class"=>"control-label")); ?>
					<div class="controls">  <?php echo $this->Form->file($model.".user_image",array('class'=>'')); ?><span class="help-inline"><?php echo $this->Form->error($model.".user_image",array("wrap"=>false)); ?></span> </div>
					</div>
				</div> */ ?>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".company"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".company", __('Company').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".company",array('class'=>'',"data-rule-required"=>false,"data-rule-email"=>false)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".company",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			</div>
			
			<!--<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php// echo ($this->Form->error($model.".country"))? "error":"";?>"> 
						<?php //echo $this->Form->label($model.".country", __('Country').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php 
						//$countries = $this->requestAction(array('controller'=>'city','action'=>'get_countries','name'));
						//echo $this->Form->select($model.".country",$countries,array('empty'=>false,'value'=>'Portugal','id'=>'country_id'));?>
						<span class="help-inline">
						<?php //echo $this->Form->error($model.".country",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php //echo ($this->Form->error($model.".state"))? "error":"";?>"> 
						<?php //echo $this->Form->label($model.".state", __('State').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php //echo $this->Form->text($model.".state"); ?>
							<span class="help-inline">
								<?php //echo $this->Form->error($model.".state",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php// echo ($this->Form->error($model.".district"))? "error":"";?>"> 
						<?php //echo $this->Form->label($model.".district", __('District').": ",array("class"=>"control-label")); ?>
						<div class="controls"> 
						<?php //echo $this->Form->select($model.".district",$districts,array('empty'=>'Select District'));?>
							<span class="help-inline">
								<?php //echo $this->Form->error($model.".district",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php //echo ($this->Form->error($model.".county"))? "error":"";?>"> 
						<?php //echo $this->Form->label($model.".county", __('County').": ",array("class"=>"control-label")); ?>
						<div class="controls"> 
						<?php //echo $this->Form->select($model.".county",array(),array('empty'=>'Select County')); ?>
						<span class="help-inline">
						<?php //echo $this->Form->error($model.".county",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div> -->
			
			<div class="row-fluid">
			
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".address"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".address", __('Address').": ",array("class"=>"control-label")); 
						
						?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".address",array('empty'=>false)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".address",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".city"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".city", __('City').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".city"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".city",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".state"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".state", __('State').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".state"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".state",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".zipcode"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".zipcode", __('Zipcode').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".zipcode",array('class'=>'validate[]',"data-rule-number"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".zipcode",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid">
				
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".active"))? "error":"";?>">
						<div class="controls">
							<div class="input-prepend"> <span class="add-on"> <?php echo $this->Form->input($model.".active",array("label"=>false)); ?></span>
							  <input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", "Active"); ?>" disabled="disabled" style="width:185px;" class="medium">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-actions">
              <div class="input" > <?php echo $this->Form->button(__d("users", "Submit", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;
			  <?php echo $this->Html->link(__("Cancel", true),array('action'=>'index'),array("class"=>"btn btn-primary")); ?>
              </div>
            </div>
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>
<script type="text/javascript">
$(function(){
	map_url	=	"<?php echo $this->Html->url(array('controller'=>'city','action'=>'get_latlongs'));?>";
	var options = {backdrop:true,keyboard:true,show:true};
	$("#map_latlng").click(function(e){
		$.ajax({
			url: map_url,
			success: function(r){		
				$("#map_latlng_div").html(r);
				$("#map_latlng_div").modal(options);	
				$("#map_latlng_div").find("#cuisinelinkcancel").click(function(e){
					$("#map_latlng_div").modal('hide');
						return false;
				});	
			}
		});
		e.preventDefault();
	});
});
function validatezipcode(field, rules, i, options){
	
	var regExp = /^[0-9]{4}-[0-9]{3}$/;
	
	if($("#ClientCountry").val()=="Portugal" && field.val()!=""){
		if(!regExp.test(field.val())){
			return "Please enter valid zipcode.";
		}
	}
	return true;
}
</script>

<div style="" class="modal hide fade in" id="map_latlng_div" >
</div>