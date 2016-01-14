<script>
$(function(){
	$("#EmployeeDob").attr("readonly",true);
	$("#EmployeeDob").datepicker({
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
            <?php  echo __('Change Password'). ' ' .$pageHeading;?>
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
      <td>
		<?php 
		echo $this->Form->create($model, array("class"=>"form-horizontal form-validate",'type' => 'file'));
		echo $this->Form->hidden('id');		
		?>
        <div class="row-fluid">
          <div class="span12" >
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
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error($model.".cpassword"))? "error":"";?>"> 
						<?php echo $this->Form->label($model.".cpassword", __('Confirm password').": *",array("class"=>"control-label")); ?>
						<div class="controls"> <?php echo $this->Form->password($model.".cpassword",array('class'=>'validate[required,equals[EmployeePassword]]',"data-rule-required"=>true,"data-rule-equalto"=>"#EmployeePassword")); ?>
							<span class="help-inline">
								<?php echo $this->Form->error($model.".cpassword",array("wrap"=>false)); ?>
							</span> 
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
</script>
<div style="" class="modal hide fade in" id="map_latlng_div">
</div>