<div class="row-fluid">
					<div class="span12">
					
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									<?php echo __($pageHeading,true); ?>
									</h3>
									<div class="pull-right">
										<?php 
											//echo $this->Html->link('<i class="icon-plus icon-white"></i> '. __('Add New Template'),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));
										?> 
									</div>
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Name'); ?></th>
											<th><?php echo __('Subject'); ?></th>
											<th><?php echo __('Template Action'); ?></th>
											<th><?php echo __('Modified'); ?></th>
											<th><?php echo __('Created'); ?></th>
											<th><?php echo __('Action'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										//pr($records);
										?>
										<tr>
											<td>  <?php echo $records[$model]['name'];?></td>
											<td class='hidden-1024'> <?php echo $records[$model]['subject'];?></td>
											<td class='hidden-480'><?php echo $records[$model]['action'];?></td>
											<td class='hidden-480'><?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['modified']));  ?></td>
											<td class='hidden-480'><?php echo date(Configure::read('date_format.basic'),strtotime($records[$model]['created']));  ?></td>
											<td class='hidden-480'><?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> '. __('Edit'), array('plugin' => 'email','controller' => 'email_templates','action' => 'edit',$records[$model]['id']),array('class'=>'btn btn-primary','onclick' => 'return InsertHTML()','escape' => false));
											?></td>
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>