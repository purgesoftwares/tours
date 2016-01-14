<?php
	echo $this->Html->script(array('plugins/ckeditor/ckeditor.js'));
	echo $this->Form->create('Email', array('url' => array('plugin' => 'email', 'controller' => 'email_templates', 'action' => 'edit', $id),'class'=>'form-validate')); 
	echo $this->Form->hidden('Email.id', array('value' => $id));
?>
<body onload="return InsertHTML()">
<table class="table table-bordered table-striped">
 <thead>
   <tr>
     <th style="background-color: #EEEEEE;">
		<div class="row-fluid">
				<!--heading-->
               <h1><?php echo __('Edit Email Template'); ?>
					<div class="pull-right">
                     <?php 
						//link to back  Cms Page
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back To Email Templates"), array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					?>
					</div>
			  </h1>
        </div>
	</th>
  </tr>
  <tr>
    <td>
      <div class="row" style="padding:7px 33px;">
	
		<div class="clearfx ">
			<?php 
				echo $this->Form->label($model.'.name', __('Name').':*', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="controls input" style="margin-left:150px;">
				<?php echo $this->Form->text($model.".name",array('class'=>'','data-rule-required'=>true));  ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.name', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		<div class="clearfx ">
			<?php 
				echo $this->Form->label($model.'.subject', __('Subject').':*', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="controls input" style="margin-left:150px;">
				<?php echo $this->Form->text($model.".subject",array('class'=>'','data-rule-required'=>true));  ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.subject', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		
		
		<div  class="clearfx <?php //echo ($form->error($model.'.constants'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.constants', __('Constants').' :', array('style' => "float:left;width:130px;") ); 
			 ?>
			<div class="input" style="margin-left:150px;">
		
				<?php 
			
				if(isset($this->data['EmailTemplate']['action'])) {
					if($this->data['EmailTemplate']['action'] == 'Forgot Password') {
						 $Email_constant	= 	Configure::read('forgot_password');
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'UserPasswordChangedSuccessfully') {
						 $Email_constant	= 	Configure::read('reset_forgot_password');
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'Registration') {
						 $Email_constant	= 	Configure::read('registration');
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'VerificationMail') {
						 $Email_constant	= 	Configure::read('register_verify');
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'contact_added') {
						 $Email_constant	= 	array_flip(Configure::read('contact_added'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'booking_confirmation') {
						 $Email_constant	= 	array_flip(Configure::read('booking_confirmation'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'editing_status_done') {
						 $Email_constant	= 	array_flip(Configure::read('editing_status_done'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'invoice_reminder') {
						 $Email_constant	= 	array_flip(Configure::read('invoice_reminder'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'release_email') {
						 $Email_constant	= 	array_flip(Configure::read('release_email'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'invoice_past_due_email') {
						 $Email_constant	= 	array_flip(Configure::read('invoice_past_due_email'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'invoice_paid_email') {
						 $Email_constant	= 	array_flip(Configure::read('invoice_paid_email'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}elseif($this->data['EmailTemplate']['action'] == 'shoot_feedback') {
						 $Email_constant	= 	array_flip(Configure::read('shoot_feedback'));
						 
						echo $this->Form->select($model.".constants",$Email_constant, array('empty' => __('-- Select One --')));
					}
				} else {
					
					echo $this->Form->select($model.".constants",array(), array('empty' => __('-- Select One --')));
				}
				?>
				<span style = "padding-left:20px;padding-top:0px; valign:top">
				<?php
				echo $this->Html->link('<i class="icon-white "></i> '.__('Insert Variable'), 'javascript:void(0)',array('class'=>'btn  btn-success','escape' => false,'onclick' => 'return InsertHTML()',"escape" => false));
				?></span>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.constants', array('wrap' => false) ); ?>
				</span>
			</div>
		</div> 
		<div class="clearfx " style="padding-bottom:10px;">
		<?php 
			echo $this->Form->label($model.'.body', __('Request Body').':*', array('style' => "float:left;width:130px;") ); 
		?>
			<div class="controls input" style="margin-left:150px;">
				<?php echo $this->Form->textArea($model.".body",array('data-text-required'=>true)); //echo $this->Fck->load($model.'.body'); ?>
				
				<script type="text/javascript">
				// <![CDATA[
					CKEDITOR.replace( 'EmailTemplateBody' );
					//]]>
				</script>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.body', array('wrap' => false,'class'=>'') ); ?>
				</span>
			</div>
		</div>
		
		  
	
	
	<div>&nbsp;</div>
	<div class="clearfx">
	<!---edit cms form action -->
		<div class="input" style="margin-left:150px;">
			<input class="btn btn-primary" type="submit" value=" <?php echo __("Update") ;?>" >
			<?php 
				echo $this->Html->link(__("Cancel"),array("action" => "index"), array("class" => "btn", "escape" => false) ); 
			?>
		</div>
	</div>
   
   </div>
		<?php echo $this->Form->end(); ?>
	<!--edit cms form end-->
	<div id="image_div" class="modal hide fade" style="width:500px;height:auto;overflow:auto;"></div>
  </td>
 </tr>
</thead>
</table>
</body>
<script type='text/javascript'>
	constant();
// <![CDATA[
    function InsertHTML() {
		var strUser = document.getElementById("EmailTemplateConstants").value;
		var oEditor = CKEDITOR.instances["EmailTemplateBody"] ;
          oEditor.insertHtml('{'+strUser+'}') ;	
    }

	
	
function constant() {
		var constant = document.getElementById("EmailTemplateAction").value;
		// CKEDITOR.instances["EmailTemplateBody"].setData('') ;
			$.ajax({
				url: "<?php echo $this->Html->url(array('plugin' => 'email',"controller" => "email_templates","action" => "constants")); ?>",
				type: "POST",
				data: { constant: constant},
				dataType: 'json',
				success: function(r){
					$('#EmailTemplateConstants').empty();
						
						$('#EmailTemplateConstants').append( new Option('<?php echo __('-- Select One --'); ?>','') );
						
					$.each(r, function(val, text) {
						$('#EmailTemplateConstants').append( new Option(text,text) );
						
					});	
				}
			});
			
	return false; 
		
	 }
	//]]> 
</script>
