<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
				<div class="row-fluid"><h1><?php echo __($pageHeading,true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link('<i class="icon-arrow-left icon-white"></i> '.__('Back to Potential Partner',true),array('action'=> 'potential_partner'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
		</tr>
		<tr>
			<td>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
						
							echo $this->Form->label($model.'.name', __('Name',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['name']) && !empty($result[0][$model]['name'])) ? $result[0][$model]['name'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.description', __('Email',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['email']) && !empty($result[0][$model]['email'])) ? $result[0][$model]['email'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Comercial Agent',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['commercial_agent']) && !empty($result[0][$model]['commercial_agent'])) ? $result[0][$model]['commercial_agent'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Country',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['country']) && !empty($result[0][$model]['country'])) ? $result[0][$model]['country'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Address',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['address']) && !empty($result[0][$model]['address'])) ? $result[0][$model]['address'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Zipcode',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['zipcode']) && !empty($result[0][$model]['zipcode'])) ? $result[0][$model]['zipcode'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('County',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['county']) && !empty($result[0][$model]['county'])) ? $result[0][$model]['county'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('District',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['district']) && !empty($result[0][$model]['district'])) ? $result[0][$model]['district'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Telephone',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['telephone']) && !empty($result[0][$model]['telephone'])) ? $result[0][$model]['telephone'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Mobile',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['mobile']) && !empty($result[0][$model]['mobile'])) ? $result[0][$model]['mobile'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Activity Description',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['activities_description']) && !empty($result[0][$model]['activities_description'])) ? $result[0][$model]['activities_description'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Site Url',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['site_url']) && !empty($result[0][$model]['site_url'])) ? $result[0][$model]['site_url'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Observation',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['observations']) && !empty($result[0][$model]['observations'])) ? $result[0][$model]['observations'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Nif Nipc',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['nif_nipc']) && !empty($result[0][$model]['nif_nipc'])) ? $result[0][$model]['nif_nipc'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Facebook Link',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['facebook_link']) && !empty($result[0][$model]['facebook_link'])) ? $result[0][$model]['facebook_link'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Google Link',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['google_link']) && !empty($result[0][$model]['google_link'])) ? $result[0][$model]['google_link'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Twitter Link',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['twitter']) && !empty($result[0][$model]['twitter'])) ? $result[0][$model]['twitter'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('LinkedIn',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['linkedIn']) && !empty($result[0][$model]['linkedIn'])) ? $result[0][$model]['linkedIn'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Social Capital',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['social_capital']) && !empty($result[0][$model]['social_capital'])) ? $result[0][$model]['social_capital'] : '-';?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __('Legal form',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo (isset($result[0][$model]['legal_form']) && !empty($result[0][$model]['legal_form'])) ? $result[0][$model]['legal_form'] : '-';?>
						</div>
					</div>
				</div>
				
				
			</td>
		</tr>
	</thead> 
</table>