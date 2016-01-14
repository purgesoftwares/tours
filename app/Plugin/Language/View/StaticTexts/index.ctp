<?php
echo $this->Html->css(array(
	'jquery-ui/ui-lightness/jquery-ui-1.9.0.custom.min',
	'jquery.fancybox.css?v=2.1.5',
));
echo $this->Html->script(array(
	'jquery.fancybox.js?v=2.1.5',
	'jquery-ui'
));
?>
<script language="javascript">

$(document).ready(function(){
	$('.btn').tooltip();
}); 	
</script>
<div id='delete_user_div'></div>
<table class="table table-bordered table-striped">
 <thead>
	<tr>
		<th style="background-color: #EEEEEE;">
		<div class="row-fluid">
		   <h1><?php echo $humanize;?>
			   <div class="pull-right">
			    <?php
					echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i> Back To Sites",array('plugin'=>'settings','controller'=>'settings',"action"=> "index"),array("class"=>"btn btn-primary","escape"=>false));
					?>
				 <?php 
					echo $this->Html->link('<i class="icon-plus icon-white"></i> Add New '. $singularize,array('action'=> 'add',$site_id,$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
					?> 
			  </div>
		   </h1>
		</div>
		</th>
	</tr>
	<tr>
		<td>
			<div class="row-fluid">
				<div class="span4">
					<?php  echo $this->element('paging_info'); ?>
				</div>
				<div style="float:right;">
				<?php echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array(
					'label' => false,
					'div' => false
				)));?>
				
				
				
				
				<?php echo $this->Form->text('question',array('placeholder'=>'Search By Question','class'=>'input-medium')); ?>&nbsp; &nbsp; 
				
				<?php echo $this->Form->button("<i class='icon-search icon-white'></i> Search",array('class'=>'btn btn-primary','escape'=>false));?>
						   &nbsp;&nbsp;
						   
						   
						   
				<?php echo $this->Form->end();?>
				</div>
			</div>

          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
			<tr style="height:30px;">
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('name','Name', array('char' => true)); ?>
				</td>
				<td width="18%" align="left">
					<?php  echo $this->Paginator->sort('short_name','Short code',array('char' => true)); ?>
				</td>
				<td width="18%" align="left">
					<?php  echo $this->Paginator->sort('site_id','Site',array('char' => true)); ?>
				</td>
				
				<td align="center" width="18%"><center>Action</center></td>
		  </tr>
                <?php 
              if( !empty($result) ) {
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
					// pr($records);die;
			  ?>
              <tr style="height:30px;" class="gallerytr">
				<td  align="left">
					<?php echo $records[$model]['name']; ?>
				</td>
				<td  align="left" style="text-align:justify;">
					<?php echo $records[$model]['short_name']; ?>
				</td>
				
                <td align="left">
					<?php 
						echo $records[$model]['site_name']; 
					 ?>
				</td>   
				
				<td width="15%" align="center">
					<center>
					<!--edit action-->
					  <?php 
					
					  echo $this->Html->link('<i class="icon-pencil icon-white"></i> Edit', array('action' => 'edit',$site_id,$records[$model]['id']), array('class' => 'btn btn-primary', 'escape' => false) )." ";
					  
					  if($records[$model]['active']){
					  		 echo $this->Html->link('<i class="icon-trash icon-white"></i> Inactive', array('plugin'=>'language','controller'=>'languages','action' => 'status_change',$records[$model]['site_id'],$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false),'Are you sure you want to inactive this '.$singularize.'?');
					  }else{
					  		 echo $this->Html->link('<i class="icon-ok-sign icon-white" ></i> Active', array('plugin'=>'language','controller'=>'languages','action' => 'status_change',$records[$model]['site_id'],$records[$model]['id']),array('class'=>'btn btn-success','escape' => false),'Are you sure you want to active this '.$singularize.'?');
					  }
					 /**/
					 ?>
					
					  &nbsp;
					</center>
			    </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <!-- <tr>
						<td align="right" colspan="6" class="border_right">  <?php echo $this->Html->image('dot.gif',array('height'=>10,'width'=>'1'));?> </td>
					 </tr> -->
			</table>
					  <?php echo $this->element('pagination'); ?> 
              <?php } 
			 		else { ?>
               <tr>
                <td align="center" style="text-align:center;" colspan="7" class="border_right"> No Result Found </td>
              </tr></table>
              <?php } ?>
        
      </td>
    </tr>
  </thead>
 
</table>