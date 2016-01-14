<?php
echo $this->Html->script(array('bootstrap-modal.js','bootstrap-tabs.js'));
?>
<style>
	.table-striped tbody tr:nth-child(2n+1) td, .table-striped tbody tr:nth-child(2n+1) th {
	background-color: #fff;
	border-left:0px;
	}		
	.menu_table th, 
	.menu_table td {
	border-top-color: #DDDDDD;
	border-top-style: solid;
	border-top-width: 1px;
	line-height: 18px;
	
	padding-bottom:3px;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 3px;
	
	text-align: left;
	vertical-align: top;
	.main_checkbox{
		width:100px;
		display:none;
	}
	.main_name{
		width:100px;
	}
	.submain_checkbox{
		width:100px;
	}
	.submain_name{
		width:100px;
	}
	.subsubmain_checkbox{
		width:100px;
	}
	.subsubmain_name{
		width:100px;
	}
	

.menu_table tr td {
    vertical-align: top;
}

}
.table tr td {
    vertical-align: top;
}
.menu_table tr td {
    vertical-align: top;
}
.menu_table tr td {
    vertical-align: top;
}
.table tr th, .table tr td {
   
    padding: 0px;
}
</style>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th  style="background-color: #EEEEEE;">
				<div class="row-fluid">
				<!--heading-->
				<h1><?PHP echo __('Edit Permissions'); ?> 
                <div class="pull-right">
				<!--link for Back To Users-->
					<?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> ".__("Back To Users"),array('plugin'=>'usermgmt','controller' => 'promoters', 'action' => 'index','admin' => true),array("class"=>"btn btn-primary","escape"=>false));
					?>
				</div>
				</h1>
                </div>
			</th>
		</tr>
		<tr>
			<td style="padding-bottom:0px;">
				<div class=" tabbable tabs-left" style="margin-bottom:0px;">
					<?php /* <ul class="nav nav-tabs span3" style="width:15%" >
					  <li class="active"><a data-toggle="tab" href="#lA">Permissions</a></li>
					  <li class="" style="height:440px;">&nbsp;</li>
					</ul> */ ?>
					<div class="tab-content" style="float:left; width:100%">
						<div id="lA" class="tab-pane active">
							<div class="row-fluid">
							<div class="span12">
								<div class="control-group">
									<!--form start-->
									<?php 
									echo $this->Form->create($model,array("class"=>"form-horizontal"));
									echo $this->Form->hidden('User.resion',array('value'=>'privillages'));
									echo $this->Form->hidden('User.id',array('value'=>$id));
									?>
									<table border="0" width="100%" class="menu_table" >
										<tr>
											<?php echo $MainMenus;?>
										</tr>
										
									<tr>
										<td align="right" colspan="15" style="border-left:0px;border-top:0px;">
											<div class="form-actions">
												<div class="input" >
													<!--form actions-->
													<?php echo $this->Form->button(__("Save"),array("class"=>"btn btn-primary")); ?>&nbsp;&nbsp;<?php 
													echo $this->Form->button("<i class=\"icon-refresh\"></i>  Reset",array("class"=>"btn primary","escape"=>false,"type"=>'reset'));
													?>
												</div>
											</div>
										</td>
									</tr>
									</table>
									<?php echo $this->Form->end();?>
									<!--form end-->
								</div> 
							</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>	
	</thead> 
</table>
<script>
	$(function(){
		
	$("input[type=checkbox][id^=AdminPrivileges]").click(function(){
		var commonid = this.id;
		
		$("input[type=checkbox][id^="+commonid+"_]").attr('checked',$(this).is(':checked'));
		var parentcheck = commonid.split('_');
		var equalchek ='AdminPrivileges';
		
		equalchek = 'AdminPrivileges' + "_" + parentcheck[1];
		var parentid = 'AdminPrivileges';
		
		for(var i=1; i < parentcheck.length-1; i++){
			
			parentid = parentid + "_" + parentcheck[i];
			if($("input[type=checkbox][id^="+equalchek+"]:checked").length==0 || $("input[type=checkbox][id^="+parentid+"_]:checked").length==0 ){
				$("input[type=checkbox][id="+parentid+"]").attr('checked',$(this).is(':checked'));
			}else{
				$("input[type=checkbox][id="+parentid+"]").attr('checked',true);
			}
		}
	});
	$("input[type=checkbox][id*=candelete]").click(function(){
		commonid1	=	$(this).attr('id').replace("candelete",'canview');
		if($(this).is(':checked')){
			$("input[type=checkbox][id="+commonid1+"]").attr('checked',$(this).is(':checked'));
		}
			
	});
	$("input[type=checkbox][id*=canedit]").click(function(){
		commonid2	=	$(this).attr('id').replace("canedit",'canview');
		
		if($(this).is(':checked')){
			$("input[type=checkbox][id="+commonid2+"]").attr('checked',$(this).is(':checked'));
		}
		
	});
	$("input[type=checkbox][id*=canadd]").click(function(){
		commonid3	=	$(this).attr('id').replace("canadd",'canview');
		
		if($(this).is(':checked')){
			$("input[type=checkbox][id="+commonid3+"]").attr('checked',$(this).is(':checked'));
		}
		
	}); 
	$("#save_group_privileges").button().click(function(){
		$("#GroupPrivilegesIndexForm").submit();	
	});	
});
</script>