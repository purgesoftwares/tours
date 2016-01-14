<?php echo $this->Html->script(array('plugins/select2/select2.min')); ?>
<script language="javascript">
$(function(){
	var Message	=	'<?php echo __('Confirmation'); ?>';
	$( "#show_message_div").dialog({	
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('action' => 'status_inactive')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							window.location.reload(true);
						}
					}
				});
					$(this).dialog("close");
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
	$( "#delete_user_div").dialog({
			
			title: Message,
			resizable: false,
			modal: true,
			autoOpen:false,
			width: 500,
			height: 170,
			buttons:{
				"<?php echo __('Yes Continue'); ?>": function() {
				$.ajax({
					url: "<?php echo $this->Html->url(array('action' => 'delete')); ?>",
					data: {'id':user_id},
					type: 'post',
					success: function(r){
						if(r=='error'){
							$( this ).dialog( "close" );
							alert('<?php echo __("Something went wrong. Please try again!");?>');
						}
						else{
							
							$('#delete_'+user_id).closest('tr').find('td').fadeOut('slow', 
								function(here){ 
									$(here).parents('tr:first').remove();                    
								}); 
							
						}
					}
				});
					$(this).dialog("close");
				},
				"<?php echo __('No'); ?>": function() {
				$( this ).dialog( "close" );
				}
			}
		});	
		
});


function show_message(msg,obj){
		user_id	=	$(obj).attr('id').replace("inactive_","");
		$( "#show_message_div").empty().html(msg);
		$( "#show_message_div").dialog('open');return false;
		
	} 
	
function delete_user(msg,obj){
		user_id	=	$(obj).attr('id').replace("delete_","");
		$( "#delete_user_div").empty().html(msg);
		$( "#delete_user_div").dialog('open');return false;
		
	}

</script>
<div id='show_message_div'></div>
<div id='delete_user_div'></div>

