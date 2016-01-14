<?php
echo $this->Html->css(array(
	'jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min',
	'jquery.fancybox.css?v=2.1.5',
));
echo $this->Html->script(array(
	'jquery.fancybox.js?v=2.1.5',
	'jquery-ui'
));
?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
              <div class="row-fluid">
				  <h1><?php echo __($pageHeading,true); ?><div class="pull-right">
					<?php 
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __('Back To Import',true)."", array("action" => "import_partner"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
				  </div></h1>
			  </div>
			</th>
		</tr>
		<tr>
			<td> 
<table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
 <thead>
   <tr style="height:30px;">
  	<th  align="left" class="" style="width:80px;"><?php echo __('User Name'); ?></th>
	<th align="left" class="" style="width:80px;"><?php echo __('Message'); ?></th>
  </tr>
  </thead>
   <tbody >
	<?php 
	//pr($result);
	if( !empty($result) ) {
		foreach($result as $key=>$records ) { 
			//pr($records);
			foreach($records as $user_name=>$errors){ 
				
				foreach($errors as $error){
				?>
				<tr style="height:30px;" class="gallerytr <?php echo $key;?>">
					<td>
						<?php echo $user_name;?>
					</td>
					<td>
						<?php 
						if(is_array($error))
							echo implode(", ",$error);
						else	
							echo $error; 
						?>
					</td>
				</tr>
				<?php
				}
			}
		} 
		?><tr><td align="right" colspan="10" >&nbsp;</td></tr>
		</tbody>
		</table>
		<?php 
		} else { ?>
		<tr>
		<td align="center" style="text-align:center;" colspan="10" class=""><?php echo __('No Result Found'); ?></td>
		</tr>
	  <?php } ?>        
      </td>
    </tr>
	</thead> 
</table>