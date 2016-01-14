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
										  //echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Add Category',true),array('action'=> 'add'),array('class'=>'btn btn-primary','escape'=>false));	
									?>  
									</div>
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Name'); ?></th>
											<!-- <th><?php // echo __('Description'); ?></th> -->
											
											<th><?php echo __('Meta Description'); ?></th>
											<th><?php echo __('Meta Key'); ?></th>
											
											<th><?php echo __('Action'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($result) ) {
										$i =  1; 	
										foreach( $result as $records ) { 
										$name	=	'';
										$body	=	'';
										$metad	=	'';
										$metak	=	'';
											if($setlang == 'pt'){
												$name	=	$records[$model]['title_pt'];
												$body	=	$records[$model]['short_description_pt'];
												$metad	=	$records[$model]['meta_description_pt'];
												$metak	=	$records[$model]['meta_keywords_pt'];
											}else if($setlang == 'en'){
												$name	=	$records[$model]['title_en'];
												$body	=	$records[$model]['short_description_en'];
												$metad	=	$records[$model]['meta_description_en'];
												$metak	=	$records[$model]['meta_keyword_en'];
											}
										//echo $body;
										?>
										<tr>
											
											<td><?php echo $name; ?></td>
											<!-- <td><?php // echo $this->Text->truncate($body,40); ?></td>-->
											
											<td class='hidden-1024'><?php echo $metad;  ?></td>
											<td class='hidden-1024'><?php echo $metak;  ?></td>
											
											<td class='hidden-480'>
												
												<a href="<?php echo $this->Html->url(array('plugin' => 'cms','controller' => 'homes','action' => 'edit',$records[$model]['id']),true) ?>" class="btn" rel="tooltip" title="<?php echo __('Edit'); ?>"><i class="icon-edit"></i></a>
												
											</td>
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>