<script>
$(window).load(function() {
	if($("#partner_type").val()==2){
		$('.individual').html('');	
		$('.individual').html('NIPC *');	
	}else {
		$('.individual').html('');	
		$('.individual').html('NIF *');
	
	}
});
/* 
$(function(){
	$("#CustomerDob").attr("readonly",true);
	$("#CustomerDob").datepicker({
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
	
	
}); */
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit'). ' ' .$pageHeading;?>
            <div class="pull-right">
              <?php
				echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To ".$pageHeading,array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
				?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td>
		<?php 
		echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'customers', 'action' => 'edit'),"class"=>"form-horizontal form-validate",'type' => 'file'));
		echo $this->Form->hidden('id');		
		?>
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
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".last_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".last_name", __('Last Name').": *",array("class"=>"control-label")); ?>
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
					<div class="control-group <?php echo ($this->Form->error($model.".username"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".username", __('Username').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".username",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".username",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".dob"))? "error":"";?>"> <?php echo $this->Form->label($model.".dob", __('Date of birth').": ",array("class"=>"control-label",'id'=>'dob_label')); ?>
					<div class="controls">  <?php echo $this->Form->text($model.".dob",array('readonly'=>'readonly','class'=>'validate[required] datepick')); ?><span class="help-inline"><?php echo $this->Form->error($model.".dob",array("wrap"=>false)); ?></span> </div>
					</div>
				</div>
			</div>
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
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".user_image"))? "error":"";?>"> <?php echo $this->Form->label($model.".user_image", __('User Image').": *",array("class"=>"control-label")); ?>
					<div class="controls">  <?php echo $this->Form->file($model.".user_image",array()); 
					echo $this->Form->hidden($model.'.last_user_image',array('value'=>isset($this->data[$model]['user_image']) ? $this->data[$model]['user_image'] : ''));
					?><span class="help-inline"><?php echo $this->Form->error($model.".user_image",array("wrap"=>false)); ?></span> </div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".country"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".country", __('Country').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php 
						$countries = $this->requestAction(array('controller'=>'city','action'=>'get_countries','name'));
						echo $this->Form->select($model.".country",$countries,array('empty'=>false,'id'=>'country_id'));?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".country",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
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
					<div class="control-group <?php echo ($this->Form->error($model.".district"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".district", __('District').": ",array("class"=>"control-label")); ?>
						<div class="controls"> 
						<?php echo $this->Form->select($model.".district",$districts,array('empty'=>'Select District'));?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".district",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".county"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".county", __('County').": ",array("class"=>"control-label")); ?>
						<div class="controls"> 
						<?php echo $this->Form->select($model.".county",$counties,array('empty'=>'Select County'));?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".county",array("wrap"=>false)); ?>
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
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".zipcode"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".zipcode", __('Zipcode').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".zipcode",array('class'=>'validate[funcCall[validatezipcode]]',"data-rule-zipcode"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".zipcode",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".lat_long"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".lat_long", __('Latitude/Longitude').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".lat_long",array('class'=>'validate[required]')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".lat_long",array("wrap"=>false)); ?>
						<a style="text-decoration:none;color:#FFFFFF;" id="map_latlng" class="label-success" href="javascript:void(0);"><?php echo __('Get Latitude/Longitude');?></a>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".gender"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".gender", __('Gender').": ",array("class"=>"control-label")); 
						$options	=	Configure::read('gender');
						?>
						<div class="controls"> <?php echo $this->Form->select($model.".gender",$options,array('empty'=>false)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".gender",array("wrap"=>false)); ?>
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
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".about_me"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".about_me", __('About Me').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".about_me"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".about_me",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".address"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".address", __('Address').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".address"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".address",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".user_type"))? "error":"";?>"> 
						<?php 
							echo $this->Form->label($model.".user_type", __('User Type').": ",array("class"=>"control-label")); 
						?>
						<div class="controls">
						<?php 
								 $usertype	=	Configure::read('CUSTOMER_TYPE');
								 echo $this->Form->select($model.".user_type",$usertype,array('empty'=>false,'id'=>'user_type')); 
						?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".user_type",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".nif"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".nif", __('NIF').": *",array("class"=>"control-label",'id'=>'nif_label')); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".nif",array('class'=>'validate[required,custom[number],funcCall[validateNif]]',"data-rule-validnif"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".nif",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".bond_limit"))? "error":"";?>"> 
						<?php 
							echo $this->Form->label($model.".bond_limit", __('Bond Limit').": ",array("class"=>"control-label")); 
						?>
						<div class="controls">
						<?php 
								 echo $this->Form->text($model.".bond_limit",array('empty'=>false,'id'=>'bond_limit')); 
						?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".bond_limit",array("wrap"=>false)); ?>
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
				<div class="span5" >
					<div class="controls">
						<div class="input-prepend"> <span class="add-on"> <?php echo $this->Form->input($model.".is_verified",array("label"=>false,'type'=>'checkbox')); ?></span>
						  <input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __d("users", "Verify"); ?>" disabled="disabled" style="width:177px;" class="medium">
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

$('#user_type').change(function(){
	if($(this).val() == 1){
			
			$('#nif_label').html('');
			$('#nif_label').html('NIF *');
			$('#dob_label').html('Date of birth: *');
			$('#CustomerDob').attr('data-rule-required',true);
		}else {
			
			$('#nif_label').html('NIPC *');
			$('#dob_label').html('Date of birth: ');
			$('#CustomerDob').attr('data-rule-required',false);
		}
		
});

$(window).load(function() {
	if($("#user_type").val()==2){
		$('.individual').html('');	
		$('.individual').html('NIPC *');
		$('#dob_label').html('Date of birth: ');
		$('#CustomerDob').attr('data-rule-required',false);	
	}else {
		$('.individual').html('');	
		$('.individual').html('NIF *');
		$('#dob_label').html('Date of birth: *');
		$('#CustomerDob').attr('data-rule-required',true);
	
	}
});

$('#CustomerEditForm').submit(function() {
	$valid_string   =   '';
	$valid_string 	= 	validateNif();
	
	if(!($valid_string==true || $valid_string==""))
		$valid_string 	+= 	" /n";
	if($valid_string==true)
		$valid_string 	= 	validatezipcode();
		else
		$valid_string 	+= 	validatezipcode();
		//alert($valid_string);
	if(!($valid_string==true || $valid_string=="")){
	alert($valid_string);
	return false;
	}else{
	return true;
	}
});


function validateNif(){
	
	if($("#CustomerCountry").val()=="Portugal"){
		$string	=	$("#CustomerNif").val()+"";
		//Calculates the CheckDigit and validates it with the last digit.
		$cs	=	0;
		for($i=0;$i<9;$i++){
			$cs	=	parseInt((9-$i)*$string[$i])+parseInt($cs);	
		}
		if($cs%11!=0 || $string.length!=9){
			return "Please enter valid nif.";
		}
	}
	return true;
}


function validatezipcode(){
	
	var regExp = /^[0-9]{4}-[0-9]{3}$/;
	
	if($("#CustomerCountry").val()=="Portugal" && $("#CustomerZipcode").val()!=""){
		if(!regExp.test($("#CustomerZipcode").val())){
			return "Please enter valid zipcode.";
		}
	}
	return true;
}
</script>
<div style="" class="modal hide fade in" id="map_latlng_div">
</div>