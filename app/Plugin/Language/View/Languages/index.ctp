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
				
				
				
				
				<?php echo $this->Form->text('name',array('placeholder'=>'Search By Name','class'=>'input-medium')); ?>&nbsp; &nbsp; 
				
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
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('type','Front/Admin', array('char' => true)); ?>
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
				<td  align="left">
					<?php echo (isset($records[$model]['type'])?$records[$model]['type']:__('Front')); ?>
				</td>
				
				
				<td width="15%" align="center">
					
					
					<div class="dropdown" style='float:left'>
						  <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
							<?php echo __('Action'); ?> <span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li>
							
							<?php
							echo $this->Html->link('<i class="icon-pencil icon-white"></i> Language Texts', array('action' => 'edit_expressions',$records[$model]['id'],(isset($records[$model]['type'])?$records[$model]['type']:'app')), array('class' => '', 'escape' => false) )." ";
							?>
							</li>
						  </ul>
					</div>
					
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