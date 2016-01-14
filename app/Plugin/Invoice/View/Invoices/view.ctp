<?php //pr($this->data); ?>
<?php //pr($client); ?>
<script type="text/javascript">

    function PrintElem(elem)
    {
		console.log($(elem).html());
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'printable', 'height=600,width=600');
        mywindow.document.write('<html><head><title><?php echo $pageHeading; ?></title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
<div class="row-fluid" >
					<div class="span12" style="font-size:32px;">

<i class='icon-print' style="margin-left:100px; float:right;" onclick="javascript:PrintElem('#printable');" ></i>
<div class="pull-right">
                <?php
							 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ". __("Back"),array("action"=> "index",$client['Client']['id']),array("class"=>"btn btn-primary","escape"=>false));
?>
              </div>
</div>
</div>
<div class="row-fluid" id="printable">
					<div class="span12">
					
						<div class="span4" style="margin-left:30px;margin-top:50px;">
							
							<div class="row-fluid">
								<label><b>Bill To:</b></label>
							</div>
							<div style="margin-left:20px;margin-top:5px;">
								<span>
									<?php echo $this->data['Client']['first_name'].' '.$this->data['Client']['last_name'] ?>
								</span><br/>
								<span>
									<?php echo $client['Client']['address'] ?>
								</span><br/>
								<span>
									<?php echo $client['Client']['city'].', '.$client['Client']['state'].' '.$client['Client']['zipcode'] ?>
								</span><br/>
								<span>
									<?php echo $client['Client']['telephone'] ?>
								</span>
							</div>
							
						</div>
						
						<div class="span4" style="margin-left:50px;margin-top:50px; font-size:32px;line-height:36px;">
							
							
							<strong>
								Invoice
							</strong><br/>
							<strong>
								<?php 
								$due_date = explode('-',$this->data[$model]['due_date']);
								if(!$this->data[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])>=strtotime('today')){ ?>
											<?php echo "PENDING";  ?>
											<?php }elseif(!$this->data[$model]['status'] && strtotime($due_date[1]."-".$due_date[0]."-".$due_date[2])<strtotime('today')){ ?>
											<?php echo "PAST DUE";  ?>
											<?php }elseif($this->data[$model]['status']){ ?>
											<?php echo "PAID";  ?>
											<?php }  ?>
							</strong>
							
						</div>
						
						
						<div class="span7" style="margin-left:50px;margin-top:50px; margin-right:150px; text-align:right;">
							
							<div class="pull-right">
										<b>
										Invoice Date:
										</b> <?php echo date('m-d-Y',$this->data[$model]['created']); ?><br/>
										<b>
										Due Date:
										</b> <?php echo $this->data[$model]['due_date']; ?>
									</div>
							
						</div>
						<br style="clear:both;"/>
						
						<div class="span10" style="margin-left:30px;margin-top:50px;">
							
							<div class="row-fluid">
								<label style="font-size:24px;"><b>Description:</b></label>
							</div>
							<div style="margin-left:20px;margin-top:5px;">
								<div style="width:200px; font-weight:bold; text-align:right; float:left;">
										Invoice Title: &nbsp;
										</div>&nbsp; <?php echo $this->data[$model]['title']; ?><br/><br/>
										<div style="width:200px; font-weight:bold; text-align:right; float:left;">
										Contents: &nbsp;
										</div> &nbsp;<?php echo $this->data['Product']['description']; ?>
										<br/>
										<div style="width:200px; font-weight:bold; text-align:right; float:left;">
										Products: 
										</div>
										<div style="width:200px; margin-left:3px;float:left;">
										<?php if(!empty($products)){
											foreach($products as $product){
												echo "Name: ".$product["Product"]["name"];
												echo "<br/>";
												echo "Description: ".$product["Product"]["description"];
												echo "<br/>";
												echo "Price: $".$product["Product"]["price"]."<br/><br/>";
											}
										} ?>
										</div>
							</div>
							
						</div>
						
							
							<div class="span8" style="margin-left:30px;margin-top:50px;margin-right:150px;">
								<div class="pull-right">
									<table>	
										<tr>
											<td style="width:200px; font-weight:bold; text-align:right; " >
												<b>
													Price:
												</b>
											</td>
											<td>
												<?php echo "$".$this->data[$model]['payment'] ?>
											</td>
										</tr>
										<tr>
											<td style="width:200px; font-weight:bold; text-align:right; " >
												<b>
													Sales Tax:
												</b>
											</td>
											<td>
												<?php echo "$".$this->data[$model]['tax'] ?>
											</td>
										</tr>
										<tr>
											<td style="width:200px; font-weight:bold; text-align:right; " >
												<b>
													Total:
												</b>
											</td>
											<td>
												<?php echo "$".$this->data[$model]['total'] ?>
											</td>
										</tr>
									</table>
									
									
								</div>
							</div>
							
							
							<div class="span10" style="margin-left:30px;margin-top:50px;">
								<div class="pull-right">
									<table>	
										<tr>
											<td style="width:200px; font-weight:bold;" >
												<b>
												Amount:
												</b>
											</td>
											<td style="width:200px; font-weight:bold; " >
												<b>
												Remaining Balance:
												</b>
											</td>
										</tr>
										<tr>
											<td>
												
													<?php echo "$".$this->data[$model]['total'] ?>
												
											</td>
											<td>
												<?php 
												$remailing_amount = $this->data[$model]['total']-$this->data[$model]['discount_amount']-$this->data[$model]['paid'];
												echo "$".$remailing_amount ?>
											</td>
										</tr>
									<?php if(!$this->data[$model]['status']){ ?>
										<tr>
											<td colspan="2">
											<div class="pull-right">
												<?php 
												echo $this->Html->link("Make Payment",array('action'=>'pay',base64_encode($id)),array('class'=>"btn btn-primary")); ?>
											</div>
											</td>
										</tr>
									<?php } ?>
									</table>
									
									
								</div>
							</div>
							

						
						
					</div>
</div>