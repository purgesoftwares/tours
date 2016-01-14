<h4>
	The Following Shoots are on the schedule for <?php echo $date; ?>.
</h4>
<br/>
<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Date'); ?></th>
											<th><?php echo __('Time'); ?></th>
											<th><?php echo __('Photographer'); ?></th>
											<th><?php echo __('Address'); ?></th>
											<th><?php echo __('Client'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($shoots) ) {
										$i =  1; 	
										// pr($result);
										foreach( $shoots as $records ) { 
										?>
										<tr>
											<td><?php echo $records[$model]['date']; ?></td>
											<td><?php echo $records[$model]['hour'].':'.$records[$model]['min'].$records[$model]['meridian']; ?></td>
											<td><?php echo $records['Photographer']['first_name']; ?></td>
											<td><?php echo $records[$model]['address_1'].' '.$records[$model]['address_2'].' '.$records[$model]['city'].' '.$records[$model]['state'].' '.$records[$model]['zip']; ?></td>
											<td><?php echo $records['Client']['first_name']; ?></td>
											
										</tr>
									<?php } } ?>	
										
									</tbody>
								</table>