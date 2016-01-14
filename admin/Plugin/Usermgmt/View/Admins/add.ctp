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
				echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back To Admins'),array("action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
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
						<?php echo $this->Form->label($model.".last_name", __('Last Name').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".last_name",array("data-rule-required"=>true)); ?>
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
						<?php echo $this->Form->label($model.".telephone", __('Telephone').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".telephone",array("data-rule-required"=>true)); ?>
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
				
			</div>
			
			</div>
			
			
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
						<div class="controls"> <?php echo $this->Form->select($model.".state",$states,array('empty'=>false)); ?>
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



<!-- Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter New Client Type</h4>
      </div>
      <div class="modal-body">
        <div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error("new_type"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".new_type", __('New Client Type').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><?php echo $this->Form->text($model.".new_type",array("data-rule-required"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".new_type",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div> 
			
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save_new_client_type" >Save</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">


$(document).ready(function(){

	$("#ClientType").on('click',function(){
		if($(this).val() == 'Add New'){
			
			$('#addTypeModal').modal('show');
			
			
			
		}
	});
	$("#save_new_client_type").on('click',function(){
		
		$("span.ajax_re_error").remove();
		
		$.ajax({
				'url':"<?php echo $this->Html->url(array('plugin'=>"master",'controller'=>'categories','action'=>'addandget'));?>",
				'type':'post',
				'data':{'name':$("#ClientNewType").val()},
				'dataType':'json',
				'success':function(response){
					if(response.status){
						options	="";
						$.each(response.client_types, function(value,name){
							options+="<option value='"+value+"'>"+name+"</options>";
						});
							options+="<option value='Add New'>Add New</options>";
						$("#ClientType").html(options);
						
						$("#ClientType").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
						
						$("#ClientType").val($("#ClientNewType").val());
						
					}else{
						$("#ClientNewType").after('<span class="help-inline ajax_re_error">'+response.message+'</span>');
					}
					$('#addTypeModal').modal('hide');
				}
			});
	
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