<div class="row-fluid">
					<div class="span12">
					
						<div class="box box-color box-bordered"   style="border-top: #368ee0 solid 2px;" >
							
								
									<div class="pull-right">
										<?php 
											
											
										?> 
									</div>
								
							
							<div class="box-content nopadding">
								
								<h4>
									Generate photographer payments Report according the range
								</h4>
								
									<?php echo $this->Form->create('Transaction',array()); ?>
								<div style="" class="span4" >
									<div class="control-group <?php echo ($this->Form->error($model.".range"))? "error":"";?>"  > 
										<?php echo $this->Form->label($model.".range", __('Range').": ",array("class"=>"control-label")); ?>
										<div class="controls">
											<?php echo $this->Form->select("range", array("Month","Quarter","Year"),array('empty'=>false)); ?>
										</div>
									</div>
									</div>
									<div class="span4" >
									<div class="control-group month-div <?php echo ($this->Form->error($model.".month"))? "error":"";?>" style='display:none'  > 
										<?php echo $this->Form->label($model.".month", __('Month').": ",array("class"=>"control-label")); ?>
										<div class="controls">
											<?php echo $this->Form->select("month", $avail_months,array('empty'=>false)); ?>
										</div>
									</div>
									
									<div class="control-group quarter-div <?php echo ($this->Form->error($model.".quarter"))? "error":"";?>"  style='display:none' > 
										<?php echo $this->Form->label($model.".quarter", __('Quarter').": ",array("class"=>"control-label")); ?>
										<div class="controls">
											<?php echo $this->Form->select("quarter", $avail_quaters,array('empty'=>false)); ?>
										</div>
									</div>
									
									<div class="control-group year-div <?php echo ($this->Form->error($model.".year"))? "error":"";?>"  style='display:none'> 
										<?php echo $this->Form->label($model.".year", __('Year').": ",array("class"=>"control-label")); ?>
										<div class="controls">
											<?php echo $this->Form->select("year", $avail_years,array('empty'=>false,)); ?>
										</div>
									</div>
									</div>
									<div class="span3">
										<div class="control-group">
										<div class="controls " style="margin-top:30px;">
									<?php echo $this->Form->button("Generate",array('class'=>'btn btn-primary')); ?>
										</div>
										</div>
								</div>
								<div style="" class="span4" >
									<div class="control-group <?php echo ($this->Form->error($model.".photographer"))? "error":"";?>"  > 
										<?php echo $this->Form->label($model.".photographer", __('Photographers').": ",array("class"=>"control-label")); ?>
										<div class="controls">
											<?php 
											//array_merge(array(0=>"All "),$photographers)
											echo $this->Form->select("photographer",$photographers ,array('empty'=>false,'style'=>"width:100%","multiple"=>"multiple",'placeholder'=>'All')); ?>
										</div>
									</div>
									</div>
									
									<?php echo $this->Form->end(); ?>
							</div>
							
							
							<div class="span10" style="height:300px;text-align:center;margin:10px">        
								<div id="flot-placeholder" style="width:100%;height:100%;"></div>        
							</div>
							
							<div class="pull-right">
										<?php echo $this->Form->create('Transaction',array('url'=>array('controller'=>'reports','action'=> 'export_photographer_payments_report'))); ?>
										<?php echo $this->Form->hidden("range",array('value'=>(isset($this->data['Transaction']['range'])?$this->data['Transaction']['range']:0))); ?>
										<?php echo $this->Form->hidden("month",array('value'=>(isset($this->data['Transaction']['month'])?$this->data['Transaction']['month']:date("m")))); ?>
										<?php echo $this->Form->hidden("quarter",array('value'=>(isset($this->data['Transaction']['quarter'])?$this->data['Transaction']['quarter']:1))); ?>
										<?php echo $this->Form->hidden("year",array('value'=>(isset($this->data['Transaction']['year'])?$this->data['Transaction']['year']:date("Y")))); ?>
										<?php echo $this->Form->hidden("photographer",array('value'=>(isset($this->data['Transaction']['photographer'])?json_encode($this->data['Transaction']['photographer']):0))); ?>
										
										<?php 
											echo $this->Form->button('<i class="icon-arrow-right icon-white"></i> '. __('Export'),array('class'=>'btn btn-primary','escape'=>false));
										?> 
										<?php echo $this->Form->end(); ?>
									</div>
									
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class='thefilter'>
											
											<th><?php echo __('Photographer Name'); ?></th>
											<th><?php echo __('Date of Shoot'); ?></th>
											<th><?php echo __('Shoot Title'); ?></th>
											<th><?php echo __('Payment Amount'); ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									if( !empty($results) ) {
										$i =  1; 	
										foreach( $results as $date_range=>$result ) { 
										if( !empty($result) ) {
										foreach( $result as $records ) { 
											if(!empty($records["Invoice"])){
												$subtotal = 0;
												foreach($records["Invoice"] as $invoice ) { 
												// pr($invoice); die;
												$subtotal += $invoice["Shoot"]['payment'];
										?>
											
										<tr>
											<td><?php echo $records["Photographer"]['first_name'].' '.$records["Photographer"]['last_name'];?></td>
											<td><?php echo $invoice["Shoot"]["date"];?></td>
											<td><?php echo $invoice["Shoot"]['title'];?></td>
											<td><?php echo $invoice["Shoot"]['payment']."$";?></td>
											
										</tr>
									<?php	
												}
												?>
												<tr>
													<td colspan="2">&nbsp;</td>
													
													<td><?php echo "Subtotal";?></td>
													<td><?php echo $subtotal."$";?></td>
													
												</tr>
												<?php
											}
										 }
									}} } ?>	
										
									</tbody>
								</table>
							</div>
	
	
						</div>
					</div>
				</div>
				<?php echo $this->Html->script('plugins/flot/jquery.flot.js'); ?>
				<script>
				
				$("#TransactionPhotographer").select2();
				
				var ticks = [];
				var data = [];
							<?php $i = 0;
									if( !empty($results) ) {
										$i =  1; 	
										foreach( $results as $date_range=>$result ) { 
										$total = 0;
										if( !empty($result) ) {
										foreach( $result as $records ) { 
											if(!empty($records["Invoice"])){
												foreach($records["Invoice"] as $invoice ) {
													$total += $invoice["Shoot"]['payment'];
											}
											}
											// pr($records); die;
										}
										
										}
										?>
										data.push([<?php echo $i; ?>, <?php echo $total; ?>]);
										ticks.push([<?php echo $i; ?>, '<?php echo $date_range; ?>']);
										
										<?php 
									$i++; } } ?>	
				
				
        var dataset = [{ label: "<?php echo $chart_title; ?>", data: data, color: "#5482FF" }];
        
		$(".<?php echo $range; ?>-div").show();
        var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.5
            },
            xaxis: {
                axisLabel: "Date Range",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks
            },
            yaxis: {
                axisLabel: "Total Amount",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickFormatter: function (v, axis) {
                    return v + "$";
                }
            },
            legend: {
                // noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 1,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };
		
		
					$(document).ready(function(){
						
						
						  $.plot($("#flot-placeholder"), dataset, options);
						//$("#flot-placeholder").UseTooltip();
			
			
						$("#TransactionRange").on("click",function(){
							
								$('.month-div').hide();
								$('.quarter-div').hide();
								$('.year-div').hide();
							if($(this).val()=="0")
								$('.month-div').show();
							else if($(this).val()=="1")
								$('.quarter-div').show();
							else if($(this).val()=="2")
								$('.year-div').show();
								
						});
					});
					
					 function gd(year, month, day) {
            return new Date(year, month, day).getTime();
        }
 
        var previousPoint = null, previousLabel = null;
 
        $.fn.UseTooltip = function () {
            $(this).bind("plothover", function (event, pos, item) {
                if (item) {
                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                        previousPoint = item.dataIndex;
                        previousLabel = item.series.label;
                        $("#tooltip").remove();
 
                        var x = item.datapoint[0];
                        var y = item.datapoint[1];
 
                        var color = item.series.color;
 
                        //console.log(item.series.xaxis.ticks[x].label);                
 
                        showTooltip(item.pageX,
                        item.pageY,
                        color,
                        "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong> °C");
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        };
 
        function showTooltip(x, y, color, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 40,
                left: x - 120,
                border: '2px solid ' + color,
                padding: '3px',
                'font-size': '9px',
                'border-radius': '5px',
                'background-color': '#fff',
                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }
		
				</script>