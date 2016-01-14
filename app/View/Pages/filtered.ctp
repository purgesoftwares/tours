<?php
	echo $this->Html->script(array('plugins/flot/jquery.flot.min.js','plugins/flot/jquery.flot.bar.order.min.js','plugins/flot/jquery.flot.pie.min.js','plugins/flot/jquery.flot.resize.min.js'));
 ?>	

<div class="row-fluid">
<div class="span6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-bar-chart"></i>
									<?php echo __('Platform revenue'); ?>
								</h3>
								<div class="actions">
									
									<!--<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a> -->
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="statistic-big">
									<!--<div class="top">
										<div class="left">
											<div class="input-medium">
												<select name="category" class='chosen-select' data-nosearch="true" onchange="javascript:changeChart($(this).val());">
													<option value="1"><?php echo __('Yearly'); ?></option>
													<option value="2"><?php echo __('Monthly'); ?></option>
													<option value="3"><?php echo __('Weekly'); ?></option>
												</select>
											</div>
										</div>
										<div class="right">
									<span id="last_difference">12<i class="icon-circle-arrow-up"></i><?php //echo ($year_increment<0)?($year_increment.'<i class="icon-circle-arrow-down"></i>'):($year_increment.'<i class="icon-circle-arrow-up"></i>'); ?></span> 
										</div>
									</div> 
									<div class="bottom">
										<div class="flot medium" id="flot-audience"></div>
									</div>-->
									<div class="left">
											<div class="input-medium" style="float:left;">
												<?php echo $this->Form->create('Transaction'); ?>
												
												<select name="month" id="smonth" class='chosen-select' data-nosearch="true" onchange="">
													<option value="January"><?php echo __('January'); ?></option>
													<option value="February"><?php echo __('February'); ?></option>
													<option value="March"><?php echo __('March'); ?></option>
													<option value="April"><?php echo __('April'); ?></option>
													<option value="May"><?php echo __('May'); ?></option>
													<option value="June"><?php echo __('June'); ?></option>
													<option value="July"><?php echo __('July'); ?></option>
													<option value="August"><?php echo __('August'); ?></option>
													<option value="September"><?php echo __('September'); ?></option>
													<option value="October"><?php echo __('October'); ?></option>
													<option value="November"><?php echo __('November'); ?></option>
													<option value="December"><?php echo __('December'); ?></option>
												</select>
												</div>
												<div class="input-medium" style="float:left; margin-left:20px;">
												<select name="year" id="syear" class='chosen-select' data-nosearch="true" onchange="">
														<?php 
														$y = date('Y');
														for($y; $y >= 2014;$y--){ ?>
															<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
														<?php } ?>
												</select>
												<script>
													$('#smonth').val('<?php echo $month; ?>');
													$('#syear').val('<?php echo $year; ?>');
												</script>
											</div>
												<div class="input-medium" style="float:left; margin-top:10px;">
												<?php echo $this->Form->submit('Filter',array('class'=>'btn btn-primary')); ?>
											</div>
												<?php echo $this->Form->end(); ?>
											<div class="clearfix"></div>
										</div>
										
									<?php if(AuthComponent::user('user_role_id')==1 || AuthComponent::user('user_role_id')==4){ ?>
									<div class="bottom">
										<ul class="stats-overview">
											
											
											<li>
												<span class="name">
													<?php echo $month; ?> Month Earning
												</span>
												<span class="value">
													<?php echo round($monthly_total_profit['RON'],2).'RON'; ?>
												</span>
												<span class="value">
													<?php echo round($monthly_total_profit['EURO'],2).'EURO'; ?>
												</span>
											</li>
											
										</ul>
									</div>
									<?php }else{ ?>
									<div class="bottom">
										<ul class="stats-overview">
											
											
											<li>
												<span class="name">
													<?php echo $month; ?> Month Earning
												</span>
												<span class="value">
													<?php echo round(((($monthly_total_profit['in']['RON']*Configure::read('Site.indirect_income'))/100)+(($monthly_total_profit['dir']['RON']*Configure::read('Site.direct_income'))/100)),2).'RON'; ?>
												</span>
												<span class="value">
													<?php echo round(((($monthly_total_profit['in']['EURO']*Configure::read('Site.indirect_income'))/100)+(($monthly_total_profit['dir']['EURO']*Configure::read('Site.direct_income'))/100)),2).'EURO'; ?>
												</span>
											</li>
											
										</ul>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					
				
					</div>
					<div class="row-fluid">
<?php if(AuthComponent::user('user_role_id')==1 || AuthComponent::user('user_role_id')==4){ ?>					
<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo __('Employees Earning'); ?>
				</h3>
				<div class="actions">
					<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
					<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x">
					<thead>
						<tr>
							<th><?php echo __('Name'); ?></th>
							
							<th width="25%"><?php echo $month.__(' Month'); ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
	if( !empty($employees_transactons) ) {
		$i =  1; 	
		foreach( $employees_transactons as $key=>$records ) { 
		//pr($records);
		$di_rate = Configure::read('Site.direct_income');
		$in_rate = Configure::read('Site.indirect_income');
		
		$cur_earn_ron = (((empty($records[0]['cur_ron_total'])?0:$records[0]['cur_ron_total'])*$di_rate)/100) + (((empty($records[0]['cur_ron_total_ref'])?0:$records[0]['cur_ron_total_ref'])*$in_rate)/100);
		$cur_earn_euro = (((empty($records[0]['cur_euro_total'])?0:$records[0]['cur_euro_total'])*$di_rate)/100) + (((empty($records[0]['cur_euro_total_ref'])?0:$records[0]['cur_euro_total_ref'])*$in_rate)/100);
		
		?>
		<tr class="gallerytr">
			<td  align="left" >
				<?php echo $records['Employee']['first_name']." ".$records['Employee']['last_name'];?>
			</td>
			
			
			<td  align="left">
			<?php echo $cur_earn_ron.'RON';?><br/>
			<?php echo $cur_earn_euro.'EURO';?>
			</td>
			
		
		</tr>
      <?php
			$i++;
			} ?>
		<?php 
		} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>

</div>