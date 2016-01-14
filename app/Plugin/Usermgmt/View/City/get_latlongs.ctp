<style>
 
	.btn.btn-primary {
		background: none repeat scroll 0 0 #368EE0;
		color: #FFFFFF;
		filter: none;
		text-shadow: none;
	}
	.btn:first-child {
	}
	button.btn, input.btn[type="submit"] {
	}
	.btn {
		background: none repeat scroll 0 0 #EEEEEE;
		border: 0 none;
		border-radius: 0;
		box-shadow: none;
		color: #444444;
		filter: none;
		padding: 5px 9px;
		text-shadow: none;
	}
	.btn-primary {
		background-color: #006DCC;
		background-image: linear-gradient(to bottom, #0088CC, #0044CC);
		background-repeat: repeat-x;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		color: #FFFFFF;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	}
	.btn {
		-moz-border-bottom-colors: none;
		-moz-border-left-colors: none;
		-moz-border-right-colors: none;
		-moz-border-top-colors: none;
		background-color: #F5F5F5;
		background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
		background-repeat: repeat-x;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) #B3B3B3;
		border-image: none;
		border-radius: 4px;
		border-style: solid;
		border-width: 1px;
		box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
		color: #333333;
		cursor: pointer;
		display: inline-block;
		font-size: 14px;
		line-height: 20px;
		margin-bottom: 0;
		padding: 4px 12px;
		text-align: center;
		text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
		vertical-align: middle;
	}
</style>

<div class="modal-header" >
	<a data-dismiss="modal" class="close" href="#">×</a>
		<h3><?php echo __('Get Latitude/Longitude for your location');?></h3>
</div>
<div class="modal-body" style="height:500px; overflow: hidden">
<iframe src="<?php echo $this->Html->url(array('plugin'=>'usermgmt','controller'=>'city','action'=>'map'))?>" id="map_iframe" style="width:550px;height:400px;border:none;"></iframe>
	
</div>
<div class="modal-header" >
	<a class="btn btn-primary" id="mapok" href="javascript:void(0)">Ok</a>
</div>