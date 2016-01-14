<?php //pr($errors);?>
<table class="table table-bordered table-striped">
 		 <thead>
    		<tr >
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
              
                <h1><?php echo __('Setting'); ?>:<?php echo $prefix;?> </h1>

                </div>
              </th>
    		</tr>
    <tr >
      <td>
      
<?php echo $this->Form->create($model,array(
			'url' => array(
				'controller' => 'settings',
				'action'	 => 'prefix',
				$prefix,
			),
		"class"=>"form-horizontal",'type' =>'file'));

?>

<div class="formColHalfsection">
			
		<?php
		$i = 0;
		//pr($settings);die;
	//	$text_extention = '';
		foreach ($settings AS $setting) {
			// pr($setting); 
			$text_extention = '';
			$key = $setting['Setting']['key'];
			$keyE = explode('.', $key);
			$keyTitle = Inflector::humanize($keyE['1']);
		
			$label = $keyTitle;
			if ($setting['Setting']['title'] != null) {
				$label = $setting['Setting']['title'];
			}

			$inputType = 'text';
			if ($setting['Setting']['input_type'] != null) {
				$inputType = $setting['Setting']['input_type'];
			}
			
			if($keyE[0] == 'Video' && $inputType == 'text'){
			 $text_extention = 'Seconds.';
			}else if($keyE[0] == 'Bid' && $inputType == 'text'){
					if($key == 'Bid.initial_amount_of_bidding'){
						$text_extention = '$';
					}else{
						$text_extention = 'Minutes';
					}
					
				}
				
			echo $this->Form->input("Setting.$i.id", array('value' => $setting['Setting']['id'])); 
			echo $this->Form->input("Setting.$i.key", array('type' => 'hidden', 'value' => $key));
			
			
			switch($inputType){
				
			 case 'checkbox':
			 ?>
			 
			<div class="fhcolm">
			<div class="controls">
				<div class="input-prepend">
				   <span class="add-on"> 
					<?php 
						$checked = ($setting['Setting']['value']==1)? 'checked':'';
						echo $this->Form->checkbox("Setting.$i.value",array("label"=>false,'checked' => $checked)); ?>
				   </span>
				   <input type="text" size="16" name="prependedInput2" id="prependedInput2" value="<?php echo __($label); ?>" disabled="disabled" style="width:185px;" class="medium">
				</div>
				<div style="padding-top:15px"></div>
			</div>
			</div>
			 <?php
			 break;	
			 case 'textarea':	
			 case 'text':
			 default:
			 ?>
			<div class="fhcolm">
			<div class="control-group <?php echo ($this->Form->error("Setting.$i.value"))? 'error':'';?>">
				<?php echo $this->Form->label("Setting.$i.value", __($label, true),array('class'=>"control-label")); ?>
				<div class="controls">
					<?php if($key=='Site.default_image' && $setting['Setting']['value']!=''){
						echo $this->Form->text("Setting.$i.value",array('type'=>'hidden','value'=>$setting['Setting']['value']));
						echo $this->Html->image(WEBSITE_URL.'uploads/profile_pic/'.$setting['Setting']['value'],array('width'=>71,'height'=>83));
						echo $this->Html->link($this->Html->image('cross.png',array('title'=>'Delete','alt' => 'delete')),array('action'=>'delete_image',$setting['Setting']['value']),array('escape'=>false),"Are you sure you wish to delete this image?");
						
					}
				 else {
					echo $this->Form->{$inputType}("Setting.$i.value",array('value'=>$setting['Setting']['value']))." ".$text_extention; 
					}?>
					<span class="help-inline">
					<a style="text-decoration:none;color:#FFFFFF;" id="map_latlng" class="label  label-success" href="javascript:void(0);"><?php echo __('Get Latitude/Longitude');?></a>
				</span>
				</div>
				
			</div>
			</div>
			 <?php
			 break;		 
			}
			$i++;
		}
	?>
		  
           <div class="form-actions">
            <div class="input" >
			<?php echo $this->Form->button(__("Save", true),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
			 echo $this->Html->link("<i class=\"icon-refresh\"></i> ".__('Reset'),array("action"=> "prefix",$prefix),array("class"=>"btn primary","escape"=>false));
			?>
            </div>
          </div>
		</div>  
<?php echo $this->Form->end();?>      
      </td>
    </tr>
  </thead>
 
</table>
<script>
$(function(){
	

	map_url	=	"<?php echo $this->Html->url(array('plugin'=>'usermgmt','controller'=>'city','action'=>'get_latlongs'));?>";
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
	