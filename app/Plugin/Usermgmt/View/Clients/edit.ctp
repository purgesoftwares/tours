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
            <?php  echo __('Edit'). ' ' .$pageHeading;?>
            <div class="pull-right">
              <?php
				echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__('Back To Profile'),array("action"=> "profile"),array("class"=>"btn btn-primary","escape"=>false));
				?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td>
	  <?php if(AuthComponent::user('Parent.user_role_id')==3 /* || AuthComponent::user('user_role_id')==4 */){ ?>
	  <?php echo $this->Form->create($model,array("url"=>array('action'=>'edit_contact'),"class"=>"form-horizontal form-validate",'type'=>'file')); ?>
	  <?php }else{ ?>
	  <?php echo $this->Form->create($model,array("class"=>"form-horizontal form-validate",'type'=>'file')); ?>
	  <?php } ?>
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
			<?php if(AuthComponent::user('Parent.user_role_id')!=3 /* || AuthComponent::user('user_role_id')==4 */){ ?>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".type"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".type", __('Type').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->select($model.".type",array_merge($drop_downs,array('Add New'=>'Add New')),array("empty"=>false,"data-rule-required"=>true)); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".type",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div> 
			
			</div>
			<?php } ?>


			
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
					<div class="control-group <?php echo ($this->Form->error($model.".company"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".company", __('Company').": ",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->text($model.".company",array('class'=>'',"data-rule-required"=>false,"data-rule-email"=>false)); ?>
						<span class="help-inline">
						<?php echo $this->Form->error($model.".company",array("wrap"=>false)); ?>
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
			
			
			
			<!--
			<div class="row-fluid">
			
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".comment"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".comment", __('Comments').": ",array("class"=>"control-label")); 
						
						?>
						<div class="controls"> <?php echo $this->Form->textarea($model.".comment",array('empty'=>false,'value'=>'['.date('d/m/Y H:iA').'] ')); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".comment",array("wrap"=>false)); ?>
							</span> 
						</div>
					</div>
				</div>
			</div> -->
			
			
			<?php 
			// pr($this->data['Client']['Contacts']);
			if(isset($contact_data) && !empty($contact_data)){ 
					foreach($contact_data as $ckey=>$contact){
						$contact_model = "Contacts.".$ckey.".Contact";
						if(isset($contact['Contact']['id'])){
							echo $this->Form->hidden($contact_model.'.id',array('value'=>$contact['Contact']['id']));
						}
						
					?>
				<div style="margin-left:30px;">
					<div class="row-fluid">
						<div class="span5" >
							<div class="control-group <?php echo ($this->Form->error($contact_model.".first_name"))? "error":"";?>"> 
								<?php echo $this->Form->label($contact_model.".first_name", __('First Name').": *",array("class"=>"control-label")); ?>
								<div class="controls"> <?php echo $this->Form->text($contact_model.".first_name",array('class'=>'validate[required]',"data-rule-required"=>true)); ?>
								<span class="help-inline">
								<?php echo $this->Form->error($contact_model.".first_name",array("wrap"=>false)); ?>
								</span> 
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span5" >
							<div class="control-group <?php echo ($this->Form->error($contact_model.".last_name"))? "error":"";?>"> 
								<?php echo $this->Form->label($contact_model.".last_name", __('Last Name').": *",array("class"=>"control-label")); ?>
								<div class="controls"> <?php echo $this->Form->text($contact_model.".last_name",array("data-rule-required"=>true)); ?>
									<span class="help-inline">
										<?php echo $this->Form->error($contact_model.".last_name",array("wrap"=>false)); ?>
									</span> 
								</div>
							</div>
						</div> 
					
					</div>
					<div class="row-fluid">
						<div class="span5" >
							<div class="control-group <?php echo ($this->Form->error($contact_model.".email"))? "error":"";?>"> 
								<?php echo $this->Form->label($contact_model.".email", __('Email').": *",array("class"=>"control-label")); ?>
								<div class="controls"> <?php echo $this->Form->text($contact_model.".email",array('class'=>'validate[required,custom[email]]',"data-rule-required"=>true,"data-rule-email"=>true)); ?>
								<span class="help-inline">
								<?php echo $this->Form->error($contact_model.".email",array("wrap"=>false)); ?>
								</span> 
								</div>
							</div>
						</div>
						
					</div>

					<div class="row-fluid">
						<div class="span5" >
							<div class="control-group <?php echo ($this->Form->error($contact_model.".phone"))? "error":"";?>"> 
								<?php echo $this->Form->label($contact_model.".phone", __('Phone').": ",array("class"=>"control-label")); ?>
								<div class="controls"> <?php echo $this->Form->text($contact_model.".phone",array('class'=>'')); ?>
								<span class="help-inline">
								<?php echo $this->Form->error($contact_model.".phone",array("wrap"=>false)); ?>
								</span> 
								</div>
							</div>
						</div>
						
					</div>
				
					<div class="row-fluid"><a class="remove_contact_button btn btn-danger" onclick="removeContact($(this).parent().parent())">- Remove Contact</a><br/><br/></div>
				
				</div>
			<?php }
			} ?>
			<?php if(AuthComponent::user('Parent.user_role_id')!=3 /* || AuthComponent::user('user_role_id')==4 */){ ?>
			<div class="row-fluid" id="add_new_contact">
				<?php echo $this->Html->link(' + Add New Contact','javascript:void(0);',array('onclick'=>"addContact();",'class'=>'btn btn-primary')); ?>
			</div>
			<?php } ?>
			
			
			<div class="form-actions">
              <div class="input" > <?php echo $this->Form->button(__d("users", "Submit", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;
			  <?php echo $this->Html->link(__("Cancel", true),array('action'=>'profile',$id),array("class"=>"btn btn-primary")); ?>
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

contact_count = <?php echo (isset($contact_data)?count($contact_data)+2:2); ?>;
function addContact(){
	
	contact_html = '<div class="new_contact_div" style="margin-left:30px;" ><div class="row-fluid"><div class="span5" ><div class="control-group "><label class="control-label" >First Name: *</label><div class="controls"><input type="text" name="data[Contacts]['+contact_count+'][Contact][first_name]" class="" data-rule-required="true"/><span class="help-inline"></span> </div></div></div></div><div class="row-fluid"><div class="span5" ><div class="control-group "> <label class="control-label" >Last Name: *</label><div class="controls"><input type="text" name="data[Contacts]['+contact_count+'][Contact][last_name]" class="" data-rule-required="true"/><span class="help-inline"></span></div></div></div></div><div class="row-fluid"><div class="span5" ><div class="control-group "> <label class="control-label" >Email: *</label><div class="controls"><input type="text" name="data[Contacts]['+contact_count+'][Contact][email]" class="" data-rule-required="true" data-rule-email="true" /><span class="help-inline"></span></div></div></div></div><div class="row-fluid"><div class="span5" ><div class="control-group "> <label class="control-label" >Phone: </label><div class="controls"><input type="text" name="data[Contacts]['+contact_count+'][Contact][phone]" class="" /><span class="help-inline"></span></div></div></div></div><div class="row-fluid"><a class="remove_contact_button btn btn-danger" onclick="removeContact($(this).parent().parent())">- Remove Contact</a><br/><br/></div></div>';
	contact_count++;
	$("#add_new_contact").before(contact_html);
	
		/* $("a.remove_contact_button").on('click',function(){
				$(this).parent('div.new_contact_div').remove();
			});
			
	 */
}

function removeContact(ele){
	ele.remove();
}

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