<script>
$(function(){
	$("#PartnerDob").attr("readonly",true);
	
	$("#PartnerDob").datepicker({
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
				echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back To').' '.$pageHeading,array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
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
					<div class="control-group <?php echo ($this->Form->error($model.".partner_type"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".partner_type", __('Partner Type').": ",array("class"=>"control-label")); ?>
						<div class="controls"><?php 
								 $partner_type	=	Configure::read('PARTNERS_TYPE');
								 echo $this->Form->select($model.".partner_type",$partner_type,array('empty'=>false,'id'=>'partner_type')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".partner_type",array("wrap"=>false)); ?>
						</span> 
						</div>
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
					<div class="controls">  <?php echo $this->Form->file($model.".user_image",array('class'=>'validate[required]',"data-rule-required"=>true)); ?><span class="help-inline"><?php echo $this->Form->error($model.".user_image",array("wrap"=>false)); ?></span> </div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".password"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".password", __('Password').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->password($model.".password",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".password",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".cpassword"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".cpassword", __('Confirm password').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->password($model.".cpassword",array('class'=>'validate[required,equals[PartnerPassword]]',"data-rule-required"=>true,"data-rule-equalto"=>"#PartnerPassword")); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".cpassword",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".country"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".country", __('Country').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php 
						$countries = $this->requestAction(array('controller'=>'city','action'=>'get_countries','name'));
						echo $this->Form->select($model.".country",$countries,array('empty'=>false,'value'=>'Portugal','id'=>'country_id'));?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".country",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
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
			</div>
			<div class="row-fluid">
				
				
			
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".county"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".county", __('County').": ",array("class"=>"control-label")); ?>
						<div class="controls"> 
						<?php echo $this->Form->select($model.".county",array()/* $counties */,array('empty'=>'Select County'));?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".county",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
				<div class="clearfx control-group <?php echo ($this->Form->error('local'))? 'error':'';?>">
					<?php 
						echo $this->Form->label($model.'.local', __('Local',true).' :*', array('class' => "control-label") ); 
					?>
					<div class="controls" >
						<?php 
						echo $this->Form->select($model.".local",$locals,array('class'=>'','empty'=>__('Select Local'),"data-rule-required"=>true)); ?>
						<span class="help-inline" style="color: #B94A48;">
							<?php echo $this->Form->error($model.'.local', array('wrap' => false) ); ?>
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
						<?php echo $this->Form->label($model.".lat_long", __('Latitude/Longitude').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".lat_long",array("data-rule-required"=>true,'class'=>'validate[required]')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".lat_long",array("wrap"=>false)); ?>
						<a style="text-decoration:none;color:#FFFFFF;" id="map_latlng" class="label  label-success" href="javascript:void(0);"><?php echo __('Get Latitude/Longitude');?></a>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".company_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".company_name", __('Company Name').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".company_name"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".company_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".brand"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".brand", __('Brand').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".brand"); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".brand",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".nif"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".nif", __('NIF').": *",array("class"=>"control-label",'id'=>'nif_label')); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".nif",array('class'=>'validate[required,custom[number],funcCall[validateNif]]',"data-rule-required"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".nif",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
				<?php /* <div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".nib"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".nib", __('NIB').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".nib"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".nib",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div> */ ?>
				
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
					<div class="control-group <?php echo ($this->Form->error($model.".invoice_address"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".invoice_address", __('Invoice Address').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".invoice_address"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".invoice_address",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".invoice_zipcode"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".invoice_zipcode", __('Invoice Post Code').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".invoice_zipcode"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".invoice_zipcode",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".invoice_city"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".invoice_city", __('Invoice City').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".invoice_city"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".invoice_city",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".url"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".url", __('URL').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".url"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".url",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".general_email"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".general_email", __('General email').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".general_email",array('class'=>'validate[custom[email]]')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".general_email",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".marketing_email"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".marketing_email", __('Marketing email').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".marketing_email",array('class'=>'validate[custom[email]]')); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".marketing_email",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".cell_phone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".cell_phone", __('Cell phone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".cell_phone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".cell_phone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".mobile_phone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".mobile_phone", __('Mobile phone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".mobile_phone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".mobile_phone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_1_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_1_name", __('Contact 1 (Name of the person)').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_1_name"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_1_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_1_phone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_1_phone", __('Contact 1 phone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_1_phone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_1_phone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_1_job"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_1_job", __('Contact 1 job').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_1_job"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_1_job",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_2_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_2_name", __('Contact 2 (Name of the person)').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_2_name"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_2_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_2_phone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_2_phone", __('Contact 2 phone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_2_phone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_2_phone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_2_job"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_2_job", __('Contact 2 job').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_2_job"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_2_job",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_3_name"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_3_name", __('Contact 3 (Name of the person)').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_3_name"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_3_name",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_3_phone"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_3_phone", __('Contact 3 phone').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_3_phone"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_3_phone",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".contact_3_job"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".contact_3_job", __('Contact 3 job').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".contact_3_job"); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".contact_3_job",array("wrap"=>false)); ?>
						</span> 
						</div>
					</div>
				</div>
				
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".partner_state"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".partner_state", __('State ').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".partner_state",array('Active partner','Inactive partner','Ex-partner'),array('empty'=>false)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".partner_state",array("wrap"=>false)); ?>
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
$(window).load(function() {
	if($("#partner_type").val()==2){
		$('.individual').html('');	
		$('.individual').html('NIPC *');	
	}else {
		$('.individual').html('');	
		$('.individual').html('NIF *');
	
	}
});

$('#partner_type').change(function(){
	if($(this).val() == 1){
			
			$('#nif_label').html('');
			$('#nif_label').html('NIF *');
		}else {
			
			$('#nif_label').html('NIPC *');
		}
		
	});


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

function validateNif(field, rules, i, options){
	
	if($("#PartnerCountry").val()=="Portugal"){
		$string	=	field.val()+"";
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

function validatezipcode(field, rules, i, options){
	
	var regExp = /^[0-9]{4}-[0-9]{3}$/;
	
	if($("#PartnerCountry").val()=="Portugal" && field.val()!=""){
		if(!regExp.test(field.val())){
			return "Please enter valid zipcode.";
		}
	}
	return true;
}
</script>

<div style="" class="modal hide fade in" id="map_latlng_div" >
</div>