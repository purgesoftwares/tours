<?php
	echo $this->Html->script(array('plugins/flot/jquery.flot.min.js','plugins/flot/jquery.flot.bar.order.min.js','plugins/flot/jquery.flot.pie.min.js','plugins/flot/jquery.flot.resize.min.js'));
 ?>	


<div class="row-fluid">
<?php if(AuthComponent::user('user_role_id')==1 || AuthComponent::user('user_role_id')==4){ ?>					
<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo __('The Following Shoots Are Due Today:'); ?>
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
							<th><?php echo __('Time'); ?></th>
							<th width="20%"><?php echo __('Project'); ?></th>
							<th width="25%"><?php echo __('Photographer'); ?></th>
							<th><?php echo __('Status'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
										$total = 0;
										$done = 0;
									if( !empty($due_shoots) ) {
										$i =  1; 	
										foreach( $due_shoots as $records ) { 
										// pr($records);
										if($records['Shoot']['status']==3){
											$done++;
										}
										
										$total++;
										if($records['Shoot']['status']==4){
											$done++;
											continue;
										}
										?>
										<tr>
											
											<td><?php echo $records['Shoot']['hour'].":".$records['Shoot']['min'].strtoupper($records['Shoot']['meridian']); ?></td>
											<td><?php echo $records['Shoot']['title']; ?></td>
											<td><?php echo $records['Photographer']['first_name']; ?></td>
											<td><?php echo $this->Form->select($records['Shoot']['id'].'.status',Configure::read('shoot_status'),array('empty'=>false,"value"=>$records['Shoot']['status'],'id'=>'status_'.$records['Shoot']['id'],'data-id'=>$records['Shoot']['id'])); ?></td>
											
											
										</tr>
									<?php } }
if($total){
$percent = ($done/$total)*100;
}else{
$percent = 0;
}									?>	
					</tbody>
				</table>
				
				
				<script>
					$(document).ready(function(){
					
						
						$('select[id^=status_]').on('change',function(){
							this_el = $(this);
							$.ajax({
									'url':"<?php echo $this->Html->url(array('plugin'=>'shoot','controller'=>'shoots','action'=>'update_status'));?>",
									'type':'post',
									'dataType':'json',
									'data':{ 'id': $(this).data('id'), 'status':$(this).val() },
									'success':function(response){
									
										if(response.status=='4' || response.status==4){
											this_el.closest('tr').find('td').fadeOut('slow', 
											function(here){ 
												$(here).parents('tr:first').remove();                    
											}); 
										}
									}
								});
						});
						
					
					});
				</script>
				
			</div>
		</div>
	</div>
	<?php } ?>
	
</div>
<br/>
	<br/>
	<br/>
<div >
		<h4>		Completion % for Deliverable Due Today</h4>
				</div>
				<?php if($total){ ?>
				
				<div class="progress" style="background-color:gray; border-radius:7px">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $percent ?>"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent ?>%;background-color:green;border-radius:7px; text-align:center;color:#fff;">
     <?php echo $percent ?>%
  </div>
</div>

				<?php }else{
					echo "<h6>Shoot not found today</h6>";
				} ?>